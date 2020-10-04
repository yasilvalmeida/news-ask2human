<?php
    if (isset($_POST['paginationIndex']) && 
    isset($_POST['paginationItemPerIndex']) && 
    isset($_POST['country']) && 
    isset($_POST['category'])) {
        $paginationIndex = $_POST["paginationIndex"];
        $paginationItemPerIndex = $_POST["paginationItemPerIndex"];
        $country = $_POST["country"];
        $category = $_POST["category"];
        //$api_key = "c91b92a7592e470a9e37d12ed5b5bf8e";
        if ($category == "general")
            $url = "https://newsapi.org/v2/top-headlines?page=".$paginationIndex."&pageSize=".$paginationItemPerIndex."&category=".$category."&apiKey=".$api_key;
        else if ($category != "all")
            $url = "https://newsapi.org/v2/top-headlines?page=".$paginationIndex."&pageSize=".$paginationItemPerIndex."&country=".$country."&category=".$category."&apiKey=".$api_key;
        else
            $url = "https://newsapi.org/v2/top-headlines?page=".$paginationIndex."&pageSize=".$paginationItemPerIndex."&country=".$country."&apiKey=".$api_key;
        $response = file_get_contents($url);
        echo $response;
    }
    else echo json_encode(array('resp' => "No parameter"));
?>