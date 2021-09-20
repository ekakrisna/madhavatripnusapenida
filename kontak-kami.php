<?php
session_start();
$_SESSION['session'] = session_id();
function total_online()
{
  $host = "localhost";
  $username = "root";
  $password = "";
  $databasename = "madhavatripnusapenida";
  $connect = mysqli_connect($host, $username, $password, $databasename);
  $current_time = time();
  $timeout = $current_time - (60);

  $session_exist = mysqli_query($connect, "SELECT session FROM total_visitors WHERE session='" . $_SESSION['session'] . "'");
  $session_check = mysqli_num_rows($session_exist);

  if ($session_check == 0 && $_SESSION['session'] != "") {
    mysqli_query($connect, "INSERT INTO total_visitors values ('','" . $_SESSION['session'] . "','" . $current_time . "')");
  } else {
    $sql = mysqli_query($connect, "UPDATE total_visitors SET time='" . time() . "' WHERE session='" . $_SESSION['session'] . "'");
  }

  $select_total = mysqli_query($connect, "SELECT * FROM total_visitors WHERE time>= '$timeout'");
  $total_online_visitors = mysqli_num_rows($select_total);
  return $total_online_visitors;
}

if (isset($_POST['get_online_visitor'])) {
  $total_online = total_online();
  echo $total_online;
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Madhava Trip Nusa Penida | Kontak Kami</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/mediaelementplayer.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/fl-bigmug-line.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="site-loader"></div>
  <?php
  include_once 'navbar.php';
  require_once 'search.php';
  require_once 'proses/connect.php';
  $selectimg = mysqli_query($conn, "SELECT * FROM tb_galery ORDER BY id_galery DESC LIMIT 6 ");
  $rows = mysqli_fetch_assoc($selectimg);
  ?>
  <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/galery/<?php echo $rows['nama_galery'] ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-10">
          <h1 class="mb-2">Kontak Kami</h1>
          <div><a href="home">Home</a> <span class="mx-2 text-white">&bullet;</span> <strong class="text-white">Kontak Kami</strong></div>
        </div>
      </div>
    </div>
  </div>
  <div class="site-section">
    <div class="container">
      <div align="center" class="row">
        <div class="col-lg-12">
          <div class="site-section-title">
            <h2>Kontak Kami</h2>
          </div>
        </div>
      </div>
      <hr style="border: 1px solid #5ea52b;">
      <div align="center">
        <div class="row">
          <div class="col-lg-4">
            <div class="mb-2 py-2"><img src="images/call.png" class="scale-with-grid" alt="call" width="100" height="100" /></div>
            <div class="list_right">
              <h4>Telepon</h4>
              <div class="mb-2 py-2"><a href="tel:+6285376767940">+6285376767940</a></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mb-2 py-2"><img src="images/download.png" class="scale-with-grid" alt="whatsapp" width="100" height="100" /></div>
            <div class="list_right">
              <h4>Whatsapp</h4>
              <div class="mb-2 py-2"><a href="https://api.whatsapp.com/send?phone=6285376767940=Hallo%20Madhava%20Trip%20Nusa%20Penida">+6285376767940</a></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mb-2 py-2"><img src="images/email.png" class="scale-with-grid" alt="yahoo-mail" width="100" height="100" /></div>
            <div class="list_right">
              <h4>Email</h4>
              <div class="mb-2 py-2"><a href="mailto:kokix1986@gmail.com">kokix1986@gmail.com</a></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="mb-2 py-2"><img src="images/facebook.png" class="scale-with-grid" alt="facebook" width="100" height="100" /></div>
            <div class="list_right">
              <h4>Facebook</h4>
              <div class="mb-2 py-2"><a href="https://www.facebook.com/kokix.ne">Kokix Ne</a></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mb-2 py-2"><img src="images/instagram.png" class="scale-with-grid" alt="instagram" width="100" height="100" /></div>
            <div class="list_right">
              <h4>Instagram</h4>
              <div class="mb-2 py-2"><a href="https://www.instagram.com/kokixne/">kokixne</a></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mb-2 py-2"><img src="images/home.png" class="scale-with-grid" alt="home" width="100" height="100" /></div>
            <div class="list_right">
              <h4>Kantor</h4>
              <div class="mb-2 py-2">Br. Jepun, Batumulapan, Desa Batununggul, Kec. Nusa Penida, Kab. Klungkung</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section the_content no_content">
    <div class="section_wrapper">
      <div class="the_content_wrapper"></div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <div class="site-section site-section-sm bg-primary">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="text-white">Nikmati Liburan Anda Bersama Kami</h2>
          <p class="text-white">Terdapat banyak pilihan paket tour menarik yang di tawakan seperti Paket Halfday (1 Hari Balik), Paket Half Day + Snorkeling, Paket 1 Hari 1 Malam (1D1N), Paket 1 Hari 1 Malam + Snorkeling, Paket 2 Hari 1 Malam (2D1N), Paket 2 Hari 1 Malam + Snorkeling, dan juga melayani pemesanan ticket fast boat ke Nusa Penida.</p>
        </div>
        <div class="col-md-4 text-center">
          <a href="paket" class="btn btn-outline-primary text-black btn-block py-3 btn-lg">Lihat Paket</a>
        </div>
      </div>
    </div>
  </div>
  <?php include_once 'footer.php' ?>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/mediaelement-and-player.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/search.js"></script>
  <script src="js/main.js"></script>
  <script style="text/javascript">
    $(document).ready(function() {
      var navpos = $('.site-navbar').offset();
      console.log(navpos.top);
      $(window).bind('scroll', function() {
        if ($(window).scrollTop() > navpos.top) {
          $('.site-navbar').addClass('sticky');
          // $('sticky').removeClass('.site-navbar');
        } else {
          $('sticky').addClass('sticky');
          $('.site-navbar').removeClass('sticky');
        }
      });
    });
  </script>
</body>

</html>