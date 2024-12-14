<?php
session_start();
// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buntan Construction</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <!-- Navbar -->
  <?php 
  // include 'Menubar.php'; 
  ?>

  <!-- Login Form -->
  <div class="login-container">
    <form action="Data.php" method="POST" class="login-form">
      <h2>Login</h2>

      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Enter your username" value="qwerty" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" value="qwerty" required>

      <button type="submit">Login</button>

      <!-- <div class="forgot-password">
        <a href="#">Forgot Password?</a>
      </div> -->
    </form>
  </div>

</body>

</html>