<?php

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$password_hash = hash("sha512", $password);

$sql = "SELECT * FROM `users` WHERE `username` LIKE '$username' AND `password` LIKE '$password_hash'";

$users = $db->query($sql);

foreach($users as $u) {
  setcookie('user_username', $username);
  setcookie('user_password', $password);
  setcookie('user_id', $u['id']);
}

header('Location: ?');

?>
