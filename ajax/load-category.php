<?php
    require("../admin/ajax/mysql.php");
    $mysql = new MySQL();
    $connection = $mysql->connect();
    $query = "
            select *
            from tcategory c
            where c.state = 1
            order by c.code asc
            ";
    $result = $mysql->query($connection, $query); 
    $categories = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $id = $row["id"];
        $code = $row["code"];
        $name = $row["name"];
        $categories[] = array
        (
            "id" => $id, 
            "code" => $code, 
            "name" => $name
        );
    }
    echo json_encode(array('categories' => $categories));
?>