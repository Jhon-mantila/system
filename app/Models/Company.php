<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Company extends Model
{
    use HasFactory;
    use HasUuids; // para visualizar bien los id creados con uuid

    protected $fillable = [
        'id',
        'name',
        'nit',
        'web',
        'direction',
        'city',
        'mobile',
        'phone',
        'agent',
        'logo'
    ];

    public function company(){
        return $this->hasMany(Certificate::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
