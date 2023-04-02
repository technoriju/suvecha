<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\{DistrictList,Headquarter,Employee};
use App\Traits\HelperTrait;
class EmployeeController extends Controller
{
    use HelperTrait;

    public function index()
    {
       $data = Employee::with('role')->orderBy('id','DESC')->get();

       if($data == false): $data = []; endif;
       return view('manage.employee_list',compact('data'));
    }

    public function create()
    {
        $headquarter = $this->HeadquarterList();
        $role = $this->Role();
        $url = url('/manage/employee');
        return view('manage.employee_add',compact('headquarter','role','url'));
    }

    public function store(Request $request)
    {
        //f($request->all()); die;
        $validator = Validator::make($request->all(),
            [
                'headquarter_id' => 'required',
                'role_id' => 'required',
                'employee_name' => 'required',
                'phone' => 'required|regex:/[6-9]{1}[0-9]{9}/',
                'password' =>'required'
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $employee = new Employee;
        $employee->headquarter_id = $request->headquarter_id;
        $employee->role_id = $request->role_id;
        $employee->phone = $request->phone;
        $employee->password = $request->password;
        $employee->employee_name = $request->employee_name;
        $employee->created_at = curDate();
        $employee->updated_at = curDate();
        $data = $employee->save();
        $employee_id = $employee->id;

        if($data):
            $request->session()->flash('success', 'Employee data Uploaded');
            return redirect('manage/employee/create');
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
        $headquarter = $this->HeadquarterList();
        $role = $this->Role();
        $data = Employee::find($id);
        $url = url('/manage/employee')."/".$id;
        if($data == false) { $data = []; }
        return view('manage.employee_add',compact('data','url','headquarter','role'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        [
            'headquarter_id' => 'required',
            'role_id' => 'required',
            'employee_name' => 'required',
            'phone' => 'required|regex:/[6-9]{1}[0-9]{9}/',
            'password' =>'required'
        ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $employee = Employee::find($id);
        $employee->headquarter_id = $request->headquarter_id;
        $employee->role_id = $request->role_id;
        $employee->phone = $request->phone;
        $employee->password = $request->password;
        $employee->employee_name = $request->employee_name;
        $employee->updated_at = curDate();
        $data = $employee->save();

        if($data):
            $request->session()->flash('success', 'Employee data Updated');
            return redirect('/manage/employee');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $data = $employee->delete();
        echo ($data == true)? "success" : "failed";
    }

}
