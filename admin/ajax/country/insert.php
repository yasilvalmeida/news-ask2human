<?php
    if(isset($_POST["code"]) && 
    isset($_POST["name"]) && 
    isset($_POST["state"])) {
        $code  = $_POST["code"];
        $name  = $_POST["name"];
        $state = $_POST["state"];
        require("../mysql.php");
        $mysql      = new MySQL();
        $connection = $mysql->connect();
        $query = "
            insert into tcountry(code, name, state)
            values ('$code', '$name', $state);
            ";
        $result = $mysql->query($connection, $query); 
        echo "1";
    }
    else {
        echo "Missing parameters";
        print_r($_POST);
    }
?>