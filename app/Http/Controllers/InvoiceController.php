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
class InvoiceController extends Controller
{

    public function index()
    {
       $invoice_no = SaleReport::orderBy('invoice_no','DESC')->value('invoice_no');
       $data = Product::select('product_id','product_name')->get();
       if($data != true) $data = [];
       $url = url('/sales/invoice');
       return view('sales_invoice',compact('data','url','invoice_no'));
    }


    public function fetchpriceqty(Request $request)
    {
        $data = Product::select('qty','sell_price','purchase_price','mrp_price')->where('product_id',$request->product_id)->first();
        $data2['qty'] = $data->qty;
        $data2['mrp_price'] = $data->mrp_price;
        $data2['sell_price'] = $data->sell_price;
        $data2['purchase_price'] = $data->purchase_price;
        echo json_encode($data2);
    }

    public function invoice(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
           'customer_name' => 'required',
           'customer_phone' => 'required_with:customer_name|regex:/[6-9]{1}[0-9]{9}/',
           'invoice_no' => 'required|unique:sale_reports,invoice_no',
           'product_id' => 'required'
        ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $customer = new Customer;
        $customer->name = $request->customer_name;
        $customer->phone = $request->customer_phone;
        $customer->address = '';
        $customer->save();
        $customer_id = $customer->customer_id;

        $sales_report = new SaleReport;
        $sales_report->invoice_no = $request->invoice_no;
        $sales_report->date = $request->invoice_date;
        $sales_report->total = $request->totalamt;
        $sales_report->discount = $request->discount;
        $sales_report->customer_id = $customer_id;
        $sales_report->save();
        $sales_report_id = $sales_report->sales_report_id;

        for($i = 0; $i< count($request->product_id); $i++):
            $sale_product[] = [
                    'product_id' => $request->product_id[$i],
                    'qty' => $request->qnt[$i],
                    'mrp_price' => $request->mrp_price[$i],
                    'sales_price' => $request->price[$i],
                    'total_price' => $request->tprice[$i],
                    'sales_report_id' => $sales_report_id
                ];
        endfor;
        SaleProduct::insert($sale_product);

        return redirect('sales/print/'.$sales_report_id);
    }

    public function print($id)
    {
        $data = SaleReport::with(['customer','sale_products'])->where('sales_report_id',$id)->get();
        return view('print',compact('data'));
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
