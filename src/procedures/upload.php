<?php
session_start();
require_once "connect.php";

$target_file = basename($_FILES["file"]["name"]);

$image = addslashes(file_get_contents($_FILES['file']['tmp_name']));

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $conn = new mysqli($servername, $username, $password,$databaseName);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else{
        //echo 'dzialam';
    }
    $autorName=$_SESSION['userName'];
    $sql = "INSERT INTO `mems` (`image`, `autor`) VALUES ('$image', '$autorName')";

    if ($conn->query($sql) === TRUE) { 
        header('Location:../../index.php');
        //echo 'ok';
    } else {
        //echo 'error';
        header('Location:../../add.php');
    }
}
?>