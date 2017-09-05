<?php
require_once "src/procedures/header.php";
renderHeader();
if(isset($_SESSION["loginError"])){
      echo "<h2 class = 'error'>".$_SESSION["loginError"]."</h2>";
      unset($_SESSION["loginError"]);
};
if(isset($_SESSION["errorpass"])){
      echo "<h2 class = 'error'>".$_SESSION["errorpass"]."</h2>";
      unset($_SESSION["errorpass"]);
};
?>


<main>


      <section class = "acc-add">
            <h1>Zaloguj się, aby dodawać materiały</h1> 
            <form action="src/procedures/login.php" method="post">
                  <label for="login">Wprowadź login:</label>
                  <input type="text" id="login" name="login" required>
                  <label for="password">Wprowadź hasło:</label>
                  <input type="password" id="password" name="password" required>
                  <input type="submit" value="Zaloguj" name="submit">
            </form>
            <a href="przywroc.php">
                  <button>Przypomnij hasło</button>
            </a>
      </section>



</main>

<?php
require_once "src/procedures/footer.php";
renderFooter();
?>