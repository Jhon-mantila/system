<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Employees extends Model
{
    use HasFactory;
    use HasUuids; // para visualizar bien los id creados con uuid

    protected $fillable = [
        'id',
        'type_document',
        'document',
        'first_name',
        'second_name',
        'last_name',
        'second_last_name',
        'mobile',
        'email',
        'profession',
        'specialty',
        'description',
        'signature',
        'type_employee',
        'active'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
