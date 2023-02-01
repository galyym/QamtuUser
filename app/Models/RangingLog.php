<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangingLog extends Model
{
    use HasFactory;

    protected $table = "ranging_logs";

    public function company(){
        return $this->belongsTo(Company::class, 'company_bin', 'bin');
    }

    public function ranging(){
        return $this->belongsTo(Ranging::class, 'ranging_id');
    }

    public function status(){
        $class = new RbModel();
        $class->setTable("rb_applicant_statuses");
        return $this->belongsTo($class, 'status_id');
    }
}
