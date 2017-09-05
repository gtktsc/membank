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
                              if(is_numeric($meme) && $meme!==0){
                                    $sql = "SELECT * FROM $tableName WHERE id = $meme LIMIT 1";
                                    if ($result = $conn->query($sql)) {
                                          $obj = $result->fetch_object();
                                                $element = array(
                                                      'id'            => $obj->id,
                                                      'autor'         => $obj->autor,
                                                      'image'         => base64_encode( $obj->image )
                                                );
                                          echo "<img src='data:image/jpeg;base64,".$element['image']."'/>";
                                          echo "<h3>autor: <span>".$element['autor']."</span></h3>";
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
      </section>
</main>
<?php
require_once "src/procedures/footer.php";
renderFooter();
?>