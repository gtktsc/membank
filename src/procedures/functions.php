<?php
function getvotes($servername, $username, $password,$databaseName,$memeID){
    $conn = new mysqli($servername, $username, $password,$databaseName);    
    $sqlVote = "SELECT * FROM oceny WHERE memid = $memeID";
    if ($resultVote = $conn->query($sqlVote)) {
          $elementVote = array();
          $resultArray = array();
          $sumVotes=0;
          $voters=0;
          while ($objVote = $resultVote->fetch_object()) {
                $voters++;
                $elementVote = array(
                      'id'            => $objVote->memid,
                      'autor'         => $objVote->userid,
                      'vote'          => $objVote->vote
                      );
                $sumVotes+=$elementVote["vote"];
                array_push($resultArray, $elementVote);        
          }
          if($voters>0){
                $ocena=$sumVotes/$voters;
          }else{
                $ocena=0;
          };
          return $ocena;
      }
}

?>