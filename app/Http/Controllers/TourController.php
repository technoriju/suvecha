<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\{Tour};
use App\Traits\HelperTrait;
class TourController extends Controller
{
    use HelperTrait;
    public function index()
    {
        $data2 = Tour::join('role_permissions','role_permissions.permission_id','=','tours.role_id')
        ->join('employees',\DB::raw("FIND_IN_SET(tours.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
        ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
        if($this->role_id() == 4):
         $data2->where(['tours.role_id'=>$this->role_id()]);
        endif;
        $data = $data2->orderBy('tours.id','DESC')->get();
        //r($data); die;
       if($data == false): $data = []; endif;
       return view('tour_list',compact('data'));
    }

    public function create()
    {
        $headquarter_id = session('shuvecha')->headquarter_id;
        $headquarter = $this->HeadquarterList($headquarter_id);
        $url = url('/tour');
        return view('tour_add',compact('url','headquarter'));
    }

    public function store(Request $request)
    {
        //f($request->all());die;
        $validator = Validator::make($request->all(),
            [
                'headquarter_id' => 'required',
                'date' => 'required',
                'area_from' => 'required',
                'area_to' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $tour = new Tour;
        $tour->date = $request->date;
        $tour->area_from = $request->area_from;
        $tour->area_to = $request->area_to;
        $tour->employee_id = $this->emp_id();
        $tour->role_id = $this->role_id();
        $tour->headquarter_id = $request->headquarter_id;
        $tour->created_at = curDate();
        $tour->updated_at = curDate();
        $data = $tour->save();

        if($data)
            $request->session()->flash('success', 'Tour data Uploaded');
        else
            $request->session()->flash('error', 'Please try again');

        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = medicine::find($id);

        $url = url('/medicine')."/".$id;
        if($data == false) { $data = []; }
        return view('medicine_add',compact('data','url'));
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
            return redirect('/medicine');
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
