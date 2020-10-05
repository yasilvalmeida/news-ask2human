<?php
    require_once("../admin/classes/encoding.php");
    use \ForceUTF8\Encoding;  // It's namespaced now.
    if (isset($_POST['paginationIndex']) && 
    isset($_POST['paginationItemPerIndex']) && 
    isset($_POST['countryId']) && 
    isset($_POST['categoryId'])) {
        $offset = (intval($_POST["paginationIndex"]) - 1) * intval($_POST["paginationItemPerIndex"]);
        $limit = intval($_POST["paginationItemPerIndex"]);
        $countryId = $_POST["countryId"];
        $categoryId = $_POST["categoryId"];
        require("../admin/ajax/mysql.php");
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
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $title = Encoding::fixUTF8($row["title"]);
            if (strpos($title, "??")  === false) {
                $articles[] = array
                (
                    "title" =>  substr($title, 0, 50)." ...", 
                    "date" => $row["date"], 
                    "image" => $row["image"], 
                    "url" => $row["url"], 
                    "source" => $row["source"]
                );
            }
        }
        echo json_encode(array('articles' => $articles));
    }
    else echo json_encode(array('resp' => "No parameter"));
?>