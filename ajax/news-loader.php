<?php
    $api_key = "c91b92a7592e470a9e37d12ed5b5bf8e";
    $url = "http://newsapi.org/v2/top-headlines?sources=google-news&apiKey=".$api_key;
    $response = file_get_contents($url);
    echo $response;
?>