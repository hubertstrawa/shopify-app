<?php
    session_start();
    require("inc/functions.php");

    $thisUrl = $_SERVER['REQUEST_URI'];
    $pass = $_SESSION['pass'];

    if ($thisUrl == '/export.php?password='.$pass) {
        $requests = $_GET;
        $hmac = $_GET['hmac'];
        $serializeArray = serialize($requests);
        $requests = array_diff_key($requests, array('hmac' => ''));

        $token = "e7295b7279770956ed985ef1c94db645";
        $shop = "hubertstrawa-testapp";

        $collectionList = shopify_call($token, $shop, "/admin/api/2020-04/custom_collections.json", array(), 'GET');
        $collectionList = json_decode($collectionList['response'], JSON_PRETTY_PRINT);
        $collection_id = $collectionList['custom_collections'][0]['id'];


        echo '<h2>Export file</h2>';
        echo '<p>Password:</p>';
        echo $_GET['password'];


        echo '<p>Collection ID: ' . $collection_id . 

        $collects = shopify_call($token, $shop, "/admin/api/2020-04/collects.json", array("collection_id"=>$collection_id), 'GET');
        $collects = json_decode($collects['response'], JSON_PRETTY_PRINT);

        foreach ($collects as $collect) {
            foreach ($collect as $key => $value) {
                $products = shopify_call($token, $shop, "/admin/api/2020-04/products/" . $value['product_id'] . ".json", array("collection_id"=>$collection_id), 'GET');
                $products = json_decode($products['response'], JSON_PRETTY_PRINT);

                echo $products['product']['title'] . '<br />';
            }
        }

    } else {
        echo '<strong>Sorry it doesnt have a password</strong><br/>';
    }

    echo 'Saved pass in SESSION: <br/>';
    echo $_SESSION['pass'];
    echo '<br/><strong>Current URL: </strong><br />';
    echo $thisUrl;

?>