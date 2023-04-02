<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\Seller;
class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = Seller::all();
       if($data == false): $data = []; endif;
       return view('manage.seller_list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = url('/manage/seller');
        return view('manage.seller_add',compact('url'));
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
                'seller_name' => 'required',
                'phone' => 'required|regex:/[6-9]{1}[0-9]{9}/',
                'email' =>  'unique:sellers,email'
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $seller = new Seller;
        $seller->seller_name = $request->seller_name;
        $seller->phone = $request->phone;
        $seller->email = $request->email ?? '';
        $seller->address = $request->address;
        $seller->dob = $request->dob;
        $seller->gstno = $request->gstno ?? '';
        $data = $seller->save();

        if($data):
            $request->session()->flash('success', 'Seller data Uploaded');
            return redirect('/manage/seller/create');
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
        $data = Seller::find($id);
        $url = url('/manage/seller')."/".$id;
        if($data == false) { $data = []; }
        return view('manage.seller_add',compact('data','url'));
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
        $seller = Seller::find($id);
        $seller->seller_name = $request->seller_name;
        $seller->phone = $request->phone;
        $seller->email = $request->email ?? '';
        $seller->address = $request->address;
        $seller->dob = $request->dob;
        $seller->gstno = $request->gstno ?? '';
        $data = $seller->save();
        if($data):
            $request->session()->flash('success', 'Seller data Updated');
            return redirect('/manage/seller');
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
        $seller = seller::find($id);
        $data = $seller->delete();
        if($data == true) { echo "success"; } else { echo "failed"; }
    }
}
