<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $primaryKey = "product_id";

    public function category()
    {
        return $this->hasmany(Category::class,'category_id','category_id');
    }
}
