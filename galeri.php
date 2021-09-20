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
  <link rel="icon" type="images/png" href="favicon.png" />
  <title>Madhava Trip Nusa Penida | Galeri</title>
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

  <?php include 'navbar.php';
  require_once 'search.php';
  require_once 'proses/connect.php';
  $selectimg = mysqli_query($conn, "SELECT * FROM tb_paket ORDER BY id_paket DESC LIMIT 3 ");
  $slide = '';
  while ($row = mysqli_fetch_assoc($selectimg)) {
    $slide .= "<div class='site-blocks-cover' style='background-image: url(images/paket/" . $row['gambar'] . ");' data-aos='fade' data-stellar-background-ratio='0.5'>    
      <div class='row align-items-center justify-content-center text-center'>
            <div class='col-md-10'>
              <h1 class='mb-2' id=''>Galery</h1>              
            </div>
          </div>
  </div>  ";
  }
  ?>
  <div class="slide-one-item content home-slider owl-carousel">
    <?php echo $slide; ?>
  </div>
  <div class="site-section site-section-sm bg-light">
    <div class="container">
      <div align="center" class="row mb-5">
        <div class="col-12">
          <div class="site-section-title">
            <h2>Galeri Madhava Trip Nusa Penida</h2>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <?php
        $selectall = mysqli_query($conn, "SELECT * FROM tb_galery ORDER BY id_galery DESC");
        if (mysqli_num_rows($selectall) > 0) {
          while ($row = mysqli_fetch_assoc($selectall)) { ?>
            <div class="gallery_product col-md-6 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="100">
              <a href="images/galery/<?php echo $row['nama_galery']; ?>" class="image-popup gal-item prop-entry d-block">
                <img src="images/galery/<?php echo $row['nama_galery']; ?>" alt="<?php echo $row['nama_galery']; ?>" class="img-fluid">
              </a>
            </div>
        <?php
          }
        } else {
          echo "<h1 class='col-md-12 text-center'>Menu Not Available</h1>";
        }
        ?>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>

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