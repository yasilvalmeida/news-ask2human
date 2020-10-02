<?php
    if (isset($_POST['category'])) {
        $category = $_POST["category"];
        $api_key = "c91b92a7592e470a9e37d12ed5b5bf8e";
        $url = "https://newsapi.org/v2/top-headlines?category=".$category."&apiKey=".$api_key;
        $response = file_get_contents($url);
        echo $response;
    }
    else echo json_encode(array('resp' => "No parameter"));
?>