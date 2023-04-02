<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;
use Carbon\Carbon;
use App\Models\{Doctor,DoctorActivity,DoctorTime,DoctorScheduleTime,PharmacyActivity,StockistActivity,Headquarter,RolePermission};
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\DB;
class DoctorController extends Controller
{
    use HelperTrait;

    public function index()
    {
       $data2 = Doctor::with('specialization')
               ->join('role_permissions','role_permissions.permission_id','=','doctors.role_id')
               ->join('employees',\DB::raw("FIND_IN_SET(doctors.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
               ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
               if($this->role_id() == 4):
                $data2->where(['doctors.role_id'=>$this->role_id()]);
               endif;
               $data = $data2->orderBy('doctors.id','DESC')->get();
       if($data == false): $data = []; endif;
       return view('doctor_list',compact('data'));
    }

    public function indexActivity()
    {
       $data2 = DoctorActivity::join('doctors','doctors.id','=','doctor_activities.doctor_id')
               ->join('role_permissions','role_permissions.permission_id','=','doctor_activities.role_id')
               ->join('employees',\DB::raw("FIND_IN_SET(doctors.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
               ->leftJoin('specializations','specializations.id','=','doctors.specialization_id')
               ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
               if($this->role_id() == 4):
                $data2->where(['doctors.role_id'=>$this->role_id()]);
               endif;
               $data = $data2->orderBy('doctor_activities.id','DESC')->get();
       // r($data); die;
       if($data == false): $data = []; endif;
       return view('doctor_list_activity',compact('data'));
    }

    public function doctorPharmacy()
    {
          $doctor2 = DoctorActivity::select('doctor_activities.created_at','doctor_activities.medicine_id','doctor_activities.location','doctors.doctor_name','doctors.phone',
                                            'specializations.specialization_name')
               ->join('doctors','doctors.id','=','doctor_activities.doctor_id')
               ->join('role_permissions','role_permissions.permission_id','=','doctor_activities.role_id')
               ->join('employees',\DB::raw("FIND_IN_SET(doctors.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
               ->leftJoin('specializations','specializations.id','=','doctors.specialization_id')
               ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
               if($this->role_id() == 4):
                $doctor2->where(['doctors.role_id'=>$this->role_id()]);
               endif;
               $doctor = $doctor2->whereDate('doctor_activities.created_at',Carbon::now())->orderBy('doctor_activities.id','DESC')->get();


          $pharmacy2 = PharmacyActivity::select('pharmacies.*','pharmacy_activities.*','headquarter_name','area_name')
               ->join('pharmacies','pharmacies.id','=','pharmacy_activities.pharmacy_id')
               ->join('headquarters','headquarters.id','=','pharmacies.headquarter_id')
               ->join('areas','areas.id','=','pharmacies.area_id')
               ->join('role_permissions','role_permissions.permission_id','=','pharmacy_activities.role_id')
               ->join('employees',\DB::raw("FIND_IN_SET(pharmacies.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
               ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
               if($this->role_id() == 4):
                $pharmacy2->where(['pharmacies.role_id'=>$this->role_id()]);
               endif;
               $pharmacy = $pharmacy2->orderBy('pharmacy_activities.id','DESC')->get();

         $stockist2 = StockistActivity::select('stockists.*','stockist_activities.*','headquarter_name','area_name')
               ->join('stockists','stockists.id','=','stockist_activities.stockist_id')
               ->join('headquarters','headquarters.id','=' ,'stockists.headquarter_id')
               ->join('areas','areas.id','=','stockists.area_id')
               ->join('role_permissions','role_permissions.permission_id','=','stockist_activities.role_id')
               ->join('employees',\DB::raw("FIND_IN_SET(stockists.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
               ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
               if($this->role_id() == 4):
                $stockist2->where(['stockists.role_id'=>$this->role_id()]);
               endif;
               $stockist = $stockist2->orderBy('stockist_activities.id','DESC')->get();

        return view('doctor_and_pharmacy',compact('doctor','pharmacy','stockist'));
    }

    public function create()
    {
        $headquarter_id = session('shuvecha')->headquarter_id;
        $district = $this->DistrictList($headquarter_id);
        $headquarter = $this->HeadquarterList($headquarter_id);
        $specializations = $this->SpecializationsList();

        $url = url('/doctor');
        return view('doctor_add',compact('headquarter','district','specializations','url'));
    }

    public function store(Request $request)
    {
        //f($request->all()); die;
        $validator = Validator::make($request->all(),
            [
                'district_id' => 'required',
                'headquarter_id' => 'required',
                'phone' => 'regex:/[6-9]{1}[0-9]{9}/',
                'area_id' => 'required',
                'doctor_name' => 'required',
                'address' =>'required',
                'specialization_id' =>'required',
                'file_path'=>'mimes:jpg,jpeg,png,gif|max:5000'
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        if($request->file())
        {
            $image = $request->file('file_path');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('/assets/upload/doctor'),$image_name);
            $file_path = "/assets/upload/doctor/" . $image_name;
        }

        $doctor = new Doctor;
        $doctor->district_id = $request->district_id;
        $doctor->headquarter_id = $request->headquarter_id;
        $doctor->area_id = $request->area_id;
        $doctor->phone = $request->phone ?? '';
        $doctor->employee_id = $this->emp_id();
        $doctor->doctor_name = $request->doctor_name;
        $doctor->address = $request->address;
        $doctor->specialization_id = $request->specialization_id;
        $doctor->pharmacy_id = $request->pharmacy_id ?? array();
        $doctor->file_path = $file_path ?? '';
        $doctor->role_id = $this->role_id();
        $doctor->created_at = curDate();
        $doctor->updated_at = curDate();
        $data = $doctor->save();
        $doctor_id = $doctor->id;



        if( isset($request->day_name) && count($request->day_name) > 0 ):

                    foreach( $request->day_name as $result ):

                        if(isset($request->start_time[$result])):
                        $arr = array(
                                    'day_name'      => $result,
                                    'open_time'     => $request->start_time[$result],
                                    'close_time'    => $request->end_time[$result],
                                    'doctor_id'     => $doctor_id,
                                    'created_at' => curDate(),
                                    'updated_at' => curDate()
                                );



                        $time_id = DB::table('doctor_times')->insertGetId($arr);

                        if( !empty($result) ):

                            $req_start = $result.'_start_time';
                            $req_end = $result.'_end_time';

                            if( isset($request->$req_start) && count($request->$req_start) > 0 ):

                                foreach( $request->$req_start as $key=>$tt ):

                                    $open_time = $request->$req_start[$key];
                                    $close_time = $request->$req_end[$key];
                                    if(isset($open_time)):
                                        $arr = array(
                                                'doctor_time_id'   => $time_id,
                                                'open_time'         => $open_time,
                                                'close_time'        => $close_time,
                                                'created_at' => curDate(),
                                                'updated_at' => curDate()
                                            );
                                        $sid = DB::table('doctor_schedule_times')->insertGetId($arr);
                                    endif;
                                endforeach;


                            endif;

                        endif;
                    endif;
                    endforeach;

                endif;

        if($data):
            $request->session()->flash('success', 'Doctor data Uploaded');
            return redirect('doctor/create');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function activity(Request $request)
    {
        $headquarter_id = session('shuvecha')->headquarter_id;
        $area = $this->AreaList($headquarter_id);
        $medicine = $this->MedicineList();
        $url = url('/doctor/activity');
        return view('doctor_add_activity',compact('area','url','medicine'));
    }

    public function activityUpdate(Request $request)
    {
        //$ip = $request->ip();
        $ip = '162.159.24.227';
        $currentUserInfo = Location::get($ip);

        $validator = Validator::make($request->all(),
            [
                'doctor_id' => 'required',
                'information' => 'required',
                'area_id' => 'required'
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $doctor = new DoctorActivity;
        $doctor->doctor_id = $request->doctor_id;
        $doctor->information = $request->information;
        $doctor->employee_id = $this->emp_id();
        $doctor->medicine_id = $request->medicine_id ?? array();
        $doctor->location = $currentUserInfo->cityName;
        $doctor->role_id = $this->role_id();
        $doctor->created_at = curDate();
        $doctor->updated_at = curDate();
        $data = $doctor->save();

        if($data):
            $request->session()->flash('success', 'Doctor Activity data Uploaded');
            return redirect('doctor/activity');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function fetchArea(Request $request)
    {
       $area = $this->AreaList($request->headquarter_id);
       if(count($area)>0):
            echo '<option value="0" selected>Choose any Area</option>';
            foreach($area as $val):
                echo "<option value=".$val->id.">".$val->area_name."</option>";
            endforeach;
       else:
           echo '<option value="0" selected>No Area Found</option>';
       endif;
    }

    public function fetchDoctor(Request $request)
    {
       $doctor = $this->DoctorList($request->area_id);
       if(count($doctor)>0):
            echo '<option value="">Choose any Doctor</option>';
            foreach($doctor as $val):
                echo "<option value=".$val->id.">".$val->doctor_name."</option>";
            endforeach;
       else:
           echo '<option value="">No Doctor Found</option>';
       endif;
    }

    public function fetchDoctorInfo(Request $request)
    {
       $doctor = Doctor::with('pharmacy','specialization')->where('doctors.id',$request->id)->first();

       $data['pharmacy_id'] = $doctor->pharmacy['pharmacy_name'] ?? '';
       $data['address'] = $doctor->address ?? '';
       $data['specialization_id'] = $doctor->specialization['specialization_name'] ?? '';

       //$doctor_time = DB::table('doctor_times')->where('doctor_id',$request->id)->get();
       $doctor_time = DoctorTime::with('schedule')->where('doctor_id',$request->id)->get();

       $data['time'] = view('render.time', compact('doctor_time'))->render();
       echo json_encode($data);
    }



}
