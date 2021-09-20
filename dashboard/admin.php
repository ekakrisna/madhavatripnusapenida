<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location:../dashboard/");
}
$user = $_SESSION['username'];
include_once '../proses/connect.php';
date_default_timezone_set("Asia/Bangkok");

$result = mysqli_query($conn, "SELECT * FROM tb_transaksi ORDER BY tanggal_booking DESC");
$row = mysqli_fetch_array($result);
if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['baru']);
  $password = mysqli_real_escape_string($conn, $_POST['lama']);
  $tanggal = date("Y-m-d H:i:s");
  if (!$username || !$password) {
    echo "<script type='text/javascript'>alert('Password Kosong');</script>";
  } elseif ($username != $password) {
    echo "<script type='text/javascript'>alert('Password Tidak Sama');</script>";
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);    
    $insert = mysqli_query($conn, "UPDATE tb_admin SET pass = '$password', created_at = NOW() WHERE username = '$user'");        
    if ($insert) {
      echo "<script type='text/javascript'>alert('Password Berhasil Di Update');</script>";
    } else {
      echo "<script type='text/javascript'>alert('Password Gagal Di Update');</script>";
    }
  }    
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Madhava Trip Nusa Penida | Dashboard - Admin</title>
  <link rel="icon" href="../favicon.png">
  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../css/menu.css">
  <style media="screen">
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <?php include 'navbar.php' ?>
    <div id="content">
      <div class="row">
        <div class="" style="max-width: 440px; ">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="../images/users.png" class="card-img" alt="...">
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <h5 class="card-title">Booking</h5>
                <p class="card-text"><?php echo "Total Booking " . mysqli_num_rows($result) . " Orang."; ?></p>
                <p class="card-text"><?php echo "Last updated " . $row['tanggal_booking'] . "."; ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <h1>Selamat Datang <?php echo $_SESSION['username'] ?></h1>
        </div>
      </div>
      <div align="center">
        <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#exampleModalCenter">
          Ubah Password
        </button>
      </div>
      <form action="admin.php" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="mb-2">
                  <input class="form-control" type="password" name="baru" id="" placeholder="Password Baru">
                </div>
                <div class="">
                  <input class="form-control" type="password" name="lama" id="" placeholder="Ulangi Password Baru">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="submit" name="submit" class="btn btn-primary" value="Ganti Password">
                <!-- <button type="button" name="submit" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<!-- Menu Icon  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Menu Icon  -->
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
      $('#sidebar').toggleClass('active');
    });
  });
</script>

</html>