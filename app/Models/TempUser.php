<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TempUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function findForPassport($username)
    {
        return $this->where('iin', $username)->first();
    }

    protected $fillable = [
        'raiting_number',
        'raiting_privilege_number',
        'status_id',
        'iin',
        'full_name',
        'birthdate',
        'privilege_id',
        'positions_string',
        'positions',
        'email',
        'email_verified_at',
        'phone_number',
        'address',
        'second_phone_number',
        'is_have_whatsapp',
        'is_have_telegram',
        'comment',
        'last_visit',
        'firebase_token',
        'year',
        'family_status',
        'document_type',
        'document_number',
        'document_exp',
        'document_issued',
        'address_reg',
        'education_type',
        'education_org',
        'education_year_finish',
        'request_status_id'
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
