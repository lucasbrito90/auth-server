<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'language',
        'sector',
        'role',
        'date_of_birth',
        'phone_number',
        'address',
        'city',
        'country',
        'state_province',
        'postal_code',
        'email_notifications',
        'sms_notifications',
        'web_notifications',
        'avatar',
    ];

    private array $profileSteps = [
        'name',
        'email',
        'language',
        'sector',
        'role',
        'date_of_birth',
        'phone_number',
        'address',
        'city',
        'country',
        'state_province',
        'postal_code',
        'avatar',
        'active',
    ];

    protected $appends = ['completion_percentage'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getCompletionPercentageAttribute(): float|int
    {
        $properties = $this->profileSteps;

        $filled = collect($properties)->filter(function ($property) {
            return !empty($this->{$property});
        })->count();

        return ($filled / count($properties)) * 100;
    }
}
