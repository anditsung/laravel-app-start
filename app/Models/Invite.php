<?php

namespace App\Models;

use App\Events\Invited;
use App\Notifications\InvitationEmail;
use App\Observers\InviteObserver;
use App\Traits\HasToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Invite extends Model
{
    use HasFactory;
    use Notifiable;
    use HasToken;

    protected $dispatchesEvents = [
        'created' => Invited::class,
    ];

    protected $fillable = [
        'email',
        'token',
        'expired_at',
        'role_id',
    ];

    protected $casts = [
        'used_at' => 'datetime',
        'expired_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    protected $appends = [
        'used_at_formatted',
        'expired_at_formatted',
        'sent_at_formatted',
    ];

//    protected static function booted()
//    {
//        self::observe(InviteObserver::class);
//    }

    public function getUsedAtFormattedAttribute()
    {
        return $this->used_at ? $this->used_at->format('d F Y, H:i:s') : "";
    }

    public function getExpiredAtFormattedAttribute()
    {
        return $this->expired_at ? $this->expired_at->format('d F Y, H:i:s') : "";
    }

    public function getSentAtFormattedAttribute()
    {
        return $this->sent_at ? $this->sent_at->format('d F Y, H:i:s') : "";
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isUsed()
    {
        return ! is_null($this->used_at);
    }

    public function hasSentInvitation()
    {
        return ! is_null($this->sent_at);
    }

    public function markAsUsed()
    {
        return $this->forceFill([
            'used_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function markAsSent()
    {
        return $this->forceFill([
            'sent_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function sendEmailInvitationNotification()
    {
        $this->notify(new InvitationEmail);

        $this->markAsSent();
    }

    public function getEmailForRegistration()
    {
        return $this->email;
    }

    public function getTokenForRegistration()
    {
        return $this->token;
    }
}
