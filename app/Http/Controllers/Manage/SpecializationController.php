<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\{Specialization};

class SpecializationController extends Controller
{

    public function index()
    {
       $data = Specialization::orderBy('id','DESC')->get();
       if($data == false): $data = []; endif;
       return view('manage.specialization_list',compact('data'));
    }

    public function create()
    {
        $url = url('/manage/specialization');
        return view('manage.specialization_add',compact('url'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'specialization_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $specialization = new Specialization;
        $specialization->specialization_name = $request->specialization_name;
        $specialization->created_at = curDate();
        $specialization->updated_at = curDate();
        $data = $specialization->save();

        if($data):
            $request->session()->flash('success', 'Specialization data Uploaded');
            return redirect('/manage/specialization/create');
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
        $data = Specialization::find($id);

        $url = url('/manage/specialization')."/".$id;
        if($data == false) { $data = []; }
        return view('manage.specialization_add',compact('data','url'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'specialization_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $specialization = Specialization::find($id);
        $specialization->specialization_name = $request->specialization_name;
        $specialization->updated_at = curDate();
        $data = $specialization->save();

        if($data):
            $request->session()->flash('success', 'Specialization data Updated');
            return redirect('/manage/specialization');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function destroy($id)
    {
        $specialization = Specialization::find($id);
        $data = $specialization->delete();
        echo ($data == true)? "success" : "failed";
    }

}
