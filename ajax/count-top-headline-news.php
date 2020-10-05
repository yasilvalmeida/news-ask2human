<?php
    require_once("../admin/classes/encoding.php");
    use \ForceUTF8\Encoding;  // It's namespaced now.
    if (isset($_POST['countryId']) && isset($_POST['categoryId'])) {
        $countryId = $_POST["countryId"];
        $categoryId = $_POST["categoryId"];
        require("../admin/ajax/mysql.php");
        $mysql = new MySQL();
        $connection = $mysql->connect();
        if ($categoryId == 11) {
            $query = "
                select n.title
                from tnews n
                where n.tcategoryid = $categoryId
                ";
        }
        else {
            $query = "
                select n.title
                from tnews n
                where n.tcountryid = $countryId and n.tcategoryid = $categoryId
                ";
        }
        $result = $mysql->query($connection, $query);
        $total = 0;
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if ($categoryId == 11) {
                $title = Encoding::fixUTF8($row["title"]);
                if (strpos($title, "??")  === false) {
                    $total++;
                }
            }
            else {
                $total++;
            }
        }
        echo json_encode(array('total' => $total));
    }
    else echo json_encode(array('resp' => "No parameter"));
?>