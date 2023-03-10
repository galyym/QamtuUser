<?php

namespace App\Models;

use App\Models\Reference\RbPosition;
use App\Models\Reference\RbPrivilege;
use App\Models\Reference\RbStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @mixin Builder
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function findForPassport($username)
    {
        return $this->where('iin', $username)->first();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    protected $table = "applicant";

    public function status(){
        return $this->belongsTo(RbStatus::class, 'status_id');
    }

    public function privilege(){
        return $this->belongsTo(RbPrivilege::class, 'privilege_id');
    }

    public function position()
    {
        return $this->belongsToMany(RbPosition::class, 'privilege_id');
    }
}
