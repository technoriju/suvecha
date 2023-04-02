<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\{DistrictList,Headquarter};
use App\Traits\HelperTrait;
class HeadquarterController extends Controller
{
    use HelperTrait;

    public function index()
    {
       $data = Headquarter::with('district')->orderBy('id','DESC')->get();
       if($data == false): $data = []; endif;
       return view('headquarter_list',compact('data'));
    }

    public function create()
    {
        $data2 = $this->DistrictList();
        $url = url('/headquarter');
        return view('headquarter_add',compact('data2','url'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'district_id' => 'required',
                'headquarter_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $headquarter = new Headquarter;
        $headquarter->district_id = $request->district_id;
        $headquarter->headquarter_name = $request->headquarter_name;
        $headquarter->created_at = curDate();
        $headquarter->updated_at = curDate();
        $data = $headquarter->save();
        $headquarter_id = $headquarter->id;

        if($data):
            $request->session()->flash('success', 'Headquarter data Uploaded');
            return redirect('headquarter/create');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data2 = $this->DistrictList();
        $data = Headquarter::find($id);

        $url = url('/headquarter')."/".$id;
        if($data == false) { $data = []; }
        return view('headquarter_add',compact('data','url','data2'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'district_id' => 'required',
                'headquarter_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $headquarter = Headquarter::find($id);
        $headquarter->district_id = $request->district_id;
        $headquarter->headquarter_name = $request->headquarter_name;
        $headquarter->updated_at = curDate();
        $data = $headquarter->save();

        if($data):
            $request->session()->flash('success', 'Headquarter data Updated');
            return redirect('/headquarter');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function destroy($id)
    {
        $headquarter = Headquarter::find($id);
        $data = $headquarter->delete();
        echo ($data == true)? "success" : "failed";
    }

}
