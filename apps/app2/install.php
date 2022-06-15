<?php

// Set variables for our request
$shop = $_GET['shop'];
echo $shop;
$api_key = "abccf529ad9c2f96dbc6c7d5f152f9cb";
$scopes = "read_orders,write_products";
$redirect_uri = "https://db48-223-190-85-128.in.ngrok.io/app2/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . "/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);


// Redirect
header("Location: " . $install_url);
die();