<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;
use App\Models\{TaBill,TaBillDetail,Role,Area,HeadquarterDistance};
use App\Traits\HelperTrait;
use DB;
class TaBillController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $headquarter_id = $this->hq_id();
        $headquarter = $this->HeadquarterList($headquarter_id);
        $headquarter_all = $this->HeadquarterList();
        $url = url('/ta-bill');
        return view('ta-bill',compact('headquarter','headquarter_all','url'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'headquarter_id_own' => 'required',
                'headquarter_id' => 'required',
                'station' => 'required',
                //'area_id' => 'required_if:'.$this->role_id().',==,4',
                'file_path'=>'mimes:jpg,jpeg,png,gif,csv,doc,docx,pdf|max:5000'
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $station = ($request->station==1)? 'fixed_price_x' : (($request->station==2) ? 'fixed_price_o' : 'fixed_price_h');

        $fixed_price = Role::where('id',$this->role_id())->value($station);

        $new_distance = 0;

        if(($request->headquarter_id_own == $request->headquarter_id) && (!isset($request->area_id))):

            $new_distance = 0;
            $amount = $fixed_price+$new_distance*2;

        elseif(($request->headquarter_id_own == $request->headquarter_id) && (isset($request->area_id))):

            for($i=0;$i<count($request->area_id);$i++):
                $distance = Area::where('id',$request->area_id[$i])->value('distance');
                if($distance>$new_distance)
                    $new_distance = $distance;
            endfor;
            $km = ($request->station==1)? 4 : 2;
            $amount = $fixed_price+$new_distance*$km;

        elseif(($request->headquarter_id_own != $request->headquarter_id) && (!isset($request->area_id))):

            $new_distance = HeadquarterDistance::where(['headquarter_id1'=>$request->headquarter_id_own,'headquarter_id2'=>$request->headquarter_id])
                            ->orWhere(['headquarter_id2'=>$request->headquarter_id_own,'headquarter_id1'=>$request->headquarter_id])->value('distance');

            $km = ($request->station==1)? 4 : 2;
            $amount = $fixed_price+$new_distance*$km;

        elseif(($request->headquarter_id_own != $request->headquarter_id) && (isset($request->area_id))):

            for($i=0;$i<count($request->area_id);$i++):
                $distance = Area::where('id',$request->area_id[$i])->value('distance');
                if($distance>$new_distance)
                    $new_distance = $distance;
            endfor;
            $new_distance += HeadquarterDistance::where(['headquarter_id1'=>$request->headquarter_id_own,'headquarter_id2'=>$request->headquarter_id])
                             ->orWhere(['headquarter_id2'=>$request->headquarter_id_own,'headquarter_id1'=>$request->headquarter_id])->value('distance');

            $km = ($request->station==1)? 4 : 2;
            $amount = $fixed_price+$new_distance*$km;

        endif;

        if($request->file())
        {
            $image = $request->file('file_path');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('/assets/upload/tabill'),$image_name);
            $stay_bill = "/assets/upload/tabill/" . $image_name;
        }

        $tabill = new TaBill;
        $tabill->employee_id = $this->emp_id();
        $tabill->role_id = $this->role_id();
        $tabill->date = $request->date;
        $tabill->headquarter_id_own = $request->headquarter_id_own;
        $tabill->headquarter_id = $request->headquarter_id;
        $tabill->area_id = implode(',',$request->area_id) ?? array();
        $tabill->station = $request->station ?? 0;
        $tabill->distance = $new_distance;
        $tabill->total_amount = $amount;
        $tabill->stay_bill = $stay_bill ?? '';
        $tabill->created_at = curDate();
        $tabill->updated_at = curDate();
        $data = $tabill->save();
        $id = $tabill->id;

        if($data):
            $request->session()->flash('success', 'T.A Bill data Uploaded');
            return redirect('ta-bill/list');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function list()
    {
        $role = Role::join('role_permissions','role_permissions.permission_id','=','roles.id')
                ->where(['role_permissions.role_id'=>$this->role_id()])->get();

        $employee = DB::table('employees')->select('employees.id','employees.employee_name')->join('role_permissions','role_permissions.permission_id','=','employees.role_id')
                  ->where(['role_permissions.role_id'=>$this->role_id()])->get();
       // r($employee); die;
        $data2 = TaBill::select(['ta_bills.*','headquarters.headquarter_name','employees.employee_name',
                DB::raw("(select headquarter_name from headquarters where headquarters.id = ta_bills.headquarter_id_own) as headown")])
                  ->join('employees','employees.id','=','ta_bills.employee_id')
                  ->join('headquarters','headquarters.id','=','ta_bills.headquarter_id')
                  ->join('role_permissions','role_permissions.permission_id','=','ta_bills.role_id')
                 ->where(['role_permissions.role_id'=>$this->role_id()]);
                if($this->role_id() == 4):
                $data2->where(['ta_bills.role_id'=>$this->role_id()]);
                endif;
                $data = $data2->orderBy('ta_bills.id','DESC')->get();
        if($data == false): $data = []; endif;
        //r($data); die;
        return view('ta-bill-list',compact('data','role','employee'));
    }

    public function fetchArea(Request $request)
    {
       $area = $this->AreaListTa($request->headquarter_id);
       //dd($area); die;
       if(count($area)>0):
            echo '<option value="0" selected>Choose any Area</option>';
            foreach($area as $val):
                echo "<option value=".$val->id.">".$val->area_name."</option>";
            endforeach;
       else:
           echo '<option value="0" selected>No Area Found</option>';
       endif;
    }

}
