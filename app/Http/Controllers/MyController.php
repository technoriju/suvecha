<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class MyController extends Controller
{
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
}
