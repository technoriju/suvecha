<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminated\Support\Facades\Session;
use App\Models\{DistrictList,Headquarter,HeadquarterDistance};
use App\Traits\HelperTrait;
use DB;
class HeadquarterController extends Controller
{
    use HelperTrait;

    public function index()
    {
       $data = Headquarter::with('district')->orderBy('id','DESC')->get();
       if($data == false): $data = []; endif;
       return view('manage.headquarter_list',compact('data'));
    }

    public function create()
    {
        $data2 = $this->DistrictList();
        $url = url('/manage/headquarter');
        return view('manage.headquarter_add',compact('data2','url'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'district_id' => 'required',
                'headquarter_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $headquarter = new Headquarter;
        $headquarter->district_id = $request->district_id;
        $headquarter->headquarter_name = $request->headquarter_name;
        $headquarter->created_at = curDate();
        $headquarter->updated_at = curDate();
        $data = $headquarter->save();
        $headquarter_id = $headquarter->id;

        if($data):
            $request->session()->flash('success', 'Headquarter data Uploaded');
            return redirect('/manage/headquarter/create');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function edit($id)
    {
        $data2 = $this->DistrictList();
        $data = Headquarter::find($id);

        $url = url('/manage/headquarter')."/".$id;
        if($data == false) { $data = []; }
        return view('manage.headquarter_add',compact('data','url','data2'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'district_id' => 'required',
                'headquarter_name' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $headquarter = Headquarter::find($id);
        $headquarter->district_id = $request->district_id;
        $headquarter->headquarter_name = $request->headquarter_name;
        $headquarter->updated_at = curDate();
        $data = $headquarter->save();

        if($data):
            $request->session()->flash('success', 'Headquarter data Updated');
            return redirect('/manage/headquarter');
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function destroy($id)
    {
        $headquarter = Headquarter::find($id);
        $data = $headquarter->delete();
        echo ($data == true)? "success" : "failed";
    }

    public function distance()
    {
       $data = Headquarter::orderBy('id','DESC')->get();
       $data2 = HeadquarterDistance::select(['headquarter_distances.*','headquarter_name',
                DB::raw("(select headquarter_name from headquarters where headquarters.id = headquarter_distances.headquarter_id1) as headquarter_name2")])
                ->join('headquarters','headquarters.id','=','headquarter_distances.headquarter_id2')->orderBy('headquarter_distances.id','DESC')->get();

       $url = url('/manage/headquarter/distance');
       if($data == false): $data = []; endif;
       return view('manage.headquarter_distance',compact('data','data2','url'));
    }

    public function storeDistance(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'headquarterFrom' => 'required',
                'headquarterTo' => 'required',
                'distance' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        else:
          $count = HeadquarterDistance::where(['headquarter_id1'=>$request->headquarterFrom,'headquarter_id2'=>$request->headquarterTo])
                                        ->orWhere(['headquarter_id2'=>$request->headquarterFrom,'headquarter_id1'=>$request->headquarterTo])->count();
          if($count > 0):
            $request->session()->flash('error', 'Already added this distance');
            return redirect()->back();
          endif;

        endif;

        $headquarter = new HeadquarterDistance;
        $headquarter->headquarter_id1 = $request->headquarterFrom;
        $headquarter->headquarter_id2 = $request->headquarterTo;
        $headquarter->distance = $request->distance;
        $headquarter->created_at = curDate();
        $headquarter->updated_at = curDate();
        $data = $headquarter->save();

        if($data):
            $request->session()->flash('success', 'Headquarter Distance data Uploaded');
            return redirect()->back();
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

    public function distanceUpd(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'distance' => 'required',
                'distance_id' => 'required',
            ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $headquarter = HeadquarterDistance::find($request->distance_id);
        $headquarter->distance = $request->distance;
        $headquarter->updated_at = curDate();
        $data = $headquarter->save();

        if($data):
            $request->session()->flash('success', 'Headquarter Distances data Updated');
            return redirect()->back();
        else:
            $request->session()->flash('error', 'Please try again');
            return redirect()->back();
        endif;
    }

}
