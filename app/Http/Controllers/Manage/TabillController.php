<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\{DistrictList,Headquarter,Employee,Role,TaBill};
use App\Traits\HelperTrait;
use DB;
class TabillController extends Controller
{
    use HelperTrait;

    public function index(Request $request)
    {
        $url = url('/manage/ta-bill');
        $role = Role::get();
        $form_data = $request->all() ?? '';
        $employee = Employee::select('employees.id','employees.employee_name')->get();

        $data2 = TaBill::select(['ta_bills.*','headquarters.headquarter_name','employees.employee_name',
                DB::raw("(select headquarter_name from headquarters where headquarters.id = ta_bills.headquarter_id_own) as headown")])
                ->join('employees','employees.id','=','ta_bills.employee_id')
                ->join('headquarters','headquarters.id','=','ta_bills.headquarter_id');

                if($request->dateFrom != ''):
                    $data2->whereBetween('date', [$request->dateFrom, $request->dateTo]);
                endif;

                if($request->role != ''):
                    $data2->where(['ta_bills.role_id'=>$request->role]);
                endif;

                if($request->emp != ''):
                    $data2->where(['ta_bills.employee_id'=>$request->emp]);
                endif;

                $data = $data2->orderBy('ta_bills.id','DESC')->paginate(10);
        if($data == false): $data = []; endif;
        //r($data); die;
        if($request->all())
          return view('manage.ta-bill',compact('data','role','employee','url','form_data'));
        else
          return view('manage.ta-bill',compact('data','role','employee','url'));
    }

    public function empfetch(Request $request)
    {
        $data = Employee::where('role_id',$request->id)->orderBy('id','DESC')->get();
        if(isset($data) && count($data)>0):
            $rec['val'] = "<option value=''>Select Emplyee</option>";
            foreach($data as $val):
             $rec['val'].= "<option value='$val->id'>$val->employee_name</option>";
            endforeach;
        endif;
        echo json_encode($rec);
    }

}
