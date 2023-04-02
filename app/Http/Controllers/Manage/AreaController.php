<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\{Headquarter,Area};
use App\Traits\HelperTrait;
class AreaController extends Controller
{
    use HelperTrait;

    public function index()
    {
       $data = Area::with('headquarter')->orderBy('id','DESC')->get();
       if($data == false): $data = []; endif;
       return view('manage.area_list',compact('data'));
    }

    public function create()
    {
        $data2 = $this->HeadquarterList();
        $url = url('/manage/area');
        return view('manage.area_add',compact('data2','url'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'headquarter_id' => 'required',
                'area_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $area = new Area;
        $area->headquarter_id = $request->headquarter_id;
        $area->area_name = $request->area_name;
        $area->distance = $request->distance;
        $area->created_at = curDate();
        $area->updated_at = curDate();
        $data = $area->save();

        if($data):
            $request->session()->flash('success', 'Area data Uploaded');
            return redirect('/manage/area/create');
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
        $data2 = $this->HeadquarterList();
        $data = Area::find($id);

        $url = url('/manage/area')."/".$id;
        if($data == false) { $data = []; }
        return view('manage.area_add',compact('data','url','data2'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'headquarter_id' => 'required',
                'area_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $area = Area::find($id);
        $area->headquarter_id = $request->headquarter_id;
        $area->area_name = $request->area_name;
        $area->distance = $request->distance;
        $area->updated_at = curDate();
        $data = $area->save();

        if($data):
            $request->session()->flash('success', 'Area data Updated');
            return redirect('/manage/area');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function destroy($id)
    {
        $area = Area::find($id);
        $data = $area->delete();
        echo ($data == true)? "success" : "failed";
    }

}
