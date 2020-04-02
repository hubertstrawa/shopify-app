<?php
    require("inc/functions.php");

    $requests = $_GET;
    $hmac = $_GET['hmac'];
    $serializeArray = serialize($requests);
    $requests = array_diff_key($requests, array('hmac' => ''));

    $token = "e7295b7279770956ed985ef1c94db645";
    $shop = "hubertstrawa-testapp";

    $collectionList = shopify_call($token, $shop, "/admin/api/2020-04/custom_collections.json", array(), 'GET');
    $collectionList = json_decode($collectionList['response'], JSON_PRETTY_PRINT);
    $collection_id = $collectionList['custom_collections'][0]['id'];

    $collects = shopify_call($token, $shop, "/admin/api/2020-04/collects.json", array("collection_id"=>$collection_id), 'GET');
    $collects = json_decode($collects['response'], JSON_PRETTY_PRINT);

    foreach ($collects as $collect) {
        foreach ($collect as $key => $value) {
            $products = shopify_call($token, $shop, "/admin/api/2020-04/products/" . $value['product_id'] . ".json", array("collection_id"=>$collection_id), 'GET');
            $products = json_decode($products['response'], JSON_PRETTY_PRINT);

            echo $products['product']['title'] . '<br />';
        }
    }

    echo '<h2>Export file</h2>';
    echo '<p>Password:</p>';
    echo $_GET['password'];
?>