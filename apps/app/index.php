<?php 
/*$shop_url = $_GET['shop'];
header('Location: install.php?shop=' .$shop_url);
exit();*/



require_once("inc/functions.php");


/*echo phpinfo();*/



$requests = $_GET;
$hmac = $_GET['hmac'];
$serializeArray = serialize($requests);
$requests = array_diff_key($requests, array('hmac' => ''));
ksort($requests);

$token = "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";
$shop = "centire5.myshopify.com";


$collectionList = shopify_call($token, $shop, "/admin/api/2021-01/custom_collections.json", array(), 'GET');
$collectionList = json_decode($collectionList['response'], JSON_PRETTY_PRINT);
$collection_id = $collectionList['custom_collections'][0]['id'];

$array = array("collection_id"=>$collection_id);
$collects = shopify_call($token, $shop, "/admin/api/2021-01/collects.json", $array, 'GET');
$collects = json_decode($collects['response'], JSON_PRETTY_PRINT);


$collection_id = "287066947760";
$array = array("collection_id"=>$collection_id);
$collects = shopify_call($token, $shop, "/admin/api/2021-01/collects.json", $array, 'GET');
$collects = json_decode($collects['response'], JSON_PRETTY_PRINT);
//print_r($collects);
//die();
foreach($collects as $collect){
	echo '<ul>';
    foreach($collect as $key => $value){
    	$products = shopify_call($token, $shop, "/admin/api/2021-01/products/".$value['product_id'].".json", array(), 'GET');
		$products = json_decode($products['response'], JSON_PRETTY_PRINT);
		$img_src = $products['product']['images'][0]['src'];
		echo '<li>';
		echo '<strong>Title</strong>: '.$products['product']['title'].'<br/> ';
		echo '<strong>Price</strong>: '.$products['product']['variants'][0]['price'].'<br/> ';
		echo '<strong>Image</strong>: <img src="'.$img_src.'" alt="" class="pr-image"/> <br/>';
		echo '<strong>Vendor</strong>: '.$products['product']['vendor'].'<br/> ';
		echo '<strong>Tags</strong>: '.$products['product']['tags'].'<br/> ';
		echo '</li>';
		
    }
    echo '</ul>';
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
echo '<style>
img.pr-image {
    height: 50px;
}
</style>';
?>