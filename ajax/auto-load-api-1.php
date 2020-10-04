<?php
    require("../admin/ajax/mysql.php");
    $mysql = new MySQL();
    $connection = $mysql->connect();
    $query = "
            select c.id, c.code, c.name
            from tcountry c
            where c.state = 1;
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
            from tcategory c
            limit 1;
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
    foreach($countries as $country) {
        foreach($categories as $category) {
            // Save to mysql database
            $data = getNews($country["code"], $category["name"]);
            foreach($data["articles"] as $article) {
                $title = $article["title"];
                $date = explode("T", $article["publishedAt"])[0];
                $image = $article["urlToImage"];
                $url = $article["url"];
                $source = $article["source"]["name"];
                $query = "
                        insert into tnews
                        (
                            title, 
                            date,
                            url, 
                            image, 
                            source, 
                            tcategoryid, 
                            tcountryid
                        )
                        values
                        (
                            '$title', 
                            '$date', 
                            '$url', 
                            '$image', 
                            '$source', 
                            ".$category["id"].", 
                            ".$country["id"]."
                        );
                        ";
                $result = $mysql->query($connection, $query); 
            }
        }
    }
    function getNews($country, $category) {
        $api_key = "a22394da363248478e8ebffbdd754d63"; 
        if ($category == "all")
            $url = "https://newsapi.org/v2/top-headlines?country=".$country."&apiKey=".$api_key;
        else if ($category == "general")
            $url = "https://newsapi.org/v2/top-headlines?category=".$category."&apiKey=".$api_key;
        else
            $url = "https://newsapi.org/v2/top-headlines?country=".$country."&category=".$category."&apiKey=".$api_key;
        $data = json_decode(file_get_contents($url), true);
        if ($data["status"] == "ok") {
            echo "Ok with API_KEY_1";
            return $data;
        }
        else {
            $api_key = "5f7c4673c4ca47a29d9e75e832bac673"; 
            if ($category == "all")
                $url = "https://newsapi.org/v2/top-headlines?country=".$country."&apiKey=".$api_key;
            else if ($category == "general")
                $url = "https://newsapi.org/v2/top-headlines?category=".$category."&apiKey=".$api_key;
            else
                $url = "https://newsapi.org/v2/top-headlines?country=".$country."&category=".$category."&apiKey=".$api_key;
            $data = json_decode(file_get_contents($url), true);
            if ($data["status"] == "ok") {
                echo "Ok with API_KEY_2";
                return $data;
            }
            else {
                $api_key = "0f7c6579373a4191bf6ea909ffc31eb5"; 
                if ($category == "all")
                    $url = "https://newsapi.org/v2/top-headlines?country=".$country."&apiKey=".$api_key;
                else if ($category == "general")
                    $url = "https://newsapi.org/v2/top-headlines?category=".$category."&apiKey=".$api_key;
                else
                    $url = "https://newsapi.org/v2/top-headlines?country=".$country."&category=".$category."&apiKey=".$api_key;
                $data = json_decode(file_get_contents($url), true);
                if ($data["status"] == "ok") {
                    echo "Ok with API_KEY_3";
                    return $data;
                }
                else {
                    $api_key = "1ce380e031154b71a1424914b9d4f8b5"; 
                    if ($category == "all")
                        $url = "https://newsapi.org/v2/top-headlines?country=".$country."&apiKey=".$api_key;
                    else if ($category == "general")
                        $url = "https://newsapi.org/v2/top-headlines?category=".$category."&apiKey=".$api_key;
                    else
                        $url = "https://newsapi.org/v2/top-headlines?country=".$country."&category=".$category."&apiKey=".$api_key;
                    $data = json_decode(file_get_contents($url), true);
                    if ($data["status"] == "ok") {
                        echo "Ok with API_KEY_4";
                        return $data;
                    }
                    else {
                        $api_key = "c91b92a7592e470a9e37d12ed5b5bf8e"; 
                        if ($category == "all")
                            $url = "https://newsapi.org/v2/top-headlines?country=".$country."&apiKey=".$api_key;
                        else if ($category == "general")
                            $url = "https://newsapi.org/v2/top-headlines?category=".$category."&apiKey=".$api_key;
                        else
                            $url = "https://newsapi.org/v2/top-headlines?country=".$country."&category=".$category."&apiKey=".$api_key;
                        $data = json_decode(file_get_contents($url), true);
                        if ($data["status"] == "ok") {
                            echo "Ok with API_KEY_5";
                            return $data;
                        }
                        else {
                            return [];
                        }
                    }
                }
            }
        }
    }
?>