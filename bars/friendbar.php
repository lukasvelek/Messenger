<script type="text/javascript">
  $(document).ready(function() {
    $.ajax({
      type: "GET",
      url: "api/get/get-friends-friendbar.php",
      dataType: "html",
      success: function(data) {
        $('#friends').append(data);
      }
    });
  });
</script>

<div class="col-md-2" id="friends">
  <hr>
  <a href="?p=home">Příspěvky</a>
  <hr>
  <a href="?p=friends&s=addform">Přidat uživatele</a>
  <hr>
</div>
