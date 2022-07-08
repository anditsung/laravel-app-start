<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Repositories\InviteRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $key = $request->email.$request->ip();

            return Limit::perMinute(5)
                ->by($key)
                ->response(function ($request, $limiter) {
                    return back()->withErrors([
                        'email' => __("Too many login attempts, You may try again in :retry seconds.", [
                            'retry' => $limiter['Retry-After'],
                        ]),
                    ]);
                });
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::authenticateUsing(function (Request $request) {
            $userModel = config('auth.providers.users.model');

            $user = $userModel::where(function ($query) use ($request) {
                $query->Where('email', $request->email);
            })->first();

            if (
                $user
                && $user->isActive()
                && Hash::check($request->password, $user->password)
            ) {
                return $user;
            }
            return null;
        });

        $this->registerViews();
    }

    public function registerViews()
    {
        Fortify::loginView(function () {
            return Inertia::render('Auth.Login');
        });

        Fortify::registerView(function (Request $request) {
            $message = config('app.name') . " is invite only";
            $canRegister = config('app.openRegistration', true);
            $token = $request->token;
            $email = $request->email;

            if (! $canRegister && $token) {
                $invite = app(InviteRepository::class)
                    ->isValidInvite($token, $email)
                    ->first();

                if ($invite) {
                    $canRegister = true;
                }
                else {
                    $canRegister = false;
                    $message = "invalid token or email";
                }
            }

            return Inertia::render('Auth.Register', [
                'message' => $message,
                'canRegister' => $canRegister,
                'token' => $token,
                'email' => $email,
            ]);
        });

        Fortify::requestPasswordResetLinkView(function (Request $request) {
            return Inertia::render('Auth.ForgotPassword', [
                // status hanya ada di session jadi ambil status tersebut dan pass ke inertia
                'status' => $request->session()->get('status'),
            ]);
        });

        Fortify::resetPasswordView(function (Request $request) {
            return Inertia::render('Auth.ResetPassword', [
                'email' => $request->email,
                'token' => $request->token,
            ]);
        });

        Fortify::twoFactorChallengeView(function (Request $request) {
            return Inertia::render('Auth.TwoFactorChallenge');
        });
    }
}
