<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $primaryKey = "category_id";

    public function setCategoryNameAttribute($value)
    {
        $this->attributes['category_name'] = ucwords($value);
    }
}
