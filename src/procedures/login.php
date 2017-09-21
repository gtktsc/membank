<?php

session_start();
if(!isset($_POST["login"])){
    header('Location:zaloguj.php');
    exit();
};

require_once "connect.php";

$connection = new mysqli($servername,$username,$password,$databaseName);

if($connection->connect_errno!=0){
    echo "jebalo w ".$connection->connect_errno;
}else{
    $login= $_POST["login"];
    $password= $_POST["password"];

    $login = htmlentities($login,ENT_QUOTES, "UTF-8");


    if($result = @$connection->query(
        sprintf("SELECT * FROM lamusy WHERE login='%s'",
        mysqli_real_escape_string($connection,$login)))){
        $usersNumber = $result->num_rows;
        if($usersNumber==1){
            $userData = $result->fetch_assoc();
            if(password_verify($password,$userData['password']) ){
                $_SESSION["logged"]=true;
                $_SESSION["userName"]=$userData['login'];
                $_SESSION["userId"]=$userData['id'];
                unset($_SESSION['nouser']);
                header('Location:../../index.php');
            }else{
            $_SESSION['nouser']="nieprawidlowy";
            $_SESSION['loginError']="Zły login / hasło";
            header('Location:../../zaloguj.php');
        };   
            $result->close();
        }else{
            $_SESSION['nouser']="nieprawidlowy";
            $_SESSION['loginError']="Zły login / hasło";            
            header('Location:../../zaloguj.php');


        };
    };
    $connection->close();
};
?>