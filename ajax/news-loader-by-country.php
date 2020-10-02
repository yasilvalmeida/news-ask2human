<?php
    if (isset($_POST['country'])) {
        $country = $_POST["country"];
        $api_key = "c91b92a7592e470a9e37d12ed5b5bf8e";
        $url = "https://newsapi.org/v2/top-headlines?country=".$country."&apiKey=".$api_key;
        $response = file_get_contents($url);
        echo $response;
    }
    else echo json_encode(array('resp' => "No parameter"));
?>