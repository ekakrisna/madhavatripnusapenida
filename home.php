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
require_once 'proses/connect.php';
if (isset($_POST['submit'])) {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $offers = mysqli_real_escape_string($conn, $_POST['offer-types']);
  $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
  $telpon = mysqli_real_escape_string($conn, $_POST['telepon']);
  $jumlah = mysqli_real_escape_string($conn, $_POST['jumlah']);
  $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
  if (!$nama || !$offers || !$alamat || !$telpon || !$jumlah || !$tanggal) {
    echo "<script type='text/javascript'>alert('Data Masih Kosong');</script>";
  } else {
    $insert = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES ('','$nama','$telpon','$alamat','$offers','$jumlah','$tanggal')");
    // $query = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES('', '$nama','$telpon','$alamat','$offers','$jumlah','$tanggal')");
    // var_dump($insert, $nama, $offers, $alamat, $telpon, $jumlah, $tanggal);
    // die();
    if ($insert) {
      echo "<script type='text/javascript'>alert('Terima Kasih Sudah Booking Di Madhava Trip Nusa Penida');</script>";
    } else {
      echo "<script type='text/javascript'>alert('Data Belum Di Simpan');</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Madhava Trip Nusa Penida | Paket Wisata dan Snorkeling Nusa Penida</title>
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
  require_once 'search.php';
  require_once 'navbar.php';
  $selectimg = mysqli_query($conn, "SELECT * FROM tb_galery ORDER BY id_galery DESC LIMIT 6 ");
  $slide = '';
  while ($row = mysqli_fetch_assoc($selectimg)) {
    $slide .= "<div class='site-blocks-cover' style='background-image: url(images/galery/" . $row['nama_galery'] . ");' data-aos='fade' data-stellar-background-ratio='0.5'></div>  ";
  }
  ?>
  <div class="slide-one-item content home-slider owl-carousel">
    <?php echo $slide; ?>
  </div>
  <div class="site-section site-section-sm bg-light">
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
  <div class="py-5">
    <div class="container">
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
        <div align="center" class="col-sm-12">
          <input type="submit" class="btn btn-outline-primary text-black form-control rounded-0" name="submit" value="Booking Paket">
        </div>
      </form>
    </div>
  </div>
  <div class="site-section site-section-sm bg-green">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <p class="text-white text-justify"> Nusa Penida terdapat banyak perbukitan dan tebing, sehingga pulau ini menjadi tempat tujuan wisata yang unik dan berbeda dari biasanya. Bagi Anda yang berlibur di Bali namun ingin merasakan suasanya yang berbeda, maka Anda dapat mengunjungi Pulau Nusa Penida. Bukan hanya perbukitan, di Nusa Penida juga terdapat pantai yang indah dengan air laut berwarna biru dengan dikelilingi tebing dan batu karang yang membuat Pantai di Nusa Penida menjadi pantai yang ingin dikunjungi oleh banyak wisatawan. <br> <br>
            Kami <a href="madhavatripnusapenida.com" class="text-white">madhavatripnusapenida.com</a> merupakan agent tour dan travel murah di Nusa Penida. Kami melayani paket wisata nusa penida bali, paket snorkeling di nusa penida, paket travel ke nusa penida, paket tour murah ke nusa penida, dan paket liburan nusa penida. Adapun paket tour yang kami tawakan seperti
            <a href="paket-halfday.html" class="text-white">Paket Halfday (1 Hari Balik)</a>,
            <a href="paket-half-day-dan-snorkling.html" class="text-white">Paket Half Day dan Snorkeling</a>,
            <a href="paket-1-hari-1-malam.html" class="text-white">Paket 1 Hari 1 Malam (1D1N)</a>,
            <a href="paket-1-hari-1-malam-dan-snorkling.html" class="text-white">Paket 1 Hari 1 Malam dan Snorkeling</a>,
            <a href="paket-2-hari-1-malam-2d1n.html" class="text-white">Paket 2 Hari 1 Malam (2D1N)</a>,
            <a href="paket-2-hari-1-malam-snorkling.html" class="text-white">Paket 2 Hari 1 Malam dan Snorkeling</a>, dan juga melayani pemesanan ticket fast boat ke Nusa Penida.
            Untuk paket tour ke nusa penida sudah dilengkapi ticket boat dari Sanur sampai ke Nusa Penida. Dan untuk paket selain half day tour , kami sudah menyiapakan beberapa hotel pilihan yang terbaik di Nusa penida.
            <br> <br> Percayakan kegiatan trip Anda selama di Nusa Penida kepada kami <a href="madhavatripnusapenida.com" class="text-white">madhavatripnusapenida.com</a>, karena guide dan driver kami sudah berpengalaman dan tahu seluk beluk wisata di daerah Nusa penida.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- <hr style="border: 1px solid #5ea52b;"> -->
  <div class="site-section site-section-sm bg-light">
    <div class="container">
      <div align="center" class="row mb-5">
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
          echo "<h1 class='col-md-12 text-center'>Paket Tidak Tersedia</h1>";
        }
        ?>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="site-pagination">
            <?php for ($i = 1; $i <= $pages; $i++) { ?>
              <a href="home?paket-home-page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr style="border: 1px solid #5ea52b;">
  <div align="center">
    <div class="row">
      <div class="col-12">
        <div class="site-section-title">
          <h2>Instagram</h2>
          <a href="https://www.instagram.com/madhavatrip/">
            <h4>@kokixne</h4>
          </a>
          <hr style="border: 1px solid #5ea52b;">
        </div>
      </div>
    </div>
    <div class="text-primary text-center mb-3">
      <!-- <div class="row"> -->
      <?php
      $access_token = "IGQVJWeTlkWExDWHN1Y3c0YnFvSHk2VnRnSm1rR2lKVFNGMVdlOGc1ODhaeGticl96ay1jcmhMWXBHSFFvUTRlMGhXMm4tSFAySXhQSU5qMnB0MndfWjR1RTBBT2daSndlTEo1TmZAxOElfUjlEYWxxOQZDZD";
      $photo_count = 9;
      $json_link = "https://graph.instagram.com/me/media?fields=id,caption,media_url,media_type,permalink&";
      $json_link .= "access_token={$access_token}&count={$photo_count}";
      $json = file_get_contents($json_link);
      // var_dump($json);
      $obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
      $json = file_get_contents($json_link);
      $obj = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $json), true);
      // var_dump($obj);
      foreach ($obj['data'] as $post) {
        // var_dump($post);
        $pic_text = $post['caption'];
        $pic_link = $post['permalink'];
        // $pic_like_count = $post['likes']['count'];
        // $pic_comment_count = $post['comments']['count'];
        $pic_src = str_replace("http://", "https://", $post['media_url']);
        // $pic_created_time = date("F j, Y", $post['caption']['created_time']);
        // $pic_created_time = date("F j, Y", strtotime($pic_created_time . " +1 days"));
        // echo "<div class='row col-md-12' style='color:#888;'>";
        if (@is_array(getimagesize($pic_src))) {
          $image = true;
        } else {
          $image = false;
        }
        if ($image == 'true') {
          echo "<a href='{$pic_link}' target='_blank'>";
          echo "<img class='img-responsive col-md-2 photo-thumb' src='{$pic_src}' alt='{$pic_text}'>";
          echo "</a>";
        } else {
          echo "<video class='img-responsive col-md-2 photo-thumb' controls autoplay>";
          echo "<source src='{$pic_src}' type='video/mp4'>";
          echo "</video>";
        }

        // echo "<p>";
        // echo "<p>";
        // echo "</div>";
        // echo "<div style='color:#888;'>";
        // echo "<a href='{$pic_link}' target='_blank'>{$pic_created_time}</a>";
        // echo "</div>";
        // echo "</p>";
        // echo "<p>{$pic_text}</p>";
        // echo "</p>";
      }
      ?>
      <!-- </div> -->
    </div>
  </div>
  <!-- <hr style="border: 1px solid #5ea52b;"> -->
  <div class="site-section site-section-sm bg-primary">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="text-white">Nikmati Liburan Anda Bersama Kami</h2>
          <p class="text-white">Terdapat banyak pilihan paket tour menarik yang di tawakan seperti
            <a href="paket-halfday.html" class="text-white">Paket Halfday (1 Hari Balik)</a>,
            <a href="paket-half-day-dan-snorkling.html" class="text-white">Paket Half Day dan Snorkeling</a>,
            <a href="paket-1-hari-1-malam.html" class="text-white">Paket 1 Hari 1 Malam (1D1N)</a>,
            <a href="paket-1-hari-1-malam-dan-snorkling.html" class="text-white">Paket 1 Hari 1 Malam dan Snorkeling</a>,
            <a href="paket-2-hari-1-malam-2d1n.html" class="text-white">Paket 2 Hari 1 Malam (2D1N)</a>,
            <a href="paket-2-hari-1-malam-snorkling.html" class="text-white">Paket 2 Hari 1 Malam dan Snorkeling</a>, dan juga melayani pemesanan ticket fast boat ke Nusa Penida.
          </p>
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