<?php
require_once "src/procedures/header.php";
renderHeader();
?>
<main>
<section class = "acc-add">



      <h1>Wprowadź dane aby odzyskać hasło:</h1>
      <form method = "post" action="src/procedures/forgot.php" id ="create-form">
            <label for="login">Wprowadź login:</label> 
            <input id = "login" type="text" name = "login">
            <label for="email">Wprowadź adres e-mail:</label> 
            <input id = "email" type="text" name = "email">
            <input type="submit" value="przywróć hasło" id = "submitInput">
            <?php
            if(isset($_SESSION["errorlogin"])){
                  echo "<span>".$_SESSION["errorlogin"]."</span><br>";
                  unset ($_SESSION["errorlogin"]);
            };
            if(isset($_SESSION["errormail"])){
                  echo "<span>".$_SESSION["errormail"]."</span><br>";
                  unset ($_SESSION["errormail"]);
            };
            
            ?>
      </form>
      </section>
</main>
<?php
require_once "src/procedures/footer.php";
renderFooter();
?>