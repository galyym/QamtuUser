<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RbStatus extends Model
{
    use HasFactory;

    protected $table = "rb_applicant_statuses";
}
