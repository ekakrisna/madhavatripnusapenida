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
  <title>Madhava Trip Nusa Penida | Tentang Nusa Penida</title>
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
  <?php include_once "navbar.php" ?>
  <?php
  require_once 'search.php';
  require_once 'proses/connect.php';
  $selectimg = mysqli_query($conn, "SELECT * FROM tb_paket ORDER BY id_paket DESC LIMIT 6 ");
  $slide = '';
  while ($row = mysqli_fetch_assoc($selectimg)) {
    $slide .= "<div class='site-blocks-cover' style='background-image: url(images/paket/" . $row['gambar'] . ");' data-aos='fade' data-stellar-background-ratio='0.5'>      
      </div>  ";
  }
  ?>
  <div class="slide-one-item content home-slider owl-carousel">
    <?php echo $slide; ?>
  </div>
  ?>
  <div class="site-section site-section-sm bg-light">
    <div class="container">
      <div align="center" class="row">
        <div class="col-12">
          <div class="site-section-title">
            <h2>Pengetahuan Tentang Nusa Penida</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <p class="text-justify">
            <p class="text-justify">Pulau Nusa Penida merupakan daerah kepualauan kecil yang terletak di bagian selatan Bali daratan dan dipisahkan oleh selat Badung. Sehingga apabila Anda ingin liburan ke Nusa Penida atau tirtayatra ke Nusa Penida, Anda harus terlebih dahulu menyebrang melalui jalur laut. Sarana transportasi laut ke Nusa Penida tersedia seperti sampan tradisional (jukung), boat cepat (speed boat), kapal roro Nusa Jaya Abadi (moda transportasi utama).</p>
            <p class="text-justify">Nusa Penida terdiri atas tiga pulau utama yaitu Nusa Gede, Nusa Ceningan, dan Nusa Lembongan-Jugutbatu. “Telur emasnya Bali” sedang menetas, itulah yang didegung bahwa Wisata Nusa Penida telah sedang berkembang melesat.</p>
            <p class="text-justify">Kami <a href="madhavatripnusapenida.com">madhavatripnusapenida.com</a> adalah salah satu Biro jasa Tour & Travel yang melayani perjalanan Wisata di Nusa Penida, Liburan di Nusa Penida, dan Paket Wisata Murah di Nusa Penida dan sudah beroperasi sejak tahun 2014. Kami menyediakan Paket Wisata Nusa Penida / Paket Tour Nusa Penida untuk liburan ke Nusa Penida dengan harga Paket Tour Hemat dan Bersahabat.</p>
            <p class="text-justify">Dipandu oleh Tour Guide Lokal asli Nusa Penida yang Profesional dan Pengalaman dibidang Pariwisata. Kami juga memiliki Jaringan yang cukup luas di Area-area Tempat wisata Indah Nusa Penida, Perhotelan, Restaurant dan tempat menarik lainnya sehingga kami dapat membantu Anda dalam memenuhi dan mewujudkan liburan Anda ke Nusa Penida yang menarik dan menyenangkan.</p>
            <p class="text-justify">Dan kami ucapkan terima kasih kepada Anda telah berkunjung ke website kami, rencanakan liburan Anda ke Nusa Penida dan jadikan kami sebagai teman wisata Anda.</p>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="site-section site-section-sm bg-primary">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="text-black">Selamat Datang di <a href="home" class="text-black">Madhava Trip Nusa Penida</a></h2>
          <p class="lead text-black-5 text-justify"><a href="home" class="text-black">Madhava Trip Nusa Penida</a> melayani jasa tour dan travel di Nusa Penida, <br> kami memiliki banyak pilihan paket berlibur yang menarik dan harga yang bersahabat.</p>
        </div>
        <div class="col-md-4 text-center">
          <a href="kontak-kami" class="btn btn-outline-primary text-black btn-block py-3 btn-lg">Kontak Kami</a>
        </div>
      </div>
    </div>
  </div>
  <?php include_once "footer.php" ?>

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
  <script type="text/javascript">
    $(document).ready(function() {
      setInterval(function() {
        $.ajax({
          type: 'post',
          url: '',
          data: {
            get_online_visitor: "online_visitor",
          },
          success: function(response) {
            if (response != "") {
              $("#online_visior_val").html(response);
            }
          }
        });
      }, 10000)
    });
  </script>
</body>

</html>