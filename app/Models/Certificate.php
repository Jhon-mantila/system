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
        'code',
        'program_id',
        'student_id',
        'employee_id',
        'date_start',
        'date_end',
        'date_certificate',
        'type_certificate',
        'company_id',
        'title',
        'type_code',
        'references',
        'process',
        'book',
        'folio',
        'acta',
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

    public function program(){
        return $this->belongsTo(Programs::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
