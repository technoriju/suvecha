  

 <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Work Order</label>
                            <input name="workorder" type="text" class="form-control" id="" placeholder="Work Order No" value="<?php echo $row_product[workorder] ?>">
                            <input type="hidden" name="hid" value="<?php echo $row_product[product_id] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Supplier Name</label>
                            <select name="supplier_name" class="form-control" id="" placeholder="choose Supplier">
                                <option value="">Select Supplier</option>
                                <?php
                                   $addsupp=mysqli_query($con,"select * from `add-supplier` order by `supplier_id` desc");
                                   while($row_supp=mysqli_fetch_assoc($addsupp)) { ?>
                                    <option <?php echo ($row_product[supplier]=="$row_supp[supplier_id]")? "selected":"null"; ?> value='<?php echo $row_supp[supplier_id] ?>'><?php echo $row_supp[supplier_name] ?></option>
                                <?php } ?>                     
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Quantity</label>
                            <input name="qty" type="text" class="form-control" id="qty" placeholder="Put Quantity" required value="<?php echo $row_product[qty] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Purchase Price &copy;<span id="output"></span></label>
                            <input name="purchase_price" type="text" class="form-control" id="input" placeholder="Put Purchase Price" value="<?php echo $row_product[purchase_price] ?>" required onkeyup="calculateTotal();">
                        </div>
                       <div class="form-group">
                            <label for="exampleInputPassword1">GST</label>
                             <select name="gst" class="form-control" id="" placeholder="choose GST" required>
                                <option value="">Select GST%</option>
                                <?php
                                   $addgst=mysqli_query($con,"select * from gst order by gst_id desc");
                                   while($row_addgst=mysqli_fetch_assoc($addgst)) { ?>
                                    <option <?php echo ($row_product[gst]==$row_addgst[gst_value])?"selected":"null"; ?> value='<?php echo $row_addgst[gst_value] ?>'><?php echo $row_addgst[gst_per] ?></option>
                                <?php } ?>                     
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <input name="description" type="text" class="form-control" id="" placeholder="Description" value="<?php echo $row_product[description] ?>" required>
                        </div>   
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="exampleInputEmail1">Challan No</label>
                            <input name="challan" type="text" class="form-control" id="" placeholder="Put Challan"  value="<?php echo $row_product[challan] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input name="product_name" type="text" class="form-control" id="" placeholder="Name"  value="<?php echo $row_product[product_name] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Unit</label>
                            <select name="unit" class="form-control" id="" placeholder="Name" required>
                                <option value="">Select any Unit</option>
                                <?php
                                   $addpro=mysqli_query($con,"select * from unit order by unit_id desc");
                                   while($row_addpro=mysqli_fetch_assoc($addpro)) { ?>
                                    <option <?php echo ($row_product[unit])?"selected":"null"; ?>><?php echo $row_addpro[unit_name] ?></option>
                                <?php } ?>                     
                            </select>
                        </div>  
                       <!--  <div class="form-group">
                            <label for="exampleInputEmail1">Price/Qty</label>
                            <input name="Price" type="text" class="form-control" id="" placeholder="Put Price/Qty " required>
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sell Price</label>
                            <input name="sell_price" type="text" class="form-control" id="" placeholder="Put Sell Price" value="<?php echo $row_product[sell_price] ?>" required>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">HSN/SAC Code</label>
                            <input name="hsn" type="text" class="form-control" id="" placeholder="HSN/SAC Code" value="<?php echo $row_product[hsn] ?>" required>
                        </div>  
                         <div class="form-group">
                            <label for="exampleInputEmail1">Date</label>
                            <input name="date" type="date" class="form-control" id="" value="<?php if($row_product) { echo $row_product[date]; } else { echo date('Y-m-d'); } ?>" placeholder="Y-m-d" required>
                        </div>      
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                       <?php if($_GET[view]) { ?>
                      <button type="submit" name="sub" value="submit" class="btn btn-primary">Update</button><?php } else { ?>
                      <button type="submit" name="sub" value="submit" class="btn btn-primary">Submit</button>
                       <?php }s ?>
                     </div>
                    </div>
                </div>
            </form>

  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
 <script>
          function calculateTotal(){
           var bla = $('#input').val();
           var qty = $('#qty').val();
           var total=bla*qty;
           $('#output').val(total);
       }
    </script> 