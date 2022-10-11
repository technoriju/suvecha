<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
//use Illuminated\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
use DB;
class ProductController extends MyController
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = Product::join('categories','categories.category_id','=','products.category_id')
       ->select('products.*', 'categories.category_name', DB::raw("(SELECT categories.category_name as sub_name FROM (categories INNER JOIN products ON products.subcategory_id = categories.category_id) WHERE categories.parent_id != 0 limit 1) as sub_name"))
       ->get();
       r($data);
       die;
       if($data == false): $data = []; endif;
       return view('product_stock',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data2 = Category::select('category_id','category_name')->where(['status'=>1,'parent_id'=>0])->get();
        $seller = Seller::select('seller_id','seller_name')->get();
        $url = url('/product');
        return view('product_add',compact('data2','seller','url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'category_id' => 'required',
                'sku_code' => 'required|unique:products,sku_code',
                'product_name' => 'required',
                'purchase_price' => 'required|integer',
                'sell_price' => 'integer',
                'qty' => 'integer'
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id ?? 0;
        $product->sku_code = $request->sku_code;
        $product->seller_id = $request->seller_id ?? 0;
        $product->product_name = $request->product_name;
        $product->qty = $request->qty ?? 0;
        $product->purchase_price = $request->purchase_price ?? 0;
        $product->sell_price = $request->sell_price ?? 0;
        $data = $product->save();

        if($data):
            $request->session()->flash('success', 'Product data Uploaded');
            return redirect('product/create');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);
        $url = url('/product')."/".$id;
        if($data == false) { $data = []; }
        return view('product_add',compact('data','url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Product = Product::find($id);
        $Product->Product_name = $request->Product_name;
        $Product->phone = $request->phone;
        $Product->email = $request->email;
        $Product->address = $request->address;
        $Product->dob = $request->dob;
        $Product->gstno = $request->gstno;
        $data = $Product->save();
        if($data):
            $request->session()->flash('success', 'Product data Updated');
            return redirect('/Product');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Product::find($id);
        $data = $Product->delete();
        if($data == true) { echo "success"; } else { echo "failed"; }
    }

    public function subcat(Request $request)
    {
        // r($request->all());
        // die;
        $data = parent::Subcategory($request->id);
        echo $data;
    }
}
