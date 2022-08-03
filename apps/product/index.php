<?php 
/*$shop_url = $_GET['shop'];
header('Location: install.php?shop=' .$shop_url);
exit();
*/


require_once("inc/functions.php");
echo "<link rel='stylesheet' type='text/css' href='css/style.css' />";


$requests = $_GET;
$hmac = $_GET['hmac'];
$serializeArray = serialize($requests);

$requests = array_diff_key($requests, array('hmac' => ''));
ksort($requests);
$token = "shpua_6b104e9ad14f1f486166def72ea78648";
$shop = "centire5.myshopify.com";

// Run API call to get products
$products = shopify_call($token, $shop, "/admin/products.json", array(), 'GET');

// Convert product JSON information into an array
$products = json_decode($products['response'], JSON_PRETTY_PRINT);

//print_r($products);

/*$productList = shopify_call($token, $shop, "/admin/api/2021-10/products.json", array(), 'GET');
$productList = json_decode($productList['response'], JSON_PRETTY_PRINT);
print_r($productList);*/





/*
$collectionList = json_decode($collectionList['response'], JSON_PRETTY_PRINT);
$collection_id = $collectionList['custom_collections'][0]['id'];

$array = array("collection_id"=>$collection_id);
$collects = shopify_call($token, $shop, "/admin/api/2021-01/collects.json", $array, 'GET');
$collects = json_decode($collects['response'], JSON_PRETTY_PRINT);
*/

$collection_id = "287066947760";
$array = array("collection_id"=>$collection_id);
$collects = shopify_call($token, $shop, "/admin/api/2021-01/collects.json", $array, 'GET');
$collects = json_decode($collects['response'], JSON_PRETTY_PRINT);
/*print_r($collects);
die();*/
foreach($collects as $collect){
	echo '<div class="wrapper"><h1>Mens Collection Products List</h1>';
	echo '<table id="products" class="table table-striped table-bordered dataTable">';
	echo '<thead>';
	echo '<tr><th><strong>Title:</strong></th><th><strong>Price:</strong></th><th><strong>Image:</strong></th><th><strong>Vendor:</strong></th><th><strong>Tags:</strong></th></tr>';
	echo '</thead><tbody><tr>';
    foreach($collect as $key => $value){
    	$products = shopify_call($token, $shop, "/admin/api/2021-01/products/".$value['product_id'].".json", array(), 'GET');
		$products = json_decode($products['response'], JSON_PRETTY_PRINT);
		$img_src = $products['product']['images'][0]['src'];
		$product_price = $products['product']['variants'][0]['price'];
		echo '<tr>';
		echo '<td> '.$products['product']['title'].'</td>';
		echo '<td> '.$products['product']['variants'][0]['price'].'</td>';
		echo '<td> <img src="'.$img_src.'" alt="" class="pr-image"/> </td>';
		echo '<td> '.$products['product']['vendor'].'</td>';
		echo '<td> '.$products['product']['tags'].'</td>';
		echo '</tr>';
    }
    echo '</tbody></table></div>';
}

/*$orders = shopify_call($token, $shop, "/admin/api/2021-01/orders.json", array(), 'GET');
$orders = json_decode($orders['response'], JSON_PRETTY_PRINT);
//print_r($orders);
foreach($orders as $order){
	echo '<pre>';
	print_r($order);
	echo '</pre>';
	echo $order->line_items->title;
}*/

?>