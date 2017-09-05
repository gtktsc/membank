<?php
require_once "src/procedures/header.php";
renderHeader();
if(!isset($_SESSION["logged"])){
    header('Location:zaloguj.php');
    exit();
};

?>
<main>

      <section class = "mem-add">
            <form action="src/procedures/upload.php" method="post" enctype="multipart/form-data">
                  <input type="file" name="file" id="file" class="inputfile" required>
                  <label for="file"><span>Dodaj meme:</span></label>     
                  <!-- <input type="text" name="author" id="author" placholder = "tytuł" required> -->
                  <input type="submit" value="wyślij" name="submit">
            </form>

<script>
      var input=document.getElementById('file');
	input.addEventListener( 'change', function( e ){
            var fileName = e.target.value.split( '\\' ).pop();
            input.nextElementSibling.querySelector( 'span' ).innerHTML = fileName;
      });
</script>
      </section>




</main>

<?php
require_once "src/procedures/footer.php";
renderFooter();
?>