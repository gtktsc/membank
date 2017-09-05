<?php
require_once "src/procedures/header.php";
renderHeader();
?>

<script src="src/script/handlebars.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="src/script/main.js"></script>
<main>
      <section class="mem-list">
            <div class = "mem"></div>
      </section>
      
      <script id="mem-template" type="text/x-handlebars-template">
            <article>
                  <div>
                        <a href="post.php?mem={{memid}}">
                        <img src="data:image/jpeg;base64,{{image}}"/></a>
                        <h3>autor: <span><a href="autor.php?autor={{memautor}}">{{memautor}}</a></span></h3>
                        
                  </div>
            </article>
      </script>
</main>

<?php
require_once "src/procedures/footer.php";
renderFooter();
?>