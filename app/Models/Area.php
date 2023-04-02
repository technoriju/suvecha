<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $primaryKey = "id";

    public function headquarter()
    {
        return $this->hasOne(Headquarter::class,'id','headquarter_id');
    }
}
