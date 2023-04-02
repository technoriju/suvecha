<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Role;
use App\Models\SaleReport;
use App\Models\SaleProduct;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function dashboard()
    {
        $fromSubYear = Carbon::now()->subYears(1);

        // $last_one_year_sale = SaleReport::whereBetween('date', [$fromSubYear, Carbon::now()])->sum('total');
        // $today_sale = SaleReport::where('date', Carbon::today())->sum('total');
        // $last_one_year_profit = SaleReport::whereBetween('date', [$fromSubYear, Carbon::now()])->sum('profit');
        // $today_profit = SaleReport::where('date', Carbon::today())->sum('profit');

        return view('manage.dashboard');
    }

    public function role()
    {
        $data = Role::get();
       if($data == false): $data = []; endif;
       return view('manage.role_list',compact('data'));
    }

    public function roleUpdate(Request $request)
    {
        $role = Role::find($request->role_id);
        $role->fixed_price_h = $request->fixed_price_h;
        $role->fixed_price_x = $request->fixed_price_x;
        $role->fixed_price_o = $request->fixed_price_o;
        $role->updated_at = curDate();
        $data = $role->save();

        if($data):
            $request->session()->flash('success', 'Role data Updated');
            return redirect('/manage/role');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }
}
