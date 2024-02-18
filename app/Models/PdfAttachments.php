<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PdfAttachments extends Model
{
    use HasFactory;
    use HasUuids; // para visualizar bien los id creados con uuid
    
    protected $fillable = [
        'name',
        'student_id',
        'attachments',
        'user_id',
    ];

    public function student(){
        return $this->belongsTo(Students::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
