<?php

// Set variables for our request
$shop = $_GET['shop'];
echo $shop;
$api_key = "7630d6bd91a0c693b2842d19e3db4c4c";
$scopes = "read_orders,write_products";
$redirect_uri = "https://db48-223-190-85-128.in.ngrok.io/app/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . "/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);


// Redirect
header("Location: " . $install_url);
die();