<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Repositories\InviteRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $openRegistration = config('app.openRegistration');

        Validator::make($input, $this->rules($openRegistration))->validate();

        $user = User::create([
            'name' => $input['name'],
            // 'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        if (! $openRegistration) {

            $invite = app(InviteRepository::class)
                ->getInviteByToken($input['token'])
                ->first();

            $invite->markAsUsed();

            if ($invite->role) {
                $user->assignRole($invite->role);
                //$user->assignRole($invite->role->name);
            }
        }

        return $user;
    }

    public function rules($openRegistration)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            // 'username' => ['required', 'alpha_dash', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];

        if (! $openRegistration) {
            $rules = array_merge([
                'token' => ['required', 'string', 'max:255'],
                //'token' => ['required', 'string', 'max:255', Rule::exists('invites', 'token')->whereNull('used_at')],
                //'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email', Rule::exists('invites', 'email')->whereNull('used_at')],
            ], $rules);
        }

        return $rules;
    }
}
