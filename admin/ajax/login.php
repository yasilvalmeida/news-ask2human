<?php
    if (isset($_POST['email']) && isset($_POST["password"]))
    {
        require("mysql.php");
        $mysql = new MySQL();
        $connection = $mysql->connect();

        $email    = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        
        $query = "
                select u.id
                from tuser u
                where u.email = '$email' and u.password = '$password';
                ";
        $result = $mysql->query($connection, $query); 
        $num = mysqli_num_rows($result);
        if($num > 0)
        {
            $roles = array();
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $id        = $row["id"];
            }
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
            $data = array(
                "result" => 1,
                "message" => "Login succesful!"
            );
        }
        else
        {
            $data = array(
                "result" => 0,
                "message" => "Wrong credentials, please check your email or password!"
            );
        }
        // Convert data[] to json
        echo json_encode($data);
    }
?>