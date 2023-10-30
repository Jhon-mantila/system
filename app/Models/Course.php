<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;
    use HasUuids; // para visualizar bien los id creados con uuid

    protected $fillable = [
        'id','name','code','credits','hours','active'
    ];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Programs::class, 'programs_courses');
    }
}
