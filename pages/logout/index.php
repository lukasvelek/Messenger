<?php

unset($_COOKIE['user_id']);
unset($_COOKIE['user_username']);
unset($_COOKIE['user_fullname']);

setcookie('user_id', null, time() - 3600);
setcookie('user_username', null, time() - 3600);
setcookie('user_fullname', null, time() - 3600);

header('Location: ?');

?>
