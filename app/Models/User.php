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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ranging_privilege_number'
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

//    public function getNameAttribute()
//    {
//        $lang = app()->getLocale();
//        return $this->{"name_$lang"};
//    }

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
