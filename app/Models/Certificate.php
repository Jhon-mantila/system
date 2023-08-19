<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Certificate extends Model
{
    use HasFactory;
    use HasUuids; // para visualizar bien los id creados con uuid

    protected $fillable = [
        'program_id',
        'student_id',
        'employee_id',
        'date_start',
        'date_end',
        'company_id',
        'accredited',
        'notified',
        'user_id',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function employee(){
        return $this->belongsTo(Employees::class);
    }

    public function student(){
        return $this->belongsTo(Students::class);
    }

    public function program(){
        return $this->belongsTo(Programs::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
