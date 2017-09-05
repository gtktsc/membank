<?php
require_once "src/procedures/header.php";
renderHeader();
 if(!isset($_GET["login"]) || !isset($_GET["passwordReset"]) || $_GET["passwordReset"] == ''){
    header('Location:zaloguj.php');
    exit();
}else{
    require_once("src/procedures/connect.php");        
    $conn = new mysqli($servername,$username,$password,$databaseName);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    $loginRaw = $_GET["login"];
    $login = (string)$_GET["login"];
    $loginTest1= htmlspecialchars($login);
    $loginTest2= mysqli_real_escape_string($conn, $loginTest1);
    if($loginRaw!=$loginTest2){
          header("Location:index.php"); 
          exit(); 
    }; 
    $passwordResetRaw = $_GET["passwordReset"];
    $passwordReset = (string)$_GET["passwordReset"];
    $passwordResetTest1= htmlspecialchars($passwordReset);
    $passwordResetTest2= mysqli_real_escape_string($conn, $passwordResetTest1);
    if($passwordResetRaw!=$passwordResetTest2){
          header("Location:index.php");  
          exit(); 
    }; 
    $result= $conn->query("SELECT * FROM lamusy WHERE login='$login'");
    $how_many_users=$result->num_rows;
    if($how_many_users>0){
        $userData = $result->fetch_assoc();
        if($passwordResetRaw==$userData['passwordReset']){
            if(isset($_POST['password'])){
                $validated=true;
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
                if($validated==true){
                    if($conn->query("UPDATE lamusy SET password = '$passwordHash' passwordReset = '' WHERE login = '$login'")){
                        $_SESSION["errorpass"]='Haslo zostało zmienione';  
                        header("Location:zaloguj.php");                               
                        exit();
                    }
                }else{
                    $address="Location:reset.php?login=".$login."&passwordReset=".$passwordResetRaw;
                    header($address);  
                }
                
                $conn->close();

            }
        }
    }else{
        header("Location:index.php");  
        exit();
    }
}
?>
<main>
      <section class = "acc-add">
      <h1>Zmień hasło</h1>
      <form method = "post" id ="create-form">
            <label for="login">Login:</label> 
            <input id = "login" type="text" name = "login" placeholder="<?php echo $_GET["login"]; ?>" disabled>
            <label for="password">Wprowadź nowe hasło (powyżej 6 znaków):</label> 
            <input id = "password" type="password" name = "password">
            <label for="passwordre">Powtórz hasło:</label> 
            <input id = "passwordre" type="password" name = "passwordre">
            <input type="submit" value="Zmień hasło" id = "submitInput">
            <?php
            if(isset($_SESSION["errorpass"])){
                  echo "<span>".$_SESSION["errorpass"]."</span><br>";
            };
            ?>
      </form>
</section>
</main>
<?php
require_once "src/procedures/footer.php";
renderFooter();
?>