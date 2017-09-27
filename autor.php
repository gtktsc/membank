<?php
require_once "src/procedures/header.php";
renderHeader();
?>
<main>
      <section class="mem-list autor">
            <?php
                  if(isset($_GET["autor"]) ){
                        require_once "src/procedures/connect.php";
                        $conn = new mysqli($servername, $username, $password,$databaseName);
                        if ($conn->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                        }else{
                              $autorRaw = $_GET["autor"];
                              $autor = (string)$_GET["autor"];
                              $autorTest1= htmlspecialchars($autor);
                              $autorTest2= mysqli_real_escape_string($conn, $autorTest1);
                              if($autorRaw!=$autorTest2){
                                    header("Location:index.php");  
                                    exit(); 
                              }; 
                              $sql = "SELECT * FROM $tableName WHERE autor = '$autorTest2' ORDER BY id desc";
                              if ($result = $conn->query($sql)) {
                                    $hasMeme = $result->num_rows;
                                    if($hasMeme>0){
                                          while ($obj = $result->fetch_object()) {
                                                $element = array(
                                                      'id'            => $obj->id,
                                                      'autor'         => $obj->autor,
                                                      'image'         => base64_encode( $obj->image )
                                                );
                                                      echo "<div class ='mem'><a href='post.php?mem=".$element['id']."'><img src='data:image/jpeg;base64,".$element['image']."'/></a><br></div>";
                                          }
                                    }else{
                                          header("Location:index.php");       
                                    }
                              } else {
                                    echo $conn->error;
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