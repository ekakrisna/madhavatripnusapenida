  <!-- <div class="site-wrap"> -->
  <link rel="icon" type="images/png" href="images/favicon.png">
  <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
              <span class="icon-close2 js-menu-toggle"></span>
          </div>
      </div>
      <div class="site-mobile-menu-body"></div>
  </div> <!-- .site-mobile-menu -->
  <div class="border-bottom bg-white top-bar">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-8 col-md-8">
                  <p class="mb-0">
                      <a href="tel:+6285376767940"> <span class="text-black fl-bigmug-line-phone351"> </span>+6285376767940</span></a> &bullet;
                      <a href="mailto:kokix1986@gmail.com" class="mr-3"><span class="text-black fl-bigmug-line-email64 ml-2"></span> <span>kokix1986@gmail.com</span></a>
                  </p>
              </div>
              <div class="col-4 col-md-4 text-right">
                  <a href="https://www.facebook.com/kokix.ne" class="mr-3"><span class="text-black icon-facebook"></span></a>
                  <a href="https://www.instagram.com/kokixne" class="mr-0"><span class="text-black icon-instagram"></span></a>
              </div>
          </div>
      </div>
  </div>
  <div class="site-navbar">
      <div class="container py-1">
          <div class="row align-items-center">
              <div class="col-8 col-md-8 col-lg-4">
                  <h1 class=""><a href="home" class="h5 text-uppercase text-black"><img src="images/logo.png" width="100" height="100" alt=""></a></h1>
              </div>
              <div class="col-4 col-md-4 col-lg-8">
                  <nav class="site-navigation text-right text-md-right" role="navigation">
                      <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
                          <a href="#" class="site-menu-toggle js-menu-toggle text-black">
                              <span class="icon-menu h3"></span>
                          </a>
                      </div>
                      <ul class="site-menu js-clone-nav d-none d-lg-block">
                          <li class="">
                              <a href="home">Home</a>
                          </li>
                          <li class="">
                              <a href="tentang-nusa-penida">Tentang Nusa Penida</a>
                          </li>
                          <li class="has-children">
                              <a href="paket">Paket Tour Nusa Penida</a>
                              <ul class="dropdown">
                                  <?php
                                    include 'proses/connect.php';
                                    $select = mysqli_query($conn, "SELECT * FROM tb_paket ORDER BY id_paket DESC");
                                    while ($row = mysqli_fetch_assoc($select)) {
                                        echo "<li><a href='" . $row['flag'] . ".html' class='dropdown-item'>" . wordwrap($row['nama_paket'], 20, "<br />\n") . "</a></li>";
                                    }
                                    ?>
                              </ul>
                          </li>
                          <li><a href="galeri">Galeri</a></li>
                          <li><a href="kontak-kami">Kontak Kami</a></li>
                          <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><span class="text-dark icon-search"></span></a></li>
                      </ul>
                  </nav>
              </div>
          </div>
      </div>
  </div>
  <!-- </div> -->