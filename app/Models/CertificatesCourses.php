<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CertificatesCourses extends Model
{
    use HasFactory;
    use HasUuids; // para visualizar bien los id creados con uuid
    
    protected $fillable = [
        'course_id',
        'student_id',
        'employee_id',
        'date_start',
        'date_end',
        'type_certificate',
        'company_id',
        'title',
        'type_code',
        'references',
        'process',
        'accredited',
        'notified',
        'module',
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

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
