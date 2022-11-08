<?php

$id = $_COOKIE['user_id'];
$fn = $_GET['name'];

$sql = "";

if($fn == "default") {
  $sql = "UPDATE `users` SET `profile_picture`='' WHERE `id` LIKE '$id'";
} else {
  $sql = "UPDATE `users` SET `profile_picture`='$fn' WHERE `id` LIKE '$id'";
}

$result = $db->query($sql);

header('Location: ?p=user&s=profile');

?>
