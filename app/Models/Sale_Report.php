<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_Report extends Model
{
    use HasFactory;
    protected $table = 'sales_report';
    protected $primaryKey = 'sales_report_id';
}
