<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Employees extends Model
{
    use HasFactory;
    use HasUuids; // para visualizar bien los id creados con uuid
}
