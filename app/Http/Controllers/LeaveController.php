<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\{LeaveRequest};
use App\Traits\HelperTrait;

class LeaveController extends Controller
{
    use HelperTrait;
    public function index()
    {
        $data2 = LeaveRequest::select('leave_requests.*')
        ->join('role_permissions','role_permissions.permission_id','=','leave_requests.role_id')
        ->join('employees',\DB::raw("FIND_IN_SET(leave_requests.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
        ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
        if($this->role_id() == 4):
         $data2->where(['leave_requests.role_id'=>$this->role_id()]);
        endif;
        $data = $data2->orderBy('leave_requests.id','DESC')->get();

       if($data == false): $data = []; endif;
       return view('leave_request_list',compact('data'));
    }

    public function create()
    {
        $headquarter_id = session('shuvecha')->headquarter_id;
        $headquarter = $this->HeadquarterList($headquarter_id);
        $url = url('/leave');
        return view('leave_request',compact('url','headquarter'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'headquarter_id' => 'required',
                'purpose' => 'required',
                'date_from' => 'required',
                'date_to' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $leave = new LeaveRequest;
        $leave->employee_id = $this->emp_id();
        $leave->role_id = $this->role_id();
        $leave->purpose = $request->purpose;
        $leave->date_from = $request->date_from;
        $leave->date_to = $request->date_to;
        $leave->headquarter_id = $request->headquarter_id;
        $leave->created_at = curDate();
        $leave->updated_at = curDate();
        $data = $leave->save();

        if($data):
            $request->session()->flash('success', 'Leave data Uploaded');
            return redirect('leave/create');
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
        $data = Leave::find($id);

        $url = url('/specialization')."/".$id;
        if($data == false) { $data = []; }
        return view('specialization_add',compact('data','url'));
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

        $specialization = Leave::find($id);
        $specialization->specialization_name = $request->specialization_name;
        $specialization->updated_at = curDate();
        $data = $specialization->save();

        if($data):
            $request->session()->flash('success', 'Specialization data Updated');
            return redirect('/specialization');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function destroy($id)
    {
        $specialization = Leave::find($id);
        $data = $specialization->delete();
        echo ($data == true)? "success" : "failed";
    }

}
