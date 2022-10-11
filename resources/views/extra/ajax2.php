<?php
  ob_start();
?>
<?php
 error_reporting(0);
 include_once "conn.php";

 if(isset($_POST[product_id])) 
 {
   $qry=mysqli_query($con,"select * from `product` where `product_id`='$_POST[product_id]'");
   $row=mysqli_fetch_assoc($qry);
  if($row[cgst]!=''){ $data['cgst']=$row[cgst]; } else { $data['cgst']=0; }
  if($row[sgst]!=''){ $data['sgst']=$row[sgst]; } else { $data['sgst']=0; }
  if($row[igst]!=''){ $data['cess']=$row[igst]; } else { $data['cess']=0; }
  $data['purchase_price']=$row[purchase_price];
  $data['qty']=$row[qty];
  
  echo json_encode($data);
 }
  
 if(isset($_POST[customer])) 
 {
   $sum=0; $qty=0;
   for($i=0;$i<count($_POST[name]);$i++)
    {     
      $sum=$sum + $_POST[tprice][$i];     
    }
    $data[sum]=round($sum-$_POST[discount]);
       
     echo json_encode($data);
 } ?>
  

 