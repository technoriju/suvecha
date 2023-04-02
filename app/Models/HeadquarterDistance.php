<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadquarterDistance extends Model
{
    use HasFactory;
    protected $table = 'headquarter_distances';
    protected $primaryKey = "id";
}
