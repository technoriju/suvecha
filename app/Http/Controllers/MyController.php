<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Customer;
class MyController extends Controller
{
    public function Category()
    {
      return $data = Category::select('category_id','category_name')->where(['status'=>1,'parent_id'=>0])->get();
    }
    public function subCate($id)
    {
      return $data = Category::select('category_id','category_name')->where(['category_id'=>$id])->first();
    }
    public function Subcategory($category_id)
    {
        $data = Category::select('category_id','category_name')
                 ->where(['parent_id'=>$category_id,'status'=>1])
                 ->get();
        if(isset($data) && count($data)>0)
        {
            $subcat ="<option value='0'> Choose any one </option>";
            foreach($data as $val):
                $subcat.= "<option value='$val->category_id'>$val->category_name</option>";
            endforeach;

        } else {
            $subcat ="<option value='0'> No Sub Category was found. </option>";
        }
        return $subcat;
    }

    public function Seller()
    {
      return $data = Seller::select('seller_id','seller_name')->get();
    }

    public function Customer()
    {
      return $customer = Customer::select('customer_id','name')->get();
    }

    public function Product()
    {
      return $data = Product::select('product_id','product_name')->get();
    }

}
