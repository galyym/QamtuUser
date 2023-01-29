<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RbModel extends Model
{
    use HasFactory;

    protected $table = "rb_applicant_statuses";

    public function setTable($table)
    {
        $this->table = $table;
    }
}
