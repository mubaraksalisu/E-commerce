<?php
require_once ("../include/initialize.php");

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;

	case 'edit' :
	doEdit();
	break;

	case 'creditcard' :
	creditCard();
	break;

	case 'delete' :
	doDelete();
	break;



	case 'processorder' :
	processorder();
	break;

	case 'addwish' :
	addwishlist();
	break;

	case 'wishlist' :
	processwishlist();
	break;

	case 'photos' :
	doupdateimage();
	break;

	case 'changepassword' :
	doChangePassword();
	break;


	}


function doInsert(){
	global $mydb;
	if(isset($_POST['submit'])){
						$address = $_POST['CITYADD'].", ".$_POST['lga'].", ".$_POST['state'];

						$customer = New Customer();
						$customer->FNAME 			= $_POST['FNAME'];
						$customer->LNAME 			= $_POST['LNAME'];
						$customer->CITYADD  		= $address;
						$customer->GENDER 			= $_POST['GENDER'];
					 	$customer->PHONE 			= $_POST['PHONE'];
						$customer->CUSUNAME			= $_POST['CUSUNAME'];
						$customer->CUSPASS			= sha1($_POST['CUSPASS']);
						$customer->DATEJOIN 		= date('Y-m-d h-i-s');
						$customer->TERMS 			= 1;
						$customer->create();


						$email = trim($_POST['CUSUNAME']);
						$h_upass = sha1(trim($_POST['CUSPASS']));


						//it creates a new objects of member
					    $user = new Customer();
					    //make use of the static function, and we passed to parameters
					    $res = $user->cusAuthentication($email, $h_upass);


			 if(!isset($_POST['proid'])){
			  echo "<script> alert('You are now successfully registered. It will redirect to your order details.'); </script>";
						redirect(web_root."index.php?q=orderdetails");
			 }else{
			 	$proid = $_POST['proid'];
			 	$id = mysqli_insert_id();
			 	$query ="INSERT INTO `tblwishlist` (`PROID`, `CUSID`, `WISHDATE`, `WISHSTATS`)  VALUES ('{$proid}','{$id}','".DATE('Y-m-d')."',0)";
			 	$mydb->setQuery($query);
			 	$mydb->executeQuery();
			 	 echo "<script> alert('You are now successfully registered. It will redirect to your profile.'); </script>";
						redirect(web_root."index.php?q=profile");
			 }



	  }
	}

	function doEdit(){
		if(isset($_POST['save'])){



			$customer = New Customer();
			// $customer->CUSTOMERID 		= $_POST['CUSTOMERID'];
			$customer->FNAME 			= $_POST['FNAME'];
			$customer->LNAME 			= $_POST['LNAME'];
			// $customer->MNAME 			= $_POST['MNAME'];
			// $customer->CUSHOMENUM 		= $_POST['CUSHOMENUM'];
			// $customer->STREETADD		= $_POST['STREETADD'];
			// $customer->BRGYADD 			= $_POST['BRGYADD'] ;
			$customer->CITYADD  		= $_POST['CITYADD'];
			// $customer->PROVINCE 		= $_POST['PROVINCE'];
			// $customer->COUNTRY 			= $_POST['COUNTRY'];
			$customer->GENDER 			= $_POST['GENDER'];
		 	$customer->PHONE 			= $_POST['PHONE'];
			// $customer->ZIPCODE 			= $_POST['ZIPCODE'];
			$customer->CUSUNAME			= $_POST['CUSUNAME'];
			// $customer->CUSPASS			= sha1($_POST['CUSPASS']);
			$customer->update($_SESSION['CUSID']);


			message("Accounts has been updated!", "success");
			redirect(web_root.'index.php?q=profile');
		}
	}


	function doDelete(){

		if(isset($_SESSION['U_ROLE'])=='Customer'){

			if (isset($_POST['selector'])==''){
			message("Select the records first before you delete!","error");
			redirect(web_root.'index.php?page=9');
			}else{

			$id = $_POST['selector'];
			$key = count($id);

			for($i=0;$i<$key;$i++){

			$order = New Order();
			$order->delete($id[$i]);

			message("Order has been Deleted!","info");
			redirect(web_root."index.php?q='product'");


		}


		}
	}else{

		if (isset($_POST['selector'])==''){
			message("Select the records first before you delete!","error");
			redirect('index.php');
			}else{

			$id = $_POST['selector'];
			$key = count($id);

			for($i=0;$i<$key;$i++){

			$customer = New Customer();
			$customer->delete($id[$i]);

			$user = New User();
			$user->delete($id[$i]);

			message("Customer has been Deleted!","info");
			redirect('index.php');

			}
		}

	}

	}


		function processorder(){



		//	$_SESSION['ORDEREDNUM'] = $_POST['ORDEREDNUM'];


		 	// $autonumber = New Autonumber();
 			// $res = $autonumber->set_autonumber('ordernumber');

			if(isset($_POST['paymethod']) && $_POST['paymethod'] == 'Cash on Delivery'){
				require_once ("submitorder.php");


			}elseif(isset($_POST['paymethod']) && $_POST['paymethod'] == 'Credit Card'){
				$error_message = creditCard();
				if(!empty($error_message)){
					$errors = implode(', ', $error_message);
					message("{$errors}", "error");
					redirect(web_root."index.php?q=orderdetails");
				}else{
					require_once ("submitorder.php");
				}
			}elseif (isset($_POST['paymethod']) && $_POST['paymethod'] == 'PayPal') {
				if(empty($_POST['paypal-email'])){
					message("In order to use paypal, please provide paypal email", "error");
					redirect(web_root."index.php?q=orderdetails");
				}else{
					$email = trim($_POST['paypal-email']);
					if(!preg_match("(^[-\w\.]+@([-a-z0-9]+\.)+[a-z]{2,4}$)i", $email)){
						message("Please provide a valid email", "error");
						redirect(web_root."index.php?q=orderdetails");

					}
				}
				require_once ("submitorder.php");
			}
		}



	function processwishlist(){
		global $mydb;
		if(isset($_GET['wishid'])){

		  $query ="UPDATE `tblwishlist` SET `WISHSTATS`=1  WHERE `WISHLISTID`=" .$_GET['wishid'];
	      $mydb->setQuery($query);
	      $res = $mydb->executeQuery();
		 if (isset($res)){
		 		message("Product has been removed in your wishlist", "success");
			redirect(web_root."index.php?q=profile");
		 }



		}


		}


	function addwishlist(){
		global $mydb;

		$proid = $_GET['proid'];
		$id =$_SESSION['CUSID'];

		$query="SELECT * FROM `tblwishlist` WHERE  CUSID=".$id." AND `PROID` =" .$proid ;
		$mydb->setQuery($query);
		$res = $mydb->executeQuery();
		$maxrow = $mydb->num_rows($res);

		if($maxrow>0){
				message("Product is already added to your wishlist", "error");
				redirect(web_root."index.php?q=profile");
		}else{
				$query ="INSERT INTO `tblwishlist` (`PROID`, `CUSID`, `WISHDATE`, `WISHSTATS`)  VALUES ('{$proid}','{$id}','".DATE('Y-m-d')."',0)";
				$mydb->setQuery($query);
				$mydb->executeQuery();

	 	message("Product has been added to your wishlist", "success");
			redirect(web_root."index.php?q=profile");
		}




		}
		function doupdateimage(){

			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="customer_image/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect(web_root. "index.php?q=profile");
		}else{

				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']);
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message(web_root. "Uploaded file is not an image!", "error");
				redirect(web_root. "index.php?q=profile");
			}else{
					//uploading the file
					move_uploaded_file($temp,"customer_image/" . $myfile);


						$customer = New Customer();
						$customer->CUSPHOTO 		= $location;
						$customer->update($_SESSION['CUSID']);

						redirect(web_root. "index.php?q=profile");


					}
			}

		}


		function doChangePassword(){
			if (isset($_POST['save'])) {
				# code...
				$customer = New Customer();
				$customer->CUSPASS			= sha1($_POST['CUSPASS']);
				$customer->update($_SESSION['CUSID']);


			message("Password has been updated!", "success");
			redirect(web_root.'index.php?q=profile');
			}
		}

		function creditCard(){
			$error = [];
			if(empty($_POST['card_name'])){
				array_push($error, "card name is required");
			}else{
				$card_name = trim($_POST['card_name']);
				if(!preg_match("/^[a-zA-Z ]*$/", $card_name)){

					array_push($error, "Card name must contain only letters and white space");
				}
			}
			if(empty($_POST['card_number'])){

				array_push($error, "Card number is required");
			}else{
				$card_number = trim($_POST['card_number']);
				if(strlen($card_number) != 16) {

					array_push($error, "Incorrect card number, it's the 16 digit in the front of your card");
				}
			}
			if(empty($_POST['card_cvv'])){

				array_push($error, "Card CVV is required");
			}else{
				$card_cvv = trim($_POST['card_cvv']);
				if(strlen($card_cvv) != 3) {

					array_push($error, "Incorrect cvv number, it's the 3 digit at the back of your card");
				}
			}
			if(empty($_POST['expa_date'])){

				array_push($error, "Card expiry date is required");
			}else{
				$expiry = trim($_POST['expa_date']);
				if(!(preg_match("/^(\d{2})\/(\d{2})$/", $expiry))) {

					array_push($error, "Please follow the date format as shown in the date text area");
				}
			}
			return $error;
		}

		function submit_order(){
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
			$summary->ORDEREDSTATS 	= 'Pending';
			$summary->CLAIMEDDATE		= $_POST['CLAIMEDDATE'];
			$summary->ORDEREDREMARKS 	= 'Your order is on process.';
			$summary->HVIEW 			= 0	;
			$summary->create();
			}




		$autonumber = New Autonumber();
		$autonumber->auto_update('ordernumber');


		unset($_SESSION['gcCart']);
		unset($_SESSION['orderdetails']);

		message("Order created successfully!", "success");
		redirect(web_root."index.php?q=profile");
		}
?>