<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Programs extends Model
{
    use HasFactory;
    use HasUuids; // para visualizar bien los id creados con uuid
    

    protected $fillable = [
        'id',
        'code',
        'code_ocupation',
        'name', 
        'credits',
        'hours',
        'certificate',
        'active',
        'user_id'
    ];

    public function certificate(){
        return $this->hasMany(Certificate::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'programs_courses');
    }
    
}
