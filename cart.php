<?php 
session_start();
if(!empty($_SESSION["cart_item"])){
	$count = count($_SESSION["cart_item"]);
} else {
	$count = 0;
	
}
?>  	
<section class="showcase">
<div class="container">
    <div class="pb-2 mt-4 mb-2 border-bottom">
    <h2>Order Details</h2>
    </div>
	<div class="row">


<div id="shopping-cart">

<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>

<html lang="en">
	<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Order Details</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />   
    <script src="https://kit.fontawesome.com/d7e2511aa0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/build.css">
	<script src="./js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	</head>
	<body>
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<thead>
	<tr>
		<th style="text-align:left;">Name</th>
		<th style="text-align:left;">SKU</th>
		<th style="text-align:right;" width="5%">Quantity</th>
		<th style="text-align:right;" width="10%">Unit Price</th>
		<th style="text-align:right;" width="10%">Price</th>
		<th style="text-align:center;" width="5%">Remove</th>
	</tr>	
</thead>
<tbody id="render-cart-data">
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr id="<?php echo $item["sku"]; ?>">
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image"/><?php echo $item["name"]; ?></td>
				<td><?php echo $item["sku"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a data-sku="<?php echo $item["sku"]; ?>" class="text-danger btnRemoveAction"><i class="fa fa-times" aria-hidden="true"></i></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>
	

		<tr>
			<td colspan="2" align="right">Total:</td>
			<td align="right" id="render-qty"><?php echo $total_quantity; ?></td>
			<td align="right" colspan="2" id="render-total"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
			<td></td>
		</tr>
		</tbody>
	<tfoot>
		<tr>
			<td colspan="2"><a href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
			<td></td>	
			<td colspan="3"></td>
		</tr>
	</tfoot>

</table>		
<?php
} else {
?>
		<table class="tbl-cart" cellpadding="10" cellspacing="1">
			<thead></thead>
			<tbody id="render-cart-data">
				<tr>
					<td colspan="4"><div class="no-records">Sorry! Your Cart is Empty</div></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2"><a href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
				</tr>
			</tfoot>
		</table>
<?php 
}
?>
</div>
</div>
</div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js" integrity="sha512-eUQ9hGdLjBjY3F41CScH3UX+4JDSI9zXeroz7hJ+RteoCaY+GP/LDoM8AO+Pt+DRFw3nXqsjh9Zsts8hnYv8/A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
<script  src="./js/main.js"></script>
<script type="text/javascript">
	jQuery(document).on('click', 'a.btnRemoveAction', function() {
		var sku = jQuery(this).data('sku');
		jQuery.ajax({
			type:'POST',
			url:'remove.php',
			data:{sku:sku},
			dataType:'json',        
			success: function (json) {
				if(json.total_quantity) {
					jQuery('#cart-count').html(json.count);
					jQuery('#render-qty').html(json.total_quantity);
					jQuery('#render-total').html("$ "+json.total_price);
					jQuery("#"+sku).empty();
				} else {
					jQuery('#render-cart-data').empty();
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}        
		});
	});
</script>
</body>
</html>	