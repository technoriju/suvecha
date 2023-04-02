<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyActivity extends Model
{
    use HasFactory;
    protected $table = 'pharmacy_activities';
    protected $primaryKey = "id";
}
