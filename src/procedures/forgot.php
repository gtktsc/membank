<?php
    session_start();
    function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    require_once("connect.php");        
    $conn = new mysqli($servername,$username,$password,$databaseName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else{
        $validated=true;
        
        $loginRaw = $_POST["login"];
        $login = (string)$_POST["login"];
        $loginTest1= htmlspecialchars($login);
        $loginTest2= mysqli_real_escape_string($conn, $loginTest1);
        if($loginRaw!=$loginTest2){
            $validated=false;
            $_SESSION["errorlogin"]="Niepoprawny login";                
        };
        
        $email=$_POST['email'];
        $emailsafe=filter_var($email, FILTER_SANITIZE_EMAIL);
        if(filter_var($emailsafe,FILTER_VALIDATE_EMAIL)==false || $emailsafe!=$email ){
            $validated=false;
            $_SESSION["errormail"]="Niepoprawny adres e-mail";            
        };
        
        if($validated==true){
            $result= $conn->query("SELECT * FROM lamusy WHERE login='$login' AND email='$email'");
            $how_many_users=$result->num_rows;
            if($how_many_users>0){
                $userData = $result->fetch_assoc();
                $passwordResetCode=generateRandomString();
                if($conn->query("UPDATE `lamusy` SET passwordReset=('$passwordResetCode') WHERE login='$login' AND email='$email'")){ 

                    $encoding = "utf-8";
                    $from_name = "memBank";
                    $from_mail = "service@membank.pl";
                    $mail_subject = "Reset danych konta na portalu memBank.pl";

                    $mail_message = "<div style = 'text-align:center'><h1>Aby zresetować hasło kliknij poniższy link</h1><br><h1><a href='http://www.membank.pl/reset.php?login=".urlencode($userData['login'])."&passwordReset=".urlencode($passwordResetCode)."'>Link do resetowania hasła</a></h1><br><h1>Zespół memBank.pl</h1></div>";                    
                    $mail_to = $userData['email'];
                    $subject_preferences = array(
                        "input-charset" => $encoding,
                        "output-charset" => $encoding,
                        "line-length" => 76,
                        "line-break-chars" => "\r\n"
                    );
                    $header = "Content-type: text/html; charset=".$encoding." \r\n";
                    $header .= "From: ".$from_name." <".$from_mail."> \r\n";
                    $header .= "MIME-Version: 1.0 \r\n";
                    $header .= "Content-Transfer-Encoding: 8bit \r\n";
                    $header .= "Date: ".date("r (T)")." \r\n";
                    $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
                    if( mail($mail_to, $mail_subject, $mail_message, $header)){
                        $_SESSION["errorlogin"] = "Link do zmiany hasła został wysłany na podany adres e-mail";
                    }else{
                        $_SESSION["errorlogin"] = "Nie można zresetować hasła";
                    }
                }else{
                    $_SESSION["errorlogin"]= $conn->error;
                }
            }else{
                $_SESSION["errorlogin"]="Nieprawidłowe dane";                                    
            }
        }
    }
    $conn->close();
    header("Location:../../przywroc.php");  


?>