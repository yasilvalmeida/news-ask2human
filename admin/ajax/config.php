<?php
    class Config 
	{ 
		public $Email = "pt@ybytesi.com"; //"classsys@ybytesi.com";
        public $Password = "Test*2020"; 
        public $Name = "News A2H";
        public $Host = "mail.ybytesi.com";  //"185.224.136.7";//
        public $Port = 26; 
        function encodeToUtf8($string) {
            return mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
        }
        function index_of($string, $pattern) {
            $i = 0;
            while($i < strlen($string))
            {
                if($pattern[0] == $string[$i])
                    return $i;
                $i++;
            }
            return -1;
        }
        function sendEmailForUserCreation($destEmail, $password, $fullname, $school) {
            require_once('phpmailer/class.phpmailer.php');
            
            $mail             = new PHPMailer();

            $mail->IsSMTP();                          // telling the class to use SMTP
            $mail->Host       = $this->Host;                // SMTP server
            $mail->SMTPDebug  = 1;                    // enables SMTP debug information (for testing)
                                                      // 1 = errors and messages
                                                      // 2 = messages only
            $mail->SMTPAuth   = true;                 // enable SMTP authentication
            $mail->Port       = $this->Port;                // set the SMTP port for the GMAIL server
            $mail->Username   = $this->Email;               // SMTP account username
            $mail->Password   = $this->Password;            // SMTP account password

            $mail->SetFrom($this->Email, $this->Name);

            $mail->Subject    = $school." Setup";
            
            // For most clients expecting the Priority header:
            // 1 = High, 2 = Medium, 3 = Low
            $mail->Priority = 1;
            // MS Outlook custom header
            // May set to "Urgent" or "Highest" rather than "High"
            $mail->AddCustomHeader("X-MSMail-Priority: High");
            // Not sure if Priority will also set the Importance header:
            $mail->AddCustomHeader("Importance: High");
            
            $body = "
                    <html>
                        <head></head>
                        <body>
                            <p>Dear $fullname,</p>
                            <p>Your school account on the ClassSys School System has been successfully created.</p>
                            <br/>
                            <p>Below is your login information:</p>
                            <p>$destEmail</p>
                            <p>$password</p>
                            <br/>
                            <p>Please click here for information on how to proceed.</p>
                            <br/>
                            <p>Contact us on</p>
                            <p>E-mail:</p>
                            <p>Phone:</p>
                            <p>Facebook:</p>
                            <p>Twitter:</p>
                            <br/>
                            <p>Best Regards,</p>
                            <p>ClasssSys</p>
                        </body>
                    </html>
                    ";
            //$mail->AddReplyTo($destEmail, $fullname);
            $mail->AddAddress($destEmail, $fullname);

            $mail->MsgHTML($body);
            $count_sended = 0;
            if($mail->Send()) {
                $count_sended++;
            }
            if($count_sended == 0) {
                $resp = "Sending email failed!";
            } 
            else {
                $resp = "Sending email successfull!";
            }
            echo $resp;
        }
        function sendEmailForInputScore($parentEmail, $parent, $student, $scorePercentage, $exerciseType, $subject, $date, $school) {
            require_once('phpmailer/class.phpmailer.php');
            
            $mail             = new PHPMailer();

            $mail->IsSMTP();                          // telling the class to use SMTP
            $mail->Host       = $this->Host;          // SMTP server
            $mail->SMTPDebug  = 1;                    // enables SMTP debug information (for testing)
                                                      // 1 = errors and messages
                                                      // 2 = messages only
            $mail->SMTPAuth   = true;                 // enable SMTP authentication
            $mail->Port       = $this->Port;          // set the SMTP port for the GMAIL server
            $mail->Username   = $this->Email;         // SMTP account username
            $mail->Password   = $this->Password;      // SMTP account password

            $mail->SetFrom($this->Email, $this->Name);

            $mail->Subject    = $exerciseType." Score, ".$date;
            
            // For most clients expecting the Priority header:
            // 1 = High, 2 = Medium, 3 = Low
            $mail->Priority = 1;
            // MS Outlook custom header
            // May set to "Urgent" or "Highest" rather than "High"
            $mail->AddCustomHeader("X-MSMail-Priority: High");
            // Not sure if Priority will also set the Importance header:
            $mail->AddCustomHeader("Importance: High");
            
            $body = "
                    <html>
                        <head></head>
                        <body>
                            <p>Dear $parent,</p>
                            <p>$student, scored <b>$scorePercentage%</b> in the <b>$exerciseType</b> for <b>$subject</b> submitted on <b>$date</b>.</p>
                            <br/>
                            <p>Thanks,</p>
                            <p>$school</p>
                        </body>
                    </html>
                    ";
            $mail->AddAddress($parentEmail, $parent);
            $mail->AddAddress("yasilvalmeida@hotmail.com", "ClassSYS Developer");

            $mail->MsgHTML($body);
            $count_sended = 0;
            if($mail->Send()) {
                $count_sended++;
            }
            if($count_sended == 0) {
                $resp = "0";
            } 
            else {
                $resp = "1";
            }
            echo $resp;
        }
	}
?>