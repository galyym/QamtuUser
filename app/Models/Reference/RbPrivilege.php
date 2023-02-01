<?php

namespace App\Models\Reference;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RbPrivilege extends Model
{
    use HasFactory;

    protected $table = "rb_privileges";

    public function users(){
        return $this->belongsToMany(User::class, 'id');
    }
}
