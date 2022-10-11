<?php
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

?>
