<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Very First Page</title>
</head>
<body>
  <div class="content">
    <div class="top">
      <?php if($_SESSION['error']) {
        echo "<p>{$_SESSION['error']}</p>";
        unset($_SESSION['error']);
      } ?>
    </div>
    <div class="auth_block">
      <form action="/login" method="POST" id="login_form">
        <div class="form_control lgn_field">
          <label for="username">Username</label>
          <input type="text" id="username" placeholder="Enter your username" name="username">
        </div>
        <div class="form_control pwd_field">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Enter your password" name="password">
        </div>
        <div class="form-control submit">
          <input type="submit">
        </div>
      </form>
    </div>
  </div>
</body>

</html>