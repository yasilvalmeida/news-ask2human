<?php
    if (isset($_POST['id']) && 
    isset($_POST['email']) && 
    isset($_POST["password"]))
    {
        require("mysql.php");
        $mysql = new MySQL();
        $connection = $mysql->connect();

        $id       = $_POST['id'];
        $email    = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $query = "
                update tuser
                set email = '$email',
                    password = '$password'
                where id = $id;
                ";
        $result = $mysql->query($connection, $query); 
        $num = mysqli_num_rows($result);
        session_start();
        if(isset($_SESSION['views']))
        {
            $_SESSION['views'] = $_SESSION['views'] + 1;
        }
        else
        {
            $_SESSION['views'] = 1;
        }
        $_SESSION[$_SESSION['views'].'id'] = $id;
        $_SESSION[$_SESSION['views'].'email'] = $email;
        $_SESSION[$_SESSION['views'].'password'] = "*************";
        echo 1;
    }
?>