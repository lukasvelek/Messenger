<?php

$username = $_GET['un'];

$dir = "user-content/$username/";

$files = scandir($dir);

unset($files[0]);
unset($files[1]);

?>
<div class="row">
  <div class="col-md">
    <form action="?p=user&s=profilepicture_newphoto_upload&un=<?php echo($username); ?>" method="POST" enctype="multipart/form-data">
      <label for="file">Nahrát nový obrázek: </label>
      <input type="file" name="file">
      <input type="submit" value="Nahrát">
    </form>
    <hr>
    <a href="?p=user&s=profilepicture_update&name=default">Nastavit výchozí</a>
    <hr>
    <?php

    foreach($files as $f) {
      $fn = $f;
      echo('<img src="' . $dir . $fn . '" width="64" height="64"><a href="?p=user&s=profilepicture_update&name=' . $fn . '">' . $fn . '</a><br>');
    }

    ?>
  </div>
</div>
