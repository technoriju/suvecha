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
       $invoice_no = SaleReport::max('invoice_no');
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
        // dd($request->all());
        // die;
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
        $customer->email = '';
        $customer->address = '';
        $customer->gstno = '';
        $customer->created_at = curDate();
        $customer->updated_at = curDate();
        $customer->save();
        $customer_id = $customer->customer_id;

        $sales_report = new SaleReport;
        $sales_report->invoice_no = $request->invoice_no;
        $sales_report->date = $request->invoice_date;
        $sales_report->total = $request->totalamt;
        $sales_report->discount = $request->discount;
        $sales_report->customer_id = $customer_id;
        $sales_report->created_at = curDate();
        $sales_report->updated_at = curDate();
        $sales_report->save();
        $sales_report_id = $sales_report->sales_report_id;

        $total_purchase = 0;

        for($i = 0; $i< count($request->product_id); $i++):

            $total_purchase += $request->qnt[$i] * $request->purchase_price[$i];

            $sale_product = [
                    'product_id' => $request->product_id[$i],
                    'qty' => $request->qnt[$i],
                    'mrp_price' => $request->mrp_price[$i],
                    'sales_price' => $request->price[$i],
                    'total_price' => $request->tprice[$i],
                    'sales_report_id' => $sales_report_id,
                    'created_at' => curDate(),
                    'updated_at' => curDate()
                ];
            $rsp = SaleProduct::insert($sale_product);
            if($rsp==1):
               Product::where('product_id',$request->product_id[$i])->decrement('qty', $request->qnt[$i]);
            else:
                $request->session()->flash('error', 'Database error! Try again');
                return redirect('sales/invoice');
            endif;
        endfor;

        SaleReport::where('sales_report_id',$sales_report_id)->update(['profit'=>$request->totalamt-$total_purchase]);

        return redirect('sales/print/'.$sales_report_id);
    }

    public function print($id)
    {
        $data = SaleReport::with(['customer','sale_products'])->where('sales_report_id',$id)->get();
        return view('print',compact('data'));
    }

    public function transaction()
    {
        $data = SaleReport::with(['customer'])->orderBy('sales_report_id','desc')->get();
        return view('transaction',compact('data'));
    }

    public function edit($id)
    {
       $inv = SaleReport::with(['customer','sale_products'])->where('sales_report_id',$id)->get();
       $data = Product::select('product_id','product_name')->get();
       if($data != true) $data = [];
       $url = url('/sales/invoice/'.$id);
       return view('sales_invoice',compact('data','url','inv'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        [
           'customer_name' => 'required',
           'customer_phone' => 'required_with:customer_name|regex:/[6-9]{1}[0-9]{9}/',
           'product_id' => 'required'
        ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $customer = Customer::find($request->customer_id);
        $customer->name = $request->customer_name;
        $customer->phone = $request->customer_phone;
        $customer->address = '';
        $customer->updated_at = curDate();
        $customer->save();

        $sales_report = SaleReport::find($id);
        $sales_report->date = $request->invoice_date;
        $sales_report->total = $request->totalamt;
        $sales_report->discount = $request->discount;
        $sales_report->updated_at = curDate();
        $sales_report->save();

        for($i = 0; $i< count($request->product_id); $i++):
            $sale_product = [
                    'product_id' => $request->product_id[$i],
                    'qty' => $request->qnt[$i],
                    'mrp_price' => $request->mrp_price[$i],
                    'sales_price' => $request->price[$i],
                    'total_price' => $request->tprice[$i],
                    'sales_report_id' => $id,
                    'updated_at' => curDate()
                ];
            if(isset($request->sales_product_id[$i]))
                $rsp = SaleProduct::where('sales_product_id',$request->sales_product_id[$i])->update($sale_product);
            elseif($request->product_id[$i] != '')
                $rsp =SaleProduct::insert($sale_product);

            if($rsp==1):
                Product::where('product_id',$request->product_id[$i])->decrement('qty', $request->qnt[$i]);
            else:
                $request->session()->flash('error', 'Database error! Try again');
                return redirect('sales/invoice/'.$id);
            endif;
        endfor;

        return redirect('sales/print/'.$id);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $data = $product->delete();
        if($data == true) { echo "success"; } else { echo "failed"; }
    }
}
