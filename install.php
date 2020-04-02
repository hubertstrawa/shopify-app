<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "b1535ef7305705a60e5e32153021d5b7";
$scopes = "read_orders,write_products";
$redirect_uri = "https://8b9abd31.ngrok.io/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();