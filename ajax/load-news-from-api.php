<?php
    require_once("../admin/classes/encoding.php");
    use \ForceUTF8\Encoding;  // It's namespaced now.
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
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $id   = $row["id"];
        $code = $row["code"];
        $name = $row["name"];
        $countries[] = array("id" => $id, "code" => $code, "name" => $name);
        $i++;
    }
    $query = "
            select c.id, c.code, c.name
            from tcategory c
            where c.state = 1 and c.code != 'general';
            ";
    $result = $mysql->query($connection, $query); 
    $num = mysqli_num_rows($result);
    $categories = array();
    $i = 0;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $id   = $row["id"];
        $code = $row["code"];
        $name = $row["name"];
        $categories[] = array("id" => $id, "code" => $code);
        $i++;
    }
    foreach($countries as $country) {
        foreach($categories as $category) {
            // Save to mysql database
            echo "Get news from ".$country["code"]." and category ".$category["code"]." ...<br/>";
            $data = getNewsByCountryByCategory($country["code"], $category["code"]);
            foreach($data["articles"] as $article) {
                $title  = mysqli_real_escape_string($connection, $article["title"]);
                $date   = explode("T", $article["publishedAt"])[0];
                $image  = $article["urlToImage"];
                $url    = $article["url"];
                $source = $article["source"]["name"];
                if ($image != "" && $url != "") {
                    $query = "
                        call sp_save_news
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
    }
    echo "Get world news ...<br/>";
    $data = getWorldNews();
    foreach($data["articles"] as $article) {
        $title  = mysqli_real_escape_string($connection, $article["title"]);
        $date   = explode("T", $article["publishedAt"])[0];
        $image  = $article["urlToImage"];
        $url    = $article["url"];
        $source = $article["source"]["name"];
        if ($image != "" && $url != "") {
            $query = "
                call sp_save_news
                (
                    '$title', 
                    '$date', 
                    '$url', 
                    '$image', 
                    '$source', 
                    11, 
                    1
                );
                ";
            $result = $mysql->query($connection, $query); 
        }
    }
    function getNewsByCountryByCategory($country, $category) {
        $api_key = "a22394da363248478e8ebffbdd754d63"; 
        if ($category == "all")
            $url = "https://newsapi.org/v2/top-headlines?country=".$country."&apiKey=".$api_key;
        else if ($category == "general")
            $url = "https://newsapi.org/v2/top-headlines?category=".$category."&apiKey=".$api_key;
        else
            $url = "https://newsapi.org/v2/top-headlines?country=".$country."&category=".$category."&apiKey=".$api_key;
        $data = json_decode(file_get_contents($url), true);
        if ($data["status"] == "ok") {
            echo "Getting from API_KEY_1<br/>";
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
                echo "Getting from API_KEY_2<br/>";
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
                    echo "Getting from API_KEY_3<br/>";
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
                        echo "Getting from API_KEY_4<br/>";
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
                            echo "Getting from API_KEY_5<br/>";
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
    function getWorldNews() {
        $api_key = "a22394da363248478e8ebffbdd754d63"; 
        $url = "https://newsapi.org/v2/top-headlines?category=general&apiKey=".$api_key;
        $data = json_decode(file_get_contents($url), true);
        if ($data["status"] == "ok") {
            echo "Getting from API_KEY_1<br/>";
            return $data;
        }
        else {
            $api_key = "5f7c4673c4ca47a29d9e75e832bac673"; 
            $url = "https://newsapi.org/v2/top-headlines?category=general&apiKey=".$api_key;
            $data = json_decode(file_get_contents($url), true);
            if ($data["status"] == "ok") {
                echo "Getting from API_KEY_2<br/>";
                return $data;
            }
            else {
                $api_key = "0f7c6579373a4191bf6ea909ffc31eb5"; 
                $url = "https://newsapi.org/v2/top-headlines?category=general&apiKey=".$api_key;
                $data = json_decode(file_get_contents($url), true);
                if ($data["status"] == "ok") {
                    echo "Getting from API_KEY_3<br/>";
                    return $data;
                }
                else {
                    $api_key = "1ce380e031154b71a1424914b9d4f8b5"; 
                    $url = "https://newsapi.org/v2/top-headlines?category=general&apiKey=".$api_key;
                    $data = json_decode(file_get_contents($url), true);
                    if ($data["status"] == "ok") {
                        echo "Getting from API_KEY_4<br/>";
                        return $data;
                    }
                    else {
                        $api_key = "c91b92a7592e470a9e37d12ed5b5bf8e"; 
                        $url = "https://newsapi.org/v2/top-headlines?category=general&apiKey=".$api_key;
                        $data = json_decode(file_get_contents($url), true);
                        if ($data["status"] == "ok") {
                            echo "Getting from API_KEY_5<br/>";
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