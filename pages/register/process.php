<?php

$fullname = htmlspecialchars($_POST['fullname']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$password_hash = hash("sha512", $password);

$sql_users = "SELECT `id` FROM `users` WHERE `username` LIKE '$username'";

if($db->numRows($sql) > 0) {
  header('Location: ?p=register&s=form');
}

$sql_insert = "INSERT INTO `users` (`username`, `fullname`, `password`)
               VALUES ('$username', '$fullname', '$password_hash')";

$result = $db->query($sql_insert);

if($result === TRUE) {
  header('Location: ?p=login&s=form');
}

?>
