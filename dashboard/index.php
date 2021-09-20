<?php
session_start();
include_once '../proses/connect.php';
date_default_timezone_set("Asia/Bangkok");
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $select   = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$username'");
  if (!$username || !$password) {
    echo "<script type='text/javascript'>alert('Kosong !!!');window.location.href='../dashboard';</script>";
  } else {
    if ($row = mysqli_fetch_array($select)) {
      if (password_verify($password, $row['pass'])) {
        $_SESSION['username'] = $username;
        header("Location: admin");
      } else {
        echo "<script type='text/javascript'>alert('Username dan Password Salah !!!');window.location.href='../dashboard';</script>";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="author" content="Script Tutorials" />
  <title>Madhava Trip Nusa Penida | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="icon" href="../favicon.png">
  <!-- attach CSS styles -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link href="../css/menu.css" rel="stylesheet" />
  <style media="screen">
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="col-lg-3 center-holo text-dark">
      <h2 class="">Login</h2>
      <div class="login-logo">
        <a href="../dashboard"><b class="text-dark text-center">ADMIN</b> Madhava Trip Nusa Penida | Dashboard</a>
      </div>
      <div class="login-box-body">
        <br>
        <form class="" action="index.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="Username">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col">
              <!-- <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"> Sign Up</button> -->
              <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Login">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</html>