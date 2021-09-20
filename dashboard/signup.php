<?php
include "../proses/connect.php";
date_default_timezone_set("Asia/Bangkok");
session_start();
if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $tanggal = date("Y-m-d H:i:s");
  if (!$username || !$password) {
    echo "Data Masih Kosong";
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION['username'] = $username;
    $insert = mysqli_query($conn, "INSERT INTO tb_admin VALUES ('','$username','$password','$tanggal')");
    if ($insert) {
      echo "Sukses";
    } else {
      echo "Gagal";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta name="author" content="Script Tutorials" />
  <title>Madhava Trip Nusa Penida | Dashboard - SignUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="icon" href="../favicon.png">
  <!-- attach CSS styles -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link href="../css/style.css" rel="stylesheet" />
  <style media="screen">
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="container">
      <div class="register-box center-card col-md-10" style="margin-top : 90px;">
        <div class="register-logo">
          <h1><a href="index.php"><b>Madhava</b> Trip Nusa Penida</a></h1>
        </div>
        <div class="register-box-body">
          <p class="login-box-msg">Register a new membership</p>
          <form action="signup.php" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
        </div>
        <div class="">
          <button type="submit" class="center btn btn-primary btn-block btn-flat col-md-12" name="submit">Register</button>
        </div>
        </form>
        <br>
        <a href="login.php" class="text-center">I already have a membership</a>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</html>