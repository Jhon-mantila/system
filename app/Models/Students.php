<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Students extends Model
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
        'active'
    ];

    public function certificate(){
        return $this->hasMany(Certificate::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
