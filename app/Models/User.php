<?php

namespace App\Models;

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
        $class = new RbModel();
        $class->setTable("rb_applicant_statuses");
        return $this->belongsTo($class, 'status_id');
    }

    public function privilege(){
        $class = new RbModel();
        $class->setTable("rb_privileges");
        return $this->belongsTo($class, 'privilege_id');
    }

    public function position(){
        $class = new RbModel();
        $class->setTable("rb_privileges");
        return $this->belongsTo($class, 'privilege_id');
    }
}
