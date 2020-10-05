<?php
    require_once("../admin/classes/encoding.php");
    use \ForceUTF8\Encoding;  // It's namespaced now.
    require("../admin/ajax/mysql.php");
    $mysql = new MySQL();
    $connection = $mysql->connect();
    $query = "
            select n.title, n.date, n.image, n.url, lower(n.source) as source
            from tnews n
            where n.tcategoryid = 11
            order by n.date desc;
            ";
    $result = $mysql->query($connection, $query); 
    $articles = array();
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
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
?>