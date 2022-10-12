<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = Product::select('product_id','product_name')->get();
       if($data != true) $data = [];
       $url = url('/sales/print');
       return view('sales_invoice',compact('data','url'));
    }


    public function fetchpriceqty(Request $request)
    {
        $data = Product::select('qty','sell_price','purchase_price')->where('product_id',$request->product_id)->first();
        $data2['qty'] = $data->qty;
        $data2['sell_price'] = $data->sell_price;
        $data2['purchase_price'] = $data->purchase_price;
        echo json_encode($data2);
    }

    public function print(Request $request)
    {
        f($request->all());
        die;
        return view('print');
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
        $data2 = parent::Category();
        $seller = parent::Seller();
        $data = Product::find($id);
        $data3 = '';
        if($data->subcategory_id != 0)
          $data3 = parent::subCate($data->subcategory_id);

        $url = url('/product')."/".$id;
        if($data == false) { $data = []; }
        return view('product_add',compact('data','url','data2','data3','seller'));
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
        $validator = Validator::make($request->all(),
            [
                'category_id' => 'required',
                'sku_code' => 'required|unique:products,sku_code,'.$id.',product_id',
                'product_name' => 'required',
                'purchase_price' => 'required|integer',
                'sell_price' => 'integer',
                'qty' => 'integer'
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $product = Product::find($id);
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
            $request->session()->flash('success', 'Product data Updated');
            return redirect('/product');
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
        $product = Product::find($id);
        $data = $product->delete();
        if($data == true) { echo "success"; } else { echo "failed"; }
    }

    public function subcat(Request $request)
    {
        $data = parent::Subcategory($request->id);
        echo $data;
    }
}
