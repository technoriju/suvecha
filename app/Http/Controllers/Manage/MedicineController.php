<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\{Medicine};
class MedicineController extends Controller
{

    public function index()
    {
       $data =Medicine::orderBy('id','DESC')->get();
       if($data == false): $data = []; endif;
       return view('manage.medicine_list',compact('data'));
    }

    public function create()
    {
        $url = url('/manage/medicine');
        return view('manage.medicine_add',compact('url'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'medicine_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $medicine = new Medicine;
        $medicine->medicine_name = $request->medicine_name;
        $medicine->created_at = curDate();
        $medicine->updated_at = curDate();
        $data = $medicine->save();

        if($data):
            $request->session()->flash('success', 'Medicine data Uploaded');
            return redirect('/manage/medicine/create');
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
        $data = medicine::find($id);

        $url = url('/manage/medicine')."/".$id;
        if($data == false) { $data = []; }
        return view('manage.medicine_add',compact('data','url'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'medicine_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $medicine = medicine::find($id);
        $medicine->medicine_name = $request->medicine_name;
        $medicine->updated_at = curDate();
        $data = $medicine->save();

        if($data):
            $request->session()->flash('success', 'Medicine data Updated');
            return redirect('/manage/medicine');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function destroy($id)
    {
        $medicine = Medicine::find($id);
        $data = $medicine->delete();
        echo ($data == true)? "success" : "failed";
    }

}
