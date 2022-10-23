<?php

$fullname = htmlspecialchars($_POST['fullname']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$password_hash = hash("sha512", $password);

$sql = "INSERT INTO `users` (`username`, `fullname`, `password`)
        VALUES ('$username', '$fullname', '$password_hash')";

$result = $db->query($sql);

if($result === TRUE) {
  header('Location: ?p=login&s=form');
}

?>
