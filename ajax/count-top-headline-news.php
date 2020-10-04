<?php
    if (isset($_POST['countryId']) && isset($_POST['categoryId'])) {
        $countryId = $_POST["countryId"];
        $categoryId = $_POST["categoryId"];
        require("../admin/ajax/mysql.php");
        $mysql = new MySQL();
        $connection = $mysql->connect();
        $query = "
                select count(n.id) as total
                from tnews n
                where n.tcountryid = $countryId and n.tcategoryid = $categoryId
                ";
        $result = $mysql->query($connection, $query); 
        $total = 0;
        if($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $total = $row["total"];
        }
        echo json_encode(array('total' => $total));
    }
    else echo json_encode(array('resp' => "No parameter"));
?>