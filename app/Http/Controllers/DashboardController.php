<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SaleReport;
use App\Models\SaleProduct;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function dashboard()
    {
        $fromSubYear = Carbon::now()->subYears(1);

        $last_one_year_sale = SaleReport::whereBetween('date', [$fromSubYear, Carbon::now()])->sum('total');
        $today_sale = SaleReport::where('date', Carbon::today())->sum('total');
        $last_one_year_profit = SaleReport::whereBetween('date', [$fromSubYear, Carbon::now()])->sum('profit');
        $today_profit = SaleReport::where('date', Carbon::today())->sum('profit');

        return view('dashboard',compact('last_one_year_sale','today_sale','last_one_year_profit','today_profit'));
    }
}
