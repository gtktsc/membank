<?php
session_start();
if(!isset($_SESSION["logged"]) || !isset($_SESSION["userName"])){
    header('Location:zaloguj.php');
    exit();
};
    $validated=true;
    $login=$_SESSION["userName"];
    $email=$_POST['email'];
    $emailsafe=filter_var($email, FILTER_SANITIZE_EMAIL);
    if(filter_var($emailsafe,FILTER_VALIDATE_EMAIL)==false || $emailsafe!=$email ){
        $validated=false;
        $_SESSION["errormail"]="Niepoprawny adres e-mail";
    };
    require_once("connect.php");
    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
        $connection = new mysqli($servername,$username,$password,$databaseName);
        if($connection->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }else{
            $result= $connection->query("SELECT id FROM lamusy WHERE email='$email'");
            if(!$result) throw new Exception($connection->error);
            $how_many_users=$result->num_rows;
            if($how_many_users>0){
                $validated=false;
                $_SESSION["errormail"]="Podany adres został już wykorzystany";
            };
            if($validated==true){
                if($connection->query("UPDATE lamusy SET email = '$email' WHERE login = '$login'")){
                    header("Location:../../ustawienia.php");
                    $_SESSION["errormail"]='Adres został zmieniony';                               
                    exit();
                }else {
                    throw new Exception($connection->error);
                }
            }
            $connection->close();
            header("Location:../../ustawienia.php");            
        }
    }
    catch(Exception $e){
        echo "blad serwera";
        echo $e;
    }
?>