<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RbFamilyStatus extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $table = "rb_family_status";
}
