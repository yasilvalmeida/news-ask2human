<?php
    print("Stablish database connection...");
    
    require("../admin/ajax/mysql.php");
    
    $mysql = new MySQL();
    
    $connection = $mysql->connect();
    $query = "
            select c.id, c.code, c.name
            from tcountry c;
            ";
    $result = $mysql->query($connection, $query); 
    $num = mysqli_num_rows($result);
    $countries = array();
    $i = 0;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $id   = $row["id"];
        $code = $row["code"];
        $name = $row["name"];
        $countries[] = array("id" => $id, "code" => $code, "name" => $name);
        $i++;
    }
    $query = "
            select c.id, c.name
            from tcategory c;
            ";
    $result = $mysql->query($connection, $query); 
    $num = mysqli_num_rows($result);
    $categories = array();
    $i = 0;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $id   = $row["id"];
        $name = $row["name"];
        $categories[] = array("id" => $id, "name" => $name);
        $i++;
    }
    print_r($countries);
    print_r($categories);
    return;
    $api_key = "a22394da363248478e8ebffbdd754d63"; 
    /* 
        "5f7c4673c4ca47a29d9e75e832bac673",
        "0f7c6579373a4191bf6ea909ffc31eb5",
        "1ce380e031154b71a1424914b9d4f8b5",
        "c91b92a7592e470a9e37d12ed5b5bf8e"
    */
    $countries = array
    (
        
    );
    $categories = array
    (
        "business", 
        "entertainment", 
        "general", 
        "health",
        "science", 
        "sports", 
        "technology"
    );
    foreach($countries as $country) {
        $url = "https://newsapi.org/v2/top-headlines?country=".$country."&apiKey=".$api_key;
        $response = file_get_contents($url);
        // Save to mysql database
        $data = json_decode($response, true);
        if ($data["status"] == "ok") {
            foreach($data["articles"] as $article) {
                $title = $article["source"]["title"];
                $date = explode("T", $article["source"]["publishedAt"])[0];
                $image = $article["source"]["urlToImage"];
                $url = $article["source"]["url"];
                $source = $article["source"]["name"];
            }
        }
        return;
        foreach($categories as $category) {
            if ($category == "general")
                $url = "https://newsapi.org/v2/top-headlines?category=".$category."&apiKey=".$api_key;
            else
                $url = "https://newsapi.org/v2/top-headlines?country=".$country."&category=".$category."&apiKey=".$api_key;
            $response = file_get_contents($url);
            // Save to mysql database
        }
    }
    
?>