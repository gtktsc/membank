<?php
require_once "src/procedures/header.php";
renderHeader();
?>
<main>
      <section class="mem-list">
            <?php
                  if(isset($_GET["mem"]) ){
                        require_once "src/procedures/connect.php";
                        $conn = new mysqli($servername, $username, $password,$databaseName);
                        if ($conn->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                        }else{
                              $memeRaw = $_GET["mem"];
                              $meme = (int)$_GET["mem"];
                              $memeTest1= htmlspecialchars($meme);
                              $memeTest2= mysqli_real_escape_string($conn, $memeTest1);
                              if($memeRaw!=$memeTest2){
                                    header("Location:index.php");  
                                    exit(); 
                              }; 
                              if(is_numeric($memeTest2) && $meme!==0){
                                    $sql = "SELECT * FROM $tableName WHERE id = $memeTest2 LIMIT 1";
                                    if ($result = $conn->query($sql)) {
                                          $obj = $result->fetch_object();
                                                $element = array(
                                                      'id'            => $obj->id,
                                                      'autor'         => $obj->autor,
                                                      'image'         => base64_encode( $obj->image )
                                                );

                                          $sqlVote = "SELECT * FROM oceny WHERE memid = $memeTest2";
                                          if ($resultVote = $conn->query($sqlVote)) {
                                                $elementVote = array();
                                                $resultArray = array();
                                                $sumVotes=0;
                                                $voters=0;
                                                $yourVote='none';                                     
                                                while ($objVote = $resultVote->fetch_object()) {
                                                      $voters++;
                                                      $elementVote = array(
                                                            'id'            => $objVote->memid,
                                                            'autor'         => $objVote->userid,
                                                            'vote'          => $objVote->vote
                                                            );
                                                      $sumVotes+=$elementVote["vote"];
                                                      if(isset($_SESSION["userId"])){
                                                            if($elementVote["autor"]==$_SESSION["userId"] ){
                                                                  if($elementVote["vote"]==1){
                                                                        $yourVote='voted-up';  
                                                                  }else if($elementVote["vote"]==-1){
                                                                        $yourVote='voted-down';  
                                                                  };
                                                            };
                                                      };
                                                      array_push($resultArray, $elementVote);        
                                                }
                                                if($voters>0){
                                                      $ocena=$sumVotes/$voters;
                                                }else{
                                                      $ocena=0;
                                                };
                                            } else {
                                                echo $conn->error;
                                          }

                                    } else {
                                          echo $conn->error;
                                    }
                              }else{
                                    header("Location:index.php");                                                            
                              }
                        };
                  }else{
                        header("Location:index.php");                        
                  }
            ?>
            <img src='data:image/jpeg;base64,<?=$element['image']?>'/>
            <?php  if(isset($_SESSION["logged"]) && $_SESSION["logged"]==true): ?>

      
            <h3 class = "votes"><span id="vote-up" class = "<?php if($yourVote=="voted-up") echo $yourVote ?>">&blacktriangle;</span>
            <?php endif; ?>
            <span id = "vote"><?=$ocena?></span>
            <?php  if(isset($_SESSION["logged"]) && $_SESSION["logged"]==true): ?>

            <span id="vote-down" class = "<?php if($yourVote=="voted-down") echo $yourVote ?>">&blacktriangledown;</span></h3>

            <?php endif; ?>


            <h3>autor: <span><a href="autor.php?autor=<?=$element['autor']?>"><?=$element['autor']?></a></span></h3>

      </section>
</main>
<script>
document.getElementById("vote-up").addEventListener("click", function(){
      vote('up',
            <?=$_SESSION["userId"]?>,
            <?= $memeTest2?>,
            document.getElementById("vote"),
            this,
            document.getElementById("vote-down"));});
document.getElementById("vote-down").addEventListener("click", function(){
      vote('down',
            <?=$_SESSION["userId"]?>,
            <?= $memeTest2?>,
            document.getElementById("vote"),
            document.getElementById("vote-up"),
            this);});

</script>
<?php
require_once "src/procedures/footer.php";
renderFooter();
?>