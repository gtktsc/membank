<?php
require_once "src/procedures/header.php";
renderHeader();
?>
<script type="text/javascript">
      
        var onSubmit = function(token) {
          console.log('success!');
          document.getElementById("create-form").submit();
        };

        var onloadCallback = function() {
          grecaptcha.render('submitInput', {
            'sitekey' : '6LczJC8UAAAAAJAxBMNGKCGN4DtKpMCL78_JDzae',
            'callback' : onSubmit
          });
        };
    </script>
<main>
      <section class = "acc-add">
            <form method = "post" action="src/procedures/create.php" id ="create-form">
                  <label for="login">Wprowadź login (od 3 do 20 znaków):</label> 
                  <input id = "login" type="text" name = "login">
                  <label for="email">Wprowadź swój adres e-mail:</label> 
                  <input id = "email" type="text" name = "email">
                  <label for="password">Wprowadź hasło (powyżej 6 znaków):</label> 
                  <input id = "password" type="password" name = "password">
                  <label for="passwordre">Powtórz hasło:</label> 
                  <input id = "passwordre" type="password" name = "passwordre">
                  <label for="regulamin">Zaakceptuj <a href="regulamin.php">regulamin</a>:</label> 
                  <input id = "regulamin" type="checkbox" name = "regulamin">
                  <input type="submit" value="Stwórz" id = "submitInput">
                  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
                  <?php
                    if(isset($_SESSION["errornick"])){
                            echo "<span>".$_SESSION["errornick"]."</span><br>";
                            unset ($_SESSION["errornick"]);
                    };
                    if(isset($_SESSION["errormail"])){
                            echo "<span>".$_SESSION["errormail"]."</span><br>";
                            unset ($_SESSION["errormail"]);
                    };
                    if(isset($_SESSION["errorpass"])){
                            echo "<span>".$_SESSION["errorpass"]."</span><br>";
                            unset ($_SESSION["errorpass"]);
                    };
                    if(isset($_SESSION["errorregulamin"])){
                            echo "<span>".$_SESSION["errorregulamin"]."</span><br>";
                            unset ($_SESSION["errorregulamin"]);
                    };
                    if(isset($_SESSION["errorlogin"])){
                            echo "<span>".$_SESSION["errorlogin"]."</span><br>";
                            unset ($_SESSION["errorlogin"]);
                    };
                  ?>
            </form>
      </section>
</main>
<?php
require_once "src/procedures/footer.php";
renderFooter();
?>