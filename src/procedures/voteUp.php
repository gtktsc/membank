<?php
session_start();
$loggedUser = $_POST["user"];
$votedPost = $_POST["memid"];
require_once "functions.php";

if(isset($_SESSION["logged"]) && $_SESSION["logged"]==true){
    require_once "connect.php";    
    $conn = new mysqli($servername, $username, $password,$databaseName);
    if (!$conn->connect_error) {
        $sqlVote = "SELECT * FROM oceny WHERE memid = $votedPost";
        if ($resultVote = $conn->query($sqlVote)) {
            $elementVote = array();
            $resultArray = array();
            $voted=false;
            while ($objVote = $resultVote->fetch_object()) {
                $elementVote = array(
                        'id'            => $objVote->memid,
                        'autor'         => $objVote->userid,
                        'vote'          => $objVote->vote
                        );
                if($elementVote['autor']==$loggedUser){
                    $voted=true;
                };
            }
            if($voted){
                $setVote = 'UPDATE `oceny` SET `vote`=1 WHERE `memid`='.$votedPost.' AND `userid`='.$loggedUser;
            }else{
                $setVote = 'INSERT INTO `oceny`(`memid`, `userid`, `vote`) VALUES ('.$votedPost.','.$loggedUser.',1)';
            }
            $conn->query($setVote);
            echo getvotes($servername, $username, $password,$databaseName,$votedPost);
        }
    }
}else{
    exit();
} 
?>