<?php
session_start();
require_once ("connect.php");

$conn = new mysqli($servername, $username, $password,$databaseName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    //echo 'dzialam';
}

$conn->select_db($databaseName);

$startIndex = (int)$_POST['startIndex']; //odkąd zaczynamy pobieranie
$postsPerPage = (int)$_POST['postsPerPage']; //ile pobieramy

//pobieramy ostatni rekord - posluzy nam to do przekazania czy tablica wpisow sie skonczyla
//nie mozemy tutaj polegac na tym, ze za pomocą js spradzimy czy pobrano stosowną liczbę wpisow
// $sql = "SELECT id FROM $tableName ORDER BY id DESC LIMIT 1";
// $lastRowId = false;
// if ($result = $conn->query($sql)) {
//     $lastRowId = $result->fetch_object()->id;
// } else {
//     die("Connection failed: " . $conn->connect_error);
// }
// $sql = "SELECT * FROM $tableName LIMIT $postsPerPage OFFSET $startIndex";
$sql = "SELECT * FROM $tableName ORDER BY id DESC LIMIT $postsPerPage OFFSET $startIndex";

$lastRowId = 0;

//jezeli pobranie elementow zakonczylo sie powodzeniem
if ($result = $conn->query($sql)) {
    $elements = array();
    $resultArray = array(
        'elements' => $elements,
        'endList' => $lastRowId
    );

    $i=$startIndex;

    while ($obj = $result->fetch_object()) {
        $i++;
        $element = array(
            'id'            => $obj->id,
            'autor'         => $obj->autor,
            'image'         => base64_encode( $obj->image )
        );
        if ($obj->id == $lastRowId) {
            $resultArray['endList'] = true;
        }
        $sqlVote = "SELECT * FROM oceny WHERE memid = '".$element['id']."'";
        if ($resultVote = $conn->query($sqlVote)) {
              $elementVote = array();
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
            };
            if($voters>0){
                $ocena=$sumVotes/$voters;
            }else{
                $ocena=0;
            };
        }
        $element['vote']=$ocena;
        if(isset($_SESSION['userId'])){
            $element['userVote']=$yourVote;
            $element['activeUser']=$_SESSION['userId'];
        }else{
            $element['activeUser']='none';
            
        }
        array_push($resultArray['elements'], $element);        
    }
    echo json_encode($resultArray);
} else {
    echo $conn->error;
}
?>