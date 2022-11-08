<?php

$username = $_GET['un'];

$target_dir = "user-content/$username/";
$target_file = $target_dir . basename($_FILES['file']['name']);
$uploadOk = 1;

$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if(isset($_POST['submit'])) {
  $x = getimagesize($_FILES['file']['tmp_name']);
  if($x !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

if($uploadOk == 1) {
  if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
    header('Location: ?p=user&s=profilepicture_changeform&un=' . $username);
  } else {
    echo('ERROR');
  }
}

?>
