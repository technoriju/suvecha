<?php
   namespace App\Traits;
   use App\Models\{DistrictList,Headquarter,Area,Role,Specialization,Pharmacy,Doctor,Medicine,Stockist};
   use Illuminated\Support\Facades\Session;
   trait HelperTrait
   {
      public function emp_id()
      {
        return session('shuvecha')->id ?? 0;
      }

      public function role_id()
      {
        return session('shuvecha')->role_id ?? 0;
      }

      public function hq_id()
      {
        return session('shuvecha')->headquarter_id ?? 0;
      }

      public function DistrictList($id = 0)
      {
            if($id != 0):
                $id = explode(',',$id);
                return DistrictList::join('headquarters','headquarters.district_id','=','district_lists.id')
                    ->where('headquarters.id',$id[0])->first();
            else:
                return DistrictList::get();
            endif;

      }
      public function HeadquarterList($id = 0)
      {
            $id = ($id != 0)? $id = explode(',',$id):array();
            $headq = Headquarter::select('id','headquarter_name');
            if(count($id) == 1):
            $headq->where('id',$id[0]);
            elseif(count($id) > 1):
            $headq->where(function($query) use ($id){
                $query->where('id',$id[0]);
                for($i=1;$i<count($id);$i++):
                    $query->orWhere('id',$id[$i]);
                endfor;
            });
            endif;
            $headquarter = $headq->get();
            return $headquarter;
      }
      public function headquarter_all()
      {
            $id = explode(',',$id);
            $headq = Headquarter::select('id','headquarter_name');
            if(count($id) == 1):
            $headq->where('id',$id[0]);
            else:
            $headq->where(function($query) use ($id){
                $query->where('id',$id[0]);
                for($i=1;$i<count($id);$i++):
                    $query->orWhere('id',$id[$i]);
                endfor;
            });
            endif;
            $headquarter = $headq->get();
            return $headquarter;
      }
      public function AreaList($id)
      {
            $id = explode(',',$id);
            $area = Area::select('areas.id','area_name')->join('headquarters','headquarters.id','=','areas.headquarter_id');
            if(count($id) == 1):
            $area->where('headquarters.id',$id[0]);
            else:
            $area->where(function($query) use ($id){
                $query->where('headquarters.id',$id[0]);
                for($i=1;$i<count($id);$i++):
                    $query->orWhere('headquarters.id',$id[$i]);
                endfor;
            });
            endif;
            $arealist = $area->get();
            return $arealist;
      }
      public function AreaListTa($id)
      {
            $area = Area::select('areas.id','area_name')->where(['headquarter_id'=>$id])->get();
            return $area;
      }
      public function Role()
      {
            return Role::get();
      }
      public function SpecializationsList()
      {
            return Specialization::get();
      }
      public function MedicineList()
      {
            return Medicine::get();
      }
      public function PharmacyList($area_id)
      {
        return Pharmacy::select('id','pharmacy_name')->where(['employee_id'=>$this->emp_id(),'area_id'=>$area_id])->get();
      }
      public function StockistList($area_id)
      {
        return Stockist::select('id','store_name')->where(['employee_id'=>$this->emp_id(),'area_id'=>$area_id])->get();
      }
      public function DoctorList($area_id)
      {
        return Doctor::select('id','doctor_name')->where(['employee_id'=>$this->emp_id(),'area_id'=>$area_id])->get();
      }

      function getAddress($latitude,$longitude)
       {
            if(!empty($latitude) && !empty($longitude))
            {
                //https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=YOUR_API_KEY
                $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=true_or_false&key=AIzaSyCfdaLbOl00bcc5pXCpnRHK6hdm10syV5U');
                // json format
                $output = json_decode($geocodeFromLatLong);
                // array format
                // $output = json_decode($geocodeFromLatLong,true);

                $status = $output->status;
                //Get address from json data
                echo "<pre>";
                print_r($output);
                $address = ($status=="OK")?$output->results[1]->formatted_address:'';
                //Return address of the given latitude and longitude
                if(!empty($address)){
                    return $address;
                }else{
                    return false;
                }
            } else { return false; }
       }


        // $latitude = $_POST['latitude'];
        // $longitude = $_POST['longitude'];

        // $address = getAddress($latitude,$longitude);
        // echo $address = $address?$address:'Not found';

   }
?>
