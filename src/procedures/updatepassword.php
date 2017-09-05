<?php
session_start();
if(!isset($_SESSION["logged"]) || !isset($_SESSION["userName"])){
    header('Location:zaloguj.php');
    exit();
};
    $oldPassword=$_POST['passwordold'];
    $validated=true;
    $login=$_SESSION["userName"];
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
    require_once("connect.php");
    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
        $connection = new mysqli($servername,$username,$password,$databaseName);
        if($connection->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }else{
            $result= $connection->query("SELECT * FROM lamusy WHERE login='$login'");
            if(!$result) throw new Exception($connection->error);
            $userData = $result->fetch_assoc();
            if(!password_verify($oldPassword,$userData['password']) ){
                $validated=false;
                $_SESSION["errorpass"]="Wprowadzono niepoprawne hasło";
            };            
            if($validated==true){
                if($connection->query("UPDATE lamusy SET password = '$passwordHash' WHERE login = '$login'")){
                    header("Location:../../ustawienia.php");
                    $_SESSION["errorpass"]='Haslo zostało zmienione';                               
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