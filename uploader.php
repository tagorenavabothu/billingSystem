<?php
$target_path = "uploads/";



$temp = explode(".", $_FILES["uploadedfile"]["name"]);
$newfilename =  'sample.' . end($temp);
$target_path = $target_path . $newfilename; 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "The file ".  $newfilename. 
    " has been uploaded";
    header("Location: index.php");
} else{
    echo "There was an error uploading the file, please try again!";
}
?>