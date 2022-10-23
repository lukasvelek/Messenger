<div class="row">
  <div class="col-md" id="loginform">
    <form action="?p=protected&s=delete-conversation-process" method="POST">
      <label for="username">Heslo: </label>
      <br>
      <input type="password" name="password" required>
      <br>
      <br>
      <input type="text" name="fid" value="<?php echo($_GET['fid']); ?>" hidden>
      <input type="submit" value="Odstranit">
    </form>
  </div>
</div>
