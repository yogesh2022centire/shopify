<?php

// Set variables for our request
$shop = $_GET['shop'];
echo $shop;
$api_key = "3b15db0d15e89ec30c2ef45d449c4379";
$scopes = "read_orders,write_products";
$redirect_uri = "https://1da1-223-190-84-178.in.ngrok.io/product/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . "/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);


// Redirect
header("Location: " . $install_url);
die();