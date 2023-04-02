<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;
use App\Models\{Pharmacy,PharmacyActivity};
use App\Traits\HelperTrait;

class PharmacyController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $data2 = Pharmacy::with('headquarter','area')->select('pharmacies.*')
               ->join('role_permissions','role_permissions.permission_id','=','pharmacies.role_id')
               ->join('employees',\DB::raw("FIND_IN_SET(pharmacies.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
               ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
               if($this->role_id() == 4):
                $data2->where(['pharmacies.role_id'=>$this->role_id()]);
               endif;
               $data = $data2->orderBy('pharmacies.id','DESC')->get();
       // r($data); die;
       if($data == false): $data = []; endif;
       return view('pharmacy_list',compact('data'));
    }

    public function indexActivity()
    {
       $data2 = PharmacyActivity::select('pharmacies.*','pharmacy_activities.*','headquarter_name','area_name')
               ->join('pharmacies','pharmacies.id','=','pharmacy_activities.pharmacy_id')
               ->join('headquarters','headquarters.id','=','pharmacies.headquarter_id')
               ->join('areas','areas.id','=','pharmacies.area_id')
               ->join('role_permissions','role_permissions.permission_id','=','pharmacy_activities.role_id')
               ->join('employees',\DB::raw("FIND_IN_SET(pharmacies.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
               ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
               if($this->role_id() == 4):
                $data2->where(['pharmacies.role_id'=>$this->role_id()]);
               endif;
               $data = $data2->orderBy('pharmacy_activities.id','DESC')->get();
       // r($data); die;
       if($data == false): $data = []; endif;
       return view('pharmacy_list_activity',compact('data'));
    }

    public function create(Request $request)
    {
        $headquarter_id = session('shuvecha')->headquarter_id;
        $headquarter = $this->HeadquarterList($headquarter_id);
        $url = url('/pharmacy');
        return view('pharmacy_add',compact('headquarter','url'));
    }

    public function store(Request $request)
    {
        //f($request->all()); die;
        $validator = Validator::make($request->all(),
            [
                'pharmacy_name' => 'required',
                'address' => 'required',
                'headquarter_id' => 'required',
                'area_id' => 'required',
                'phone' => 'required|regex:/[6-9]{1}[0-9]{9}/',
                'file_path'=>'mimes:jpg,jpeg,png,gif|max:5000'
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        if($request->file())
        {
            $image = $request->file('file_path');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('/assets/upload/pharmacy'),$image_name);
            $file_path = "/assets/upload/pharmacy/" . $image_name;
        }

        $pharmacy = new Pharmacy;
        $pharmacy->pharmacy_name = $request->pharmacy_name;
        $pharmacy->address = $request->address;
        $pharmacy->area_id = $request->area_id;
        $pharmacy->employee_id = $this->emp_id();
        $pharmacy->headquarter_id = $request->headquarter_id;
        $pharmacy->phone = $request->phone;
        $pharmacy->dl_no = $request->dl_no ?? '';
        $pharmacy->file_path = $file_path ?? '';
        $pharmacy->role_id = $this->role_id();
        $pharmacy->created_at = curDate();
        $pharmacy->updated_at = curDate();
        $data = $pharmacy->save();

        if($data):
            $request->session()->flash('success', 'Pharmacy data Uploaded');
            return redirect('pharmacy/create');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function activity(Request $request)
    {
        $headquarter_id = session('shuvecha')->headquarter_id;
        $area = $this->AreaList($headquarter_id);
        $url = url('/pharmacy/activity');
        return view('pharmacy_add_activity',compact('area','url'));
    }

    public function activityUpdate(Request $request)
    {
        //$ip = $request->ip();
        $ip = '162.159.24.227';
        $currentUserInfo = Location::get($ip);

        $validator = Validator::make($request->all(),
            [
                'pharmacy_id' => 'required',
                'information' => 'required',
                'area_id' => 'required',
                'file_path'=>'mimes:jpg,jpeg,png,gif|max:5000'
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        if($request->file())
        {
            $image = $request->file('file_path');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('/assets/upload/pharmacy'),$image_name);
            $file_path = "/assets/upload/pharmacy/" . $image_name;
        }

        $pharmacy = new PharmacyActivity;
        $pharmacy->pharmacy_id = $request->pharmacy_id;
        $pharmacy->information = $request->information;
        $pharmacy->employee_id = $this->emp_id();
        $pharmacy->file_path = $file_path ?? '';
        $pharmacy->location = $currentUserInfo->cityName;
        $pharmacy->role_id = $this->role_id();
        $pharmacy->created_at = curDate();
        $pharmacy->updated_at = curDate();
        $data = $pharmacy->save();

        if($data):
            $request->session()->flash('success', 'Pharmacy Activity data Uploaded');
            return redirect('pharmacy/activity');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function fetchPharmacy(Request $request)
    {
       $pharmacy = $this->PharmacyList($request->area_id);
       if(count($pharmacy)>0):
            echo '<option value="">Choose any Pharmacy</option>';
            foreach($pharmacy as $val):
                echo "<option value=".$val->id.">".$val->pharmacy_name."</option>";
            endforeach;
       else:
           echo '<option value="">No Pharmacy Found</option>';
       endif;
    }

    public function fetchPharmacyInfo(Request $request)
    {
       $pharmacy = Pharmacy::select('dl_no','address','phone')->where('id',$request->id)->first();
       $data['dl_no'] = $pharmacy->dl_no;
       $data['address'] = $pharmacy->address;
       $data['phone'] = $pharmacy->phone;
       echo json_encode($data);
    }
}
