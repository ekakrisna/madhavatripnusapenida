<?php
session_start();
$_SESSION['session'] = session_id();
function total_online()
{
  $host = "localhost";
  $username = "root";
  $password = "";
  $databasename = "ulakanvi_madhavatrip";
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
  <link rel="icon" type="images/ico" href="madhava.ico" />
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
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v4.0&appId=2554457474571320&autoLogAppEvents=1"></script>
  <div class="site-loader"></div>
  <?php
  require_once 'search.php';
  include 'navbar.php';
  include 'proses/connect.php'; ?>
  <?php if (isset($_GET['q'])) :
    $query_search = mysqli_escape_string($conn, $_GET['q']);
    $getAllData = mysqli_query($conn, "SELECT * FROM tb_paket WHERE nama_paket LIKE '%$query_search%' OR deskripsi LIKE '%$query_search%' ORDER BY id_paket DESC");
    $row = mysqli_fetch_assoc($getAllData);
  ?>
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/paket/<?php echo $row['gambar']; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2" id="myBtnContainer">Paket</h1>
            <div><a href="home">Home</a> <span class="mx-2 text-white">&bullet;</span> <strong class="text-white">Paket</strong><span class="mx-2 text-white"></span></div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section site-section-sm bg-light" id="menu">
      <div class="container">
        <div align="center" class="row">
          <div class="col-12">
            <div class="site-section-title">
              <h2> <?php echo mysqli_num_rows($getAllData) ?> Hasil Pencarian Paket</h2>
            </div>
          </div>
        </div>
        <hr style="border: 1px solid #5ea52b;">
        <div class="row mb-5">
          <?php if (mysqli_num_rows($getAllData) > 0) {
            while ($array = mysqli_fetch_assoc($getAllData)) { ?>
              <div class="col-md-6 col-lg-4 mb-4">
                <a href="<?php echo $array['flag']; ?>.html" class="prop-entry d-block">
                  <figure>
                    <img src="images/paket/<?php echo $array['gambar']; ?>" alt="Image" class="img-fluid">
                  </figure>
                  <div class="prop-text">
                    <div class="inner">
                      <h3 class="title price rounded"><?php echo $array['nama_paket']; ?></h3>
                      <br>
                      <p class="location">Br. Jepun, Batumulapan, Desa Batununggul, Kec. Nusa Penida, Kab. Klungkung</p>
                    </div>
                  </div>
                </a>
              </div>
            <?php } ?>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <div class="container">
      <h1 class='col-md-12 text-center'>Hasil Pencarian Tidak Ditemukan</h1>
    </div>
  <?php }
  ?>
<?php elseif (isset($_GET['paket-link'])) :
    $promo_link = $_GET['paket-link'];
    $select = mysqli_query($conn, "SELECT * FROM tb_paket WHERE flag = '$promo_link'");
    $link = mysqli_fetch_assoc($select);
    $promo = $link['nama_paket'];
    // $select_image = mysqli_query($conn, "SELECT * FROM tb_images WHERE promo = '$promo'"); 
?>
  <title>Madhava Trip Nusa Penida | <?php echo $promo ?></title>
  <div class="site-blocks-cover overlay" style="background-image: url(images/paket/<?php echo $link['gambar']; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-10">
          <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Paket Details of</span>
          <h1 class="mb-2"><?php echo $link['nama_paket']; ?></h1>
          <!-- <p class="mb-5"><strong class="h2 text-primary font-weight-bold">Rp.<?php echo number_format($link['price'], 2, ",", "."); ?></strong></p> -->
        </div>
      </div>
    </div>
  </div>
  <div class="site-section site-section-sm">
    <div class="container">
      <div class="row">
        <div class="col-lg-8" style="">
          <div class="mb-5">
            <div class="slide-one-item home-slider owl-carousel">
              <?php
              if (mysqli_num_rows($select) > 0) {
                while ($a = mysqli_fetch_assoc($select)) { ?>
                  <div><img src="images/paket/<?php echo $a['gambar']; ?>" alt="Image" class="img-fluid"></div>
              <?php  }
              } else {
                echo "<h1 class='text-white col-md-12 text-center'>Image Menu Not Available</h1>";
              }
              ?>
            </div>
          </div>
          <div class="bg-white">
            <div class="row mb-3">
              <div class="col-md-10">
                <strong class="text-primary h1 mb-3"><?php echo $link['nama_paket']; ?></strong>
              </div>
            </div>
            <h2 class="h4 text-black">More Info</h2>
            <p><?php echo $link['deskripsi']; ?></p>
          </div>
        </div>
        <div class="col-lg-4 pl-md-5">
          <div class="bg-white widget border rounded">
            <div align="center">
              <h3 class="h4 text-black widget-title">Reservation</h3>
              <hr style="border: 1px solid #5ea52b;">
              <a href="https://api.whatsapp.com/send?phone=6285376767940=Hallo%20Madhava%20Trip%20Nusa%20Penida"><img src="images/download.png" alt="" style="width:50px;"></a>&bullet;
              <a href="tel:+6285376767940"><img src="images/call.png" alt="" style="width:45px;"></a>&bullet;
              <a href="mailto:madhavatrip@yahoo.com"><img src="images/email.png" alt="" style="width:45px;"></a>
            </div>
          </div>
          <div class="bg-white widget border rounded">
            <div align="center">
              <h3 class="h4 text-black widget-title">Bagikan</h3>
              <hr style="border: 1px solid #5ea52b;">
              <div class="row">
                <div class="fb-share-button col-md-6" data-href="<?php echo $link['link']; ?>" data-layout="box_count" data-size="large">
                  <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Bagikan</a>
                </div>
                <div class="col-md-6">
                  <a href="<?php echo $link['link']; ?>" class="twitcount-button" data-count="vertical" data-size="large" data-text="" data-url="" data-via="" data-related="" data-hashtags="">TwitCount</a>
                  <script type="text/javascript" src="https://static1.twitcount.com/js/button.js"></script>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-white widget border rounded">
            <h3 class="h4 text-black widget-title ">Paket Tour Nusa Penida</h3>
            <hr style="border: 1px solid #5ea52b;">
            <div align="left">
              <?php
              $mysql = mysqli_query($conn, "SELECT * FROM tb_paket ORDER BY tanggal LIMIT 5");
              while ($row = mysqli_fetch_assoc($mysql)) { ?>
                <ul class="nav nav-tabs nav-stacked">
                  <li class="">
                    <a href="<?php echo $row['flag'] ?>.html"><?php echo $row['nama_paket'] ?></a>
                  </li>
                </ul>
              <?php }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <hr style="border: 1px solid #5ea52b;">
      <div align="center" class="row">
        <div class="col-12">
          <div class="site-section-title">
            <h2>Booking Paket</h2>
          </div>
        </div>
      </div>
      <hr style="border: 1px solid #5ea52b;">
      <form action="home" method="POST">
        <div class="row mb-3">
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <label for="nama">Masukan Nama</label>
              <input class="form-control" name="nama" placeholder="Enter Name" type="text">
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <label for="nama">Masukan Paket</label>
              <select name="offer-types" id="offer-types" class="dropdown form-control d-block rounded-0">
                <option value="">Enter Package</option>
                <?php
                $mysql = mysqli_query($conn, "SELECT * FROM tb_paket ORDER BY id_paket DESC");
                while ($rows = mysqli_fetch_assoc($mysql)) { ?>
                  <option value="<?php echo $rows['nama_paket'] ?>"><?php echo $rows['nama_paket'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <label for="nama">Masukan Alamat</label>
              <input class="form-control" name="alamat" placeholder="Enter Address" type="text">
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <label for="nama">Masukan No Telpon</label>
              <input class="form-control" name="telepon" placeholder="Enter Phone" maxlength="13" title="Ten digits code" type="tel">
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <label for="nama">Untuk Berapa Orang ?</label>
              <input class="form-control" name="jumlah" placeholder="For How Many People ?" min="1" type="number">
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <label for="nama">Tanggal Booking</label>
              <input class="form-control" name="tanggal" placeholder="For Date ?" type="date">
            </div>
          </div>
        </div>
        <div align="center">
          <div class="col-sm-6">
            <input type="submit" class="btn btn-outline-primary text-black form-control rounded-0" name="submit" value="Booking Paket">
          </div>
        </div>
      </form>
    </div>
  </div>
<?php else :
    $galery = mysqli_query($conn, "SELECT * FROM tb_paket ORDER BY id_paket DESC");
    $rows = mysqli_fetch_assoc($galery);
?>
  <title>Madhava Trip Nusa Penida | Paket Trip Nusa Penida</title>
  <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/paket/<?php echo $rows['gambar']; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-10">
          <h1 class="mb-2" id="myBtnContainer">Paket</h1>
          <div><a href="home">Home</a> <span class="mx-2 text-white">&bullet;</span> <strong class="text-white">Paket</strong><span class="mx-2 text-white"></span></div>
        </div>
      </div>
    </div>
  </div>
  <div class="site-section site-section-sm bg-light" id="menu">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12">
          <div class="site-section-title">
            <h2>Paket Tour Murah ke Nusa Penida</h2>
          </div>
        </div>
      </div>
      <div class="row mb-5">
        <?php
        $halaman = 6;
        $page = isset($_GET["paket-home-page"]) ? (int) $_GET["paket-home-page"] : 1;
        $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
        $result = mysqli_query($conn, "SELECT * FROM tb_paket");
        $total = mysqli_num_rows($result);
        $pages = ceil($total / $halaman);
        $query = mysqli_query($conn, "SELECT * FROM tb_paket LIMIT $mulai, $halaman") or die(mysqli_error);
        if (mysqli_num_rows($query) > 0) {
          while ($row = mysqli_fetch_assoc($query)) { ?>
            <div class="col-md-6 col-lg-4 mb-4">
              <a href="<?php echo $row['flag']; ?>.html" class="prop-entry d-block">
                <figure>
                  <img src="images/paket/<?php echo $row['gambar']; ?>" alt="Image" class="img-fluid">
                </figure>
                <div class="prop-text">
                  <div class="inner">
                    <h3 class="title price rounded"><?php echo $row['nama_paket']; ?></h3>
                    <br>
                    <p class="location">Br. Jepun, Batumulapan, Desa Batununggul, Kec. Nusa Penida, Kab. Klungkung</p>
                  </div>
                </div>
              </a>
            </div>
        <?php  }
        } else {
          echo "<h1 class='col-md-12 text-center'>Paket Not Available</h1>";
        }
        ?>
      </div>
      <div class="row mb-5">
        <div class="col-md-12 text-center">
          <div class="site-pagination">
            <?php for ($i = 1; $i <= $pages; $i++) { ?>
              <a href="paket?paket-home-page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
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