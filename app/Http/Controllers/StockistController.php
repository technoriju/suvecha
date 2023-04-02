<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;
use App\Models\{Stockist,StockistActivity};
use App\Traits\HelperTrait;
class StockistController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $data2 = Stockist::with('headquarter','area')->select('stockists.*')
        ->join('role_permissions','role_permissions.permission_id','=','stockists.role_id')
        ->join('employees',\DB::raw("FIND_IN_SET(stockists.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
        ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
        if($this->role_id() == 4):
         $data2->where(['stockists.role_id'=>$this->role_id()]);
        endif;
        $data = $data2->orderBy('stockists.id','DESC')->get();

       if($data == false): $data = []; endif;
       return view('stockist_list',compact('data'));
    }

    public function indexActivity()
    {
       $data2 = StockistActivity::select('stockists.*','stockist_activities.*','headquarter_name','area_name')
               ->join('stockists','stockists.id','=','stockist_activities.stockist_id')
               ->join('headquarters','headquarters.id','=','stockists.headquarter_id')
               ->join('areas','areas.id','=','stockists.area_id')
               ->join('role_permissions','role_permissions.permission_id','=','stockist_activities.role_id')
               ->join('employees',\DB::raw("FIND_IN_SET(stockists.headquarter_id,employees.headquarter_id)"),">",\DB::raw("'0'"))
               ->where(['role_permissions.role_id'=>$this->role_id(),'employees.id'=>$this->emp_id()]);
               if($this->role_id() == 4):
                $data2->where(['stockists.role_id'=>$this->role_id()]);
               endif;
               $data = $data2->orderBy('stockist_activities.id','DESC')->get();
       // r($data); die;
       if($data == false): $data = []; endif;
       return view('stockist_list_activity',compact('data'));
    }

    public function create(Request $request)
    {
        $headquarter_id = session('shuvecha')->headquarter_id;
        $headquarter = $this->HeadquarterList($headquarter_id);
        $url = url('/stockist');
        return view('stockist_add',compact('headquarter','url'));
    }

    public function store(Request $request)
    {
        //f($request->all()); die;
        $validator = Validator::make($request->all(),
            [
                'store_name' => 'required',
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
            $image->move(public_path('/assets/upload/stockist'),$image_name);
            $file_path = "/assets/upload/stockist/" . $image_name;
        }

        $stockist = new Stockist;
        $stockist->store_name = $request->store_name;
        $stockist->address = $request->address;
        $stockist->area_id = $request->area_id;
        $stockist->phone = $request->phone;
        $stockist->employee_id = $this->emp_id();
        $stockist->headquarter_id = $request->headquarter_id;
        $stockist->dl_no = $request->dl_no ?? '';
        $stockist->file_path = $file_path ?? '';
        $stockist->role_id = $this->role_id();
        $stockist->created_at = curDate();
        $stockist->updated_at = curDate();
        $data = $stockist->save();

        if($data):
            $request->session()->flash('success', 'Stockist data Uploaded');
            return redirect('stockist/create');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function activity(Request $request)
    {
        $headquarter_id = session('shuvecha')->headquarter_id;
        $area = $this->AreaList($headquarter_id);
        $url = url('/stockist/activity');
        return view('stockist_add_activity',compact('area','url'));
    }

    public function activityUpdate(Request $request)
    {
        //$ip = $request->ip();
        $ip = '162.159.24.227';
        $currentUserInfo = Location::get($ip);

        $validator = Validator::make($request->all(),
            [
                'stockist_id' => 'required',
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
            $image->move(public_path('/assets/upload/stockist'),$image_name);
            $file_path = "/assets/upload/stockist/" . $image_name;
        }

        $stockist = new StockistActivity;
        $stockist->stockist_id = $request->stockist_id;
        $stockist->information = $request->information;
        $stockist->employee_id = $this->emp_id();
        $stockist->file_path = $file_path ?? '';
        $stockist->location = $currentUserInfo->cityName;
        $stockist->role_id = $this->role_id();
        $stockist->created_at = curDate();
        $stockist->updated_at = curDate();
        $data = $stockist->save();

        if($data):
            $request->session()->flash('success', 'Stockist Activity data Uploaded');
            return redirect('stockist/activity');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function fetchStockist(Request $request)
    {
       $stockist = $this->StockistList($request->area_id);
       if(count($stockist)>0):
            echo '<option value="">Choose any Stockist</option>';
            foreach($stockist as $val):
                echo "<option value=".$val->id.">".$val->store_name."</option>";
            endforeach;
       else:
           echo '<option value="">No Stockist Found</option>';
       endif;
    }

    public function fetchStockistInfo(Request $request)
    {
       $stockist = Stockist::select('dl_no','address','phone')->where('id',$request->id)->first();
       $data['dl_no'] = $stockist->dl_no;
       $data['address'] = $stockist->address;
       $data['phone'] = $stockist->phone;
       echo json_encode($data);
    }
}
