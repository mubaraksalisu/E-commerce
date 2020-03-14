<?php
session_start();
    $count_cart = count($_SESSION['gcCart']);
    for ($i=0; $i < $count_cart  ; $i++) {

$order = New Order();
$order->PROID		    = $_SESSION['gcCart'][$i]['productid'];
$order->ORDEREDQTY		= $_SESSION['gcCart'][$i]['qty'];
$order->ORDEREDPRICE	= $_SESSION['gcCart'][$i]['price'];
$order->ORDEREDNUM		= $_POST['ORDEREDNUM'];
$order->create();

$product = New Product();
$product->qtydeduct($_SESSION['gcCart'][$i]['productid'],$_SESSION['gcCart'][$i]['qty']);


$summary = New Summary();
$summary->ORDEREDDATE 	= date("Y-m-d h:i:s");
$summary->CUSTOMERID		= $_SESSION['CUSID'];
$summary->ORDEREDNUM  	= $_POST['ORDEREDNUM'];
$summary->DELFEE  		= $_POST['PLACE'];
$summary->PAYMENTMETHOD	= $_POST['paymethod'];
$summary->PAYMENT 		= $_POST['alltot'];
$summary->ORDEREDSTATS 	= 'Paid';
$summary->CLAIMEDDATE		= $_POST['CLAIMEDDATE'];
$summary->ORDEREDREMARKS 	= 'Your order is on the way.';
$summary->HVIEW 			= 0	;
$summary->create();
}




$autonumber = New Autonumber();
$autonumber->auto_update('ordernumber');


//unset($_SESSION['gcCart']);
//unset($_SESSION['orderdetails']);
if($_POST['paymethod'] == "Cash on Delivery"){
  $not_paid = true;
}else{ $not_paid = false; }
message("Order created successfully!", "success");
redirect(web_root."receipt.php?not-paid=$not_paid");

?>