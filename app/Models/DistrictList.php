<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HelperTrait;
class DistrictList extends Model
{
    use HasFactory, HelperTrait;
    protected $table = 'district_lists';
    protected $primaryKey = "id";

}
