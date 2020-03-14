<?php

if (!isset($_SESSION['CUSID'])){
redirect(web_root."index.php");
}




$customerid =$_SESSION['CUSID'];
$customer = New Customer();
$singlecustomer = $customer->single_customer($customerid);

  ?>

<?php
  $autonumber = New Autonumber();
  $res = $autonumber->set_autonumber('ordernumber');
?>


<form onsubmit="return orderfilter()" action="customer/controller.php?action=processorder" method="post" >
<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Order Details</li>
        </ol>
      </div>
      <div class="row">
    <div class="col-md-6 pull-left">
      <div class="col-md-2 col-lg-2 col-sm-2" style="float:left">
        Name:
      </div>
      <div class="col-md-8 col-lg-10 col-sm-3" style="float:left">
        <?php echo $singlecustomer->FNAME .' '.$singlecustomer->LNAME; ?>
      </div>
       <div class="col-md-2 col-lg-2 col-sm-2" style="float:left">
        Address:
      </div>
      <div class="col-md-8 col-lg-10 col-sm-3" style="float:left">
        <?php echo $singlecustomer->CITYADD; ?>
      </div>
    </div>

    <div class="col-md-6 pull-right">
    <div class="col-md-10 col-lg-12 col-sm-8">
    <input type="hidden" value="<?php echo $res->AUTO; ?>" id="ORDEREDNUM" name="ORDEREDNUM">
      Order Number :<?php echo $res->AUTO; ?>
    </div>
    </div>
 </div>
      <div class="table-responsive cart_info">

              <table class="table table-condensed" id="table">
                <thead >
                <tr class="cart_menu">
                  <th style="width:12%; align:center; ">Product</th>
                  <th >Description</th>
                  <th style="width:15%; align:center; ">Quantity</th>
                  <th style="width:15%; align:center; ">Price</th>
                  <th style="width:15%; align:center; ">Total</th>
                  </tr>
                </thead>
                <tbody>

              <?php

              $tot = 0;
                if (!empty($_SESSION['gcCart'])){
                      $count_cart = @count($_SESSION['gcCart']);
                      for ($i=0; $i < $count_cart  ; $i++) {

                      $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
                           WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  and p.PROID='".$_SESSION['gcCart'][$i]['productid']."'";
                        $mydb->setQuery($query);
                        $cur = $mydb->loadResultList();
                        foreach ($cur as $result){
              ?>

                         <tr>
                         <!-- <td></td> -->
                          <td><img src="admin/products/<?php echo $result->IMAGES ?>"  width="50px" height="50px"></td>
                          <td><?php echo $result->PRODESC ; ?></td>
                          <td align="center"><?php echo $_SESSION['gcCart'][$i]['qty']; ?></td>
                          <td>NGN <?php echo  $result->PRODISPRICE ?></td>
                          <td>NGN <output><?php echo $_SESSION['gcCart'][$i]['price']?></output></td>
                        </tr>
              <?php
              $tot +=$_SESSION['gcCart'][$i]['price'];
                        }

                      }
                }
              ?>


                </tbody>

              </table>
                <div class="  pull-right">
                  <p align="right">
                  <div > Total Price :   NGN <span id="sum">0.00</span></div>
                   <div > Delivery Fee : NGN <span id="fee">0.00</span></div>
                   <div> Overall Price : NGN <span id="overall"><?php echo $tot ;?></span></div>
                   <input type="hidden" name="alltot" id="alltot" value="<?php echo $tot ;?>"/>
                  </p>
                </div>

      </div>
    </div>
  </section>

 <section id="do_action">
    <div class="container">

      <div class="row">
         <div class="row">
           <div class="col-md-7">

              <div class="form-group">
                  <label> Payment Method : </label><br/>
                  <?php check_message();?>
                  <div class="radio" >
                    <label >
                    <input type="radio"  class="paymethod" name="paymethod" value="Credit Card" checked="true" data-toggle="collapse" data-parent="#accordion" data-target="#collapseCard">Credit Card
                    </label>
                  </div>
                    <div id="collapseCard" class="panel-collapse collapse">
                      <div class="panel-body">
                        <!--<form method="post" action="customer/controller.php?action=creditcard" id="inner-form">-->
                            <div class="row">
                              <div class="col-md-8"><input type="text" class="form-control" name="card_name" placeholder="Name on Card"></div>
                              <div class="col-md-4"></div>
                            </div><br/>
                            <div class="row">
                              <div class="col-md-8"><input type="text" class="form-control" name="card_number" placeholder="Card Number"></div>
                              <div class="col-md-4"></div>
                            </div><br/>
                            <div class="row">
                              <div class="col-md-4"><input type="text" class="form-control" name="expa_date" placeholder="Expiry Date(mm/yy)"></div>
                              <div class="col-md-4"><input type="text" class="form-control" name="card_cvv" placeholder="CVV"></div>
                              <div class="col-md-4"></div>
                            </div>
                            <!--<input type="submit" class="btn btn-blcok btn-sm btn-primary" formaction="customer/controller.php?action=creditcard" value="PAY" form="inner-form" />-->
                         <!--</form>-->
                        </div>
                      </div>
                  <div class="radio" >
                  <label >
                  <input type="radio"  class="paymethod" name="paymethod" id="deliveryfee" value="Cash on Delivery" data-toggle="collapse"  data-parent="#accordion" data-target="#collapseOne" >Cash on Delivery
                  </label>
                    </br/>
                  </div>
                  <div class="radio" >
                  <label >
                  <input type="radio"  class="paymethod" name="paymethod" id="deliveryfee" value="PayPal" data-toggle="collapse"  data-parent="#accordion" data-target="#paypal" >PayPal
                  </label>
                    </br/>
                  </div>
                  <div id="paypal" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-8"><input type="text" class="form-control" name="paypal-email" placeholder="Paypal Email"></div>
                          <div class="col-md-4"></div>
                        </div>
                      </div>
                  </div>
              </div>
                        <div class="panel">
                                <div class="panel-body">
                                    <div class="form-group ">
                                      <label>Address where to deliver item(s)</label>


                                        <div class="col-md-12">
                                          <label class="col-md-4 control-label" for=
                                          "PLACE">Place(Address):</label>

                                          <div class="col-md-8">
                                           <select class="form-control paymethod" name="PLACE" id="PLACE" onchange="validatedate()">
                                           <option value="0" >Select</option>
                                            <?php
                                              $query = "SELECT * FROM `tblsetting` ";
                                              $mydb->setQuery($query);
                                              $cur = $mydb->loadResultList();

                                              foreach ($cur as $result) {
                                                echo '<option value='.$result->DELPRICE.'>'.$result->PLACE.' </option>';
                                              }
                                            ?>
                                          </select>
                                          </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        <input type="hidden"  placeholder="HH-MM-AM/PM"  id="CLAIMEDDATE" name="CLAIMEDDATE" value="<?php echo date('y-m-d h:i:s') ?>"  class="form-control"/>

                   </div>



              </div>
<br/>
              <div class="row">
                <div class="col-md-6">
                    <a href="index.php?q=cart" class="btn btn-default pull-left"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>View Cart</strong></a>
                   </div>
                  <div class="col-md-6">
                      <button type="submit" class="btn btn-pup  pull-right " name="btn" id="btn" onclick="return validatedate();"   /> Submit Order <span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
              </div>

      </div>
    </div>
  </section><!--/#do_action-->
</form>