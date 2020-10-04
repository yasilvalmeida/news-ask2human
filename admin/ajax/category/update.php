<?php
    if(isset($_POST["id"]) &&
    isset($_POST["code"]) &&  
    isset($_POST["name"]) && 
    isset($_POST["state"])) {
        $id    = $_POST["id"];
        $code  = $_POST["code"];
        $name  = $_POST["name"];
        $state = $_POST["state"];
        require("../mysql.php");
        $mysql      = new mysql();
        $connection = $mysql->connect();
        $query = "
                update tcategory
                set name = '$name',
                    state = $state
                where id = $id;
                ";
        $result = $mysql->query($connection, $query); 
        echo "1";
    }
    else {
        echo "Missing parameters";
        print_r($_POST);
    }
?>