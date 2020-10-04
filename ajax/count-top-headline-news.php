<?php
    if (isset($_POST['country']) && isset($_POST['category'])) {
        $country = $_POST["country"];
        $category = $_POST["category"];
        $data = "ae ar at au be bg br ca ch cn co cu cz de eg fr gb gr hk hu id ie il in it jp kr lt lv ma mx my ng nl no nz ph pl pt ro rs ru sa se sg si sk th tr tw ua us ve za";
        
        if ($category != "all")
            $url = "https://newsapi.org/v2/top-headlines?country=".$country."&category=".$category."&apiKey=".$api_key;
        else
            $url = "https://newsapi.org/v2/top-headlines?country=".$country."&apiKey=".$api_key;
        $response = file_get_contents($url);
        echo $response;
    }
    else echo json_encode(array('resp' => "No parameter"));
?>