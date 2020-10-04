<?php
    if (isset($_POST['email']))
    {
        $email    = $_POST["email"];
        require('config.php');
        $cfg = new Config();

        require_once('../phpmailer/class.phpmailer.php');
        // include("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

        $mail             = new PHPMailer();

        $mail->IsSMTP();                    // telling the class to use SMTP
        $mail->Host       = $cfg->Host;     // SMTP server
        $mail->SMTPDebug  = 1;              // enables SMTP debug information (for testing)
                                            // 1 = errors and messages
                                            // 2 = messages only
        $mail->SMTPAuth   = true;           // enable SMTP authentication
        $mail->Port       = $cfg->Port;     // set the SMTP port for the GMAIL server
        $mail->Username   = $cfg->Email;    // SMTP account username
        $mail->Password   = $cfg->Password; // SMTP account password

        $mail->SetFrom($cfg->Email, $cfg->Name);

        $mail->Subject    = "Login Information";

        require("mysql.php");
        $mysql = new MySQL();
        $connection = $mysql->connect();
        $query = "
                select u.password
                from tuser u
                where u.email = '$email';
                ";
        $result = $mysql->query($connection, $query); 
        $num = mysqli_num_rows($result);
        if($num > 0)
        {
            if($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $password   = $row["password"];
            }
            //$mail->AddReplyTo($email, "ClassSys User");
            //$mail->AddEmbeddedImage($logoPath, "school-logo", $logoPath);
            $body = "<html>
                        <head></head>
                        <body>
                            <p>Dear User,</p>
                            <p>Below is your News Ask2Human system login password:</p>
                            <p>$password</p>
                            <br/>
                            <br/>
                            <p>Best Regards,</p>
                            <p>Support News Ask 2 Human</p>
                        </body>
                    </html>
                    ";
            
            $mail->MsgHTML($body);

            $address = $email;
            $mail->AddAddress($address, $cfg->Name);

            if(!$mail->Send()) {
                $data = array(
                    "result" => 0,
                    "message" => "Fail recovering the credentials!"
                );
            } 
            else {
                $data = array(
                    "result" => 1,
                    "message" => "Your credentials was sended successful!"
                );
            }
        }
        else
        {
            $data = array(
                "result" => 0,
                "message" => "No record of this credentials in database!"
            );
        }
        // Convert data[] to json
        echo json_encode($data);
    }
?>