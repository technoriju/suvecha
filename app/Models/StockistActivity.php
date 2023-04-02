<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockistActivity extends Model
{
    use HasFactory;
    protected $table = 'stockist_activities';
    protected $primaryKey = "id";

    public function setMedicineIdAttribute($value)
    {
        $this->attributes['medicine_id'] = implode(',',$value);
    }
}
