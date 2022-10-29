<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
use App\Models\SaleReport;
use App\Models\SaleProduct;
use App\Models\Customer;
use Carbon\Carbon;
use DB;
class ReportController extends Controller
{
    public function index(Request $request)
    {

       $customer = Customer::select('customer_id','name')->get();
       $product = Product::select('product_id','product_name')->get();

       $data = $post_data = $total_profit = $total_sales = null;

       if($request->all()):
          $post_data = $request->all();
          $data = $this->data($request);
       endif;
       return view('report',compact('customer','product','data','post_data'));
    }

    public function data(Request $request)
    {

        $from = date("Y-m-d H:i:s", strtotime($request->datef));
        $to = date("Y-m-d H:i:s", strtotime($request->datet." 23:59:00"));

        $data = SaleProduct::select('sale_products.*','products.product_name')
                ->join('products','products.product_id','=','sale_products.product_id')
                ->whereBetween('sale_products.created_at', [$from, $to]);
        if($request->product != '')
            $data->where('sale_products.product_id',$request->product);

        $data->orderBy('sale_products.sales_product_id','DESC');
        $result['data'] = $data->get();

        // Total Profit
        $total_profit = SaleProduct::whereBetween('sale_products.created_at', [$from, $to]);

        if($request->product != '')
        $total_profit->where('sale_products.product_id',$request->product);

        $result['total_profit'] = $total_profit->sum('profit');

        // Total Sales
        $total_sales = SaleProduct::whereBetween('sale_products.created_at', [$from, $to]);

        if($request->product != '')
        $total_sales->where('sale_products.product_id',$request->product);

        $result['total_sales'] = $total_sales->sum('total_price');

        return $result;
    }
}
