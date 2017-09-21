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
                                                      if($elementVote["autor"]==$_SESSION["userId"]){
                                                            if($elementVote["vote"]==1){
                                                                  $yourVote='voted-up';  
                                                            }else if($elementVote["vote"]==-1){
                                                                  $yourVote='voted-down';  
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
            <h3 class = "votes"><span id="vote-up" class = "<?php if($yourVote=="voted-up") echo $yourVote ?>">&blacktriangle;</span><span id = "vote"><?=$ocena?></span><span id="vote-down" class = "<?php if($yourVote=="voted-down") echo $yourVote ?>">&blacktriangledown;</span></h3>
            <h3>autor: <span><?=$element['autor']?></span></h3>

      </section>
</main>
<script>
document.getElementById("vote-up").addEventListener("click", function(){vote('up');});
 document.getElementById("vote-down").addEventListener("click", function(){vote('down');});
function vote (how) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                 
                  
                  document.getElementById("vote").innerHTML=this.responseText;
                  
                  

            }
      };
      if(how==='up'){
            xmlhttp.open("POST", "src/procedures/voteUp.php", true);
            document.getElementById("vote-up").classList.add("voted-up");
            document.getElementById("vote-down").classList.remove("voted-down");

      }else if(how==='down'){
            xmlhttp.open("POST", "src/procedures/voteDown.php", true);
            document.getElementById("vote-down").classList.add("voted-down");
            document.getElementById("vote-up").classList.remove("voted-up");


      };
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("user=<?=$_SESSION["userId"]?>&memid=<?= $memeTest2?>");
}

</script>
<?php
require_once "src/procedures/footer.php";
renderFooter();
?>