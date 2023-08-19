<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;
    use HasUuids; // para visualizar bien los id creados con uuid

    protected $fillable = [
        'id','name','code','credits','hours','active'
    ];

    public function certificate(){
        return $this->hasMany(Certificate::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
