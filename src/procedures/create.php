<?php
session_start();
if(isset($_POST['login']) && isset($_POST["g-recaptcha-response"])){
    $validated=true;
    $login=$_POST['login'];
    if(strlen($login)<3||strlen($login)>20){
        $validated=false;
        $_SESSION["errornick"]="Nick powinien się składać z 3-20 znaków";
    };
    if(ctype_alnum($login)==false){
        $validated=false;
        $_SESSION["errornick"]="Niedozwolone znaki";
    };
    $email=$_POST['email'];
    $emailsafe=filter_var($email, FILTER_SANITIZE_EMAIL);
    if(filter_var($emailsafe,FILTER_VALIDATE_EMAIL)==false || $emailsafe!=$email ){
        $validated=false;
        $_SESSION["errormail"]="Niepoprawny adres e-mail";
    };
    $password=$_POST['password'];
    $passwordre=$_POST['passwordre'];
    if(strlen($password)<6){
        $validated=false;
        $_SESSION["errorpass"]="Hasło jest zbyt krótkie";
    };
    if($password!=$passwordre){
        $validated=false;
        $_SESSION["errorpass"]="Hasła nie są zgodne";
    };
    $passwordHash=password_hash($password,PASSWORD_DEFAULT);
    if(!isset($_POST['regulamin'])){
        $validated=false;
        $_SESSION["errorregulamin"]="Zaakceptuj regulamin";
    };
    
    $key="6LczJC8UAAAAAFDV7JoS3TWzNR6sLPjQknFzh-Bd";

    $check=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$_POST["g-recaptcha-response"]);

    $respond=json_decode($check);

    if($respond->success==false){
        $validated=false;
    };
    
    require_once("connect.php");
    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
        $connection = new mysqli($servername,$username,$password,$databaseName);
        if($connection->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }else{
            $result= $connection->query("SELECT id FROM lamusy WHERE login='$login'");
            if(!$result) throw new Exception($connection->error);
            $how_many_users=$result->num_rows;
            if($how_many_users>0){
                $validated=false;
                $_SESSION["errorlogin"]="Wybierz inny login";
            };
            if($validated==true){
                if($connection->query("INSERT INTO lamusy VALUES (NULL, '$login','$passwordHash','$email','')")){
                    $_SESSION['rejestracja']=true;
                    header("Location:../../zaloguj.php");                                
                    exit();
                }else {
                    throw new Exception($connection->error);
                }
            }
            $connection->close();
            header("Location:../../stworz.php");            
        }
    }
    catch(Exception $e){
        echo "blad serwera";
        echo $e;
    }
};
?>