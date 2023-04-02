<?php
use App\Models\{RiRole,RiUser,RiUsersMembership,RiListing};
use Carbon\Carbon;
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
    
   function ui()
   {
      return session('logger_info')->id ?? 0;
   }
   function scr($val)
   {      
      $val = str_replace(' ', '-', $val);
      $val = preg_replace('/[^A-Za-z0-9\-]/', '', $val);
      return str_replace('--', '-', $val);    
   } 
  function uc($string)
  {
    return ucwords(strtolower($string));
  }

  function df($date)
  {
    return date('d-m-Y',strtotime($date));
  }  

  function cd()
  { 
     return date('Y-m-d H:i:s');
  }

  function n30D( $date, $days )
  {
     return date("Y-m-d", strtotime($date .$days." days"));
  }

   function loggerDetails( $field_name )
   {     
      return RiUser::select( $field_name )->where( 'id', ui() )->value( $field_name );
   }
    
   // Package Validation Check 23.02.23  
   function packageValidity()
   {           
      $check = RiUsersMembership::where([['user_id','=',ui()],['expire_date','<',cd()],['status','=',1]])->update(['status'=>2]); 
      if($check == true)
        RiUsersMembership::where([['user_id','=',ui()],['package_id','=',1]])->update(['status'=>1]);      
   }
   // Package Validation Expire

   function businessType()
    {
        $count = RiListing::where(['user_id'=>ui(),'type'=>2])->count(); 
        return ($count == 0)? 'Normal':'Business';
    }

    function packageType()
    {
       return RiUsersMembership::select('ri_packages.name','package_id')->where(['user_id'=>ui(),'ri_users_memberships.status'=>1])
              ->join('ri_packages','ri_packages.id','=','ri_users_memberships.package_id')->first();       
    }

?>