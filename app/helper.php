<?php
   use Carbon\Carbon;
   use App\Models\{Headquarter,Pharmacy,Medicine,Area};
   use App\Traits\HelperTrait;

   function PharmacyName($id)
   {
      $id = explode(',',$id);
      for($i=0;$i<count($id);$i++):
         $data[] = Pharmacy::select('pharmacy_name')->find($id[$i]);
      endfor;
      return $data;
   }

   function MedicineName($id)
   {
      $id = explode(',',$id);
      for($i=0;$i<count($id);$i++):
         $data[] = Medicine::select('medicine_name')->find($id[$i]);
      endfor;
      return $data;
   }

   function AreaName($id)
   {
      $data= Area::where('id',$id)->value('area_name');
      return $data;
   }

   if(!function_exists('r')):
      function r($data)
      {
         echo "<pre>";
         print_r($data->toArray());
         echo "<pre>";
      }
   endif;

   if(!function_exists('f')):
    function f($data)
    {
       echo "<pre>";
       print_r($data);
       echo "<pre>";
    }
   endif;

  function uppercase($string)
  {
    return ucwords($string);
  }

  function dateFormat($date)
  {
    return date('d-m-Y',strtotime($date));
  }

  function df($date)
  {
    return date('d-m-Y H a',strtotime($date));
  }

  function curDate()
  {
     return date('Y-m-d H:i:s');
  }

  function dateTime($date)
  {
     return Carbon::parse($date)->format('Y-m-d h a');
  }

  function dateTime2($date)
  {
     return Carbon::parse($date)->format('jS F');
  }

  function next30Date($date)
  {
     return date("Y-m-d", strtotime($date ."+30 days"));
  }

  function AreaList2($id)
  {
      $id = explode(',',$id);
      $headq = Area::select('area_name');
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
      $area = $headq->get();
      return $area;
  }

  function HeadquarterList2($id)
  {
      $id = explode(',',$id);
      $headq = Headquarter::select('headquarter_name');
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

?>
