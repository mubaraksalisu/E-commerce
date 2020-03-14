<?php
session_start();
if(!empty($_GET['not-paid']) && $_GET['not-paid'] == true){
	$payment = true;
}elseif(!empty($_GET['not-paid']) && $_GET['not-paid'] == false){
	$payment = false;
}else{ $payment = false; }
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Receipt</title>
		<link rel="stylesheet" href="style.css">
		<script src="script.js"></script>
		<style>
		.print-page {
			display: inline-block;
			padding: 15px 25px;
			font-size: 24px;
			cursor: pointer;
			text-align: center;
			text-decoration: none;
			outline: none;
			color: #fff;
			background-color: #4CAF50;
			border: none;
			border-radius: 15px;
			box-shadow: 0 9px #999;
			margin-top: 40px;
			margin-left: 45%;
		}
		
		.print-page:hover {background-color: #3e8e41}
		
		.print-page:active {
			background-color: #3e8e41;
			box-shadow: 0 5px #666;
			transform: translateY(4px);
		}
		</style>
	</head>
	<body>
		<header>
			<h1>Receipt</h1>
			<address contenteditable>
				<p>Gidan Kwano</p>
				<p>Kofar ruwa<br>Kano, Nigeria 700252</p>
				<p>08069245966</p>
			</address>
		</header>
		<article>
			<h1>Recipient</h1>
			<address>
				<p>Hafsat Store</p>
			</address>
			<table class="meta">
				<tr>
					<th><span>Receipt #</span></th>
					<td><span><?php echo mt_rand(100000,999999); ?></span></td>
				</tr>
				<tr>
					<th><span>Date</span></th>
					<td><span><?php echo date("Y-m-d"); ?></span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span contenteditable>Item Id</span></th>
						<th><span contenteditable>Rate</span></th>
						<th><span contenteditable>Quantity</span></th>
						<th><span contenteditable>Price</span></th>
					</tr>
				</thead>
				<tbody>

						<?php
						$all_total = 0;
						$count_cart = count($_SESSION['gcCart']);
						for ($i=0; $i < $count_cart  ; $i++) {
						echo "<tr>";
						echo "<td><a class='cut'>-</a><span></span>" .$_SESSION['gcCart'][$i]['productid']. "</span></td>";
						echo "<td><span data-prefix>NGN</span><span>" .$_SESSION['gcCart'][$i]['price']. "</span></td>";
						echo "<td><span>" .$_SESSION['gcCart'][$i]['qty']. "</span></td>";
						$single_total = $_SESSION['gcCart'][$i]['price'] * $_SESSION['gcCart'][$i]['qty'];
						$all_total += $single_total;
						echo "<td><span data-prefix>NGN</span><span>" .$single_total. "</span></td>";
						echo "<br>";
						echo "</tr>";
					}
					?>

				</tbody>
			</table>
			<table class="balance">
				<tr>
					<th><span>Total</span></th>
					<td><span data-prefix>NGN</span><span><?php echo $all_total; ?></span></td>
				</tr>
				<tr>
					<th><span>Amount Paid</span></th>
					<td><span data-prefix>NGN</span><span><?php if($payment == false){echo $all_total;}else{echo 0.0;} ?></span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1><span>Additional Notes</span></h1>
			<div>
				<p>You will be contacted upon arrival of your item(s)</p>
			</div>
		</aside>
		<?php
		unset($_SESSION['gcCart']);
		unset($_SESSION['orderdetails']);
		?>
		<button class="print-page" onclick="window.print();">Print</button>
	</body>
</html>