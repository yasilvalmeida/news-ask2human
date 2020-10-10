<?php
    if (isset($_POST['paginationIndex']) && 
    isset($_POST['paginationItemPerIndex']) && 
    isset($_POST['countryId']) && 
    isset($_POST['categoryId'])) {
        $offset = (intval($_POST["paginationIndex"]) - 1) * intval($_POST["paginationItemPerIndex"]);
        $limit = intval($_POST["paginationItemPerIndex"]);
        $countryId = $_POST["countryId"];
        $categoryId = $_POST["categoryId"];
        require("../admin/ajax/mysql.php");
        require("../admin/classes/news.php");
        $mysql = new MySQL();
        $connection = $mysql->connect();
        if ($categoryId != 11) {
            $query = "
                select n.title, n.date, n.image, n.url, lower(n.source) as source
                from tnews n
                where n.tcountryid = $countryId and n.tcategoryid = $categoryId
                order by n.date desc
                limit $offset, $limit;
                ";
        }
        else {
            $query = "
                select n.title, n.date, n.image, n.url, lower(n.source) as source
                from tnews n
                where n.tcategoryid = $categoryId
                order by n.date desc
                limit $offset, $limit;
                ";
        }
        $result = $mysql->query($connection, $query); 
        $articles = array();
        mb_language('uni');
        mb_internal_encoding('UTF-8');
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $articles[] = new News($row);
            /*( 
                "title" =>  substr($row["title"], 0, 50)." ...", 
                "date" => $row["date"], 
                "image" => $row["image"], 
                "url" => $row["url"], 
                "source" => $row["source"]
            ); */
        }
        echo json_encode(array('articles' => $articles), JSON_UNESCAPED_UNICODE);
    }
    else
        echo json_encode(array('resp' => "No parameter"));
?>