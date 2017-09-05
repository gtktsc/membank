<?php
require_once "src/procedures/header.php";
renderHeader();
if(!isset($_SESSION["logged"]) || !isset($_SESSION["userName"])){
      header('Location:zaloguj.php');
      exit();
  };
?>
<main>
<section class = "acc-add">
      <h1>Zmień adres e-mail</h1>
      <form method = "post" action="src/procedures/updatemail.php" id ="create-form">
            <label for="email">Wprowadź nowy adres e-mail:</label> 
            <input id = "email" type="text" name = "email">
            <input type="submit" value="Aktualizuj e-mail" id = "submitInput">
            <?php
            if(isset($_SESSION["errormail"])){
                  echo "<span>".$_SESSION["errormail"]."</span><br>";
                  unset ($_SESSION["errormail"]);
            };
            
            ?>
      </form>
      </section>
      <section class = "acc-add">
      <h1>Zmień hasło</h1>
      <form method = "post" action="src/procedures/updatepassword.php" id ="create-form">
            <label for="password">Wprowadź aktualne hasło:</label> 
            <input id = "passwordold" type="password" name = "passwordold">
            <label for="password">Wprowadź nowe hasło (powyżej 6 znaków):</label> 
            <input id = "password" type="password" name = "password">
            <label for="passwordre">Powtórz hasło:</label> 
            <input id = "passwordre" type="password" name = "passwordre">
            <input type="submit" value="Aktualizuj hasło" id = "submitInput">
            <?php
            if(isset($_SESSION["errorpass"])){
                  echo "<span>".$_SESSION["errorpass"]."</span><br>";
                  unset ($_SESSION["errorpass"]);
            };
            ?>
      </form>
</section>
</main>
<?php
require_once "src/procedures/footer.php";
renderFooter();
?>