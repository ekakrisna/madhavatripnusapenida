  <footer class="site-footer">
      <div class="container">
          <div class="row">
              <div class="col-lg-3">
                  <!-- <div class=""> -->
                      <h3 class="footer-heading mb-4">Peta Kami</h3>
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.0719543221576!2d115.57110581434083!3d-8.684707693760158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd27474b402622d%3A0x58cb0f8cf68f453d!2sBr.%20Jepun%20Batumulapan%20Nusa%20Penida!5e0!3m2!1sen!2sid!4v1568727594049!5m2!1sen!2sid" width="230" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                  <!-- </div> -->
              </div>
              <div class="col-lg-3">
                  <div class="">
                      <h3 class="footer-heading mb-4">Kontak Kami</h3>
                      <p class="text-white">Handphone : <a href="tel:+6285376767940">+6285376767940</a><br />
                          Whatsapp : <a href="https://api.whatsapp.com/send?phone=6285376767940=Hallo%20Madhava%20Trip%20Nusa%20Penida">+6285376767940</a><br />
                          Email : <a href="mailto:kokix1986@gmail.com">kokix1986@gmail.com</a><br />
                          Facebook : <a href="https://www.facebook.com/kokix.ne">Kokix Ne</a><br />
                          Instagram : <a href="https://www.instagram.com/kokixne/">kokixne</a><br />
                          Alamat : Br. Jepun, Batumulapan, Desa Batununggul, Kec. Nusa Penida, Kab. Klungkung</p>
                      <p class="text-white"><strong>Rekening BANK</strong> <br>
                          BRI <br> 7706-01-001245-53-5 <br> Atas Nama : I Ketut Wirinata
                      </p>
                  </div>
              </div>
              <div class="col-lg-3">
                  <div class="row ">
                      <div class="col-md-12">
                          <h3 class="footer-heading mb-4">Tripadvisor</h3>
                          <p><img class="alignnone size-medium wp-image-76" src="images/tripadvisor.png" alt="" width="230" height="170" /></p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3">
                  <h3 class="footer-heading mb-4">Statistik Kunjungan</h3>
                  <?php
                    // To Get Total Online Visitors
                    $total_online_visitors = total_online();

                    // To Get Total Visitors
                    $total_visitors = mysqli_query($conn, "SELECT * FROM total_visitors");
                    $total_visitors = mysqli_num_rows($total_visitors);

                    // To Insert Page View And Select Total Pageview
                    $user_ip = $_SERVER['REMOTE_ADDR'];
                    $page = $_SERVER['PHP_SELF'];
                    mysqli_query($conn, "insert into pageviews values('','$page','$user_ip')");
                    $pageviews = mysqli_query($conn, "SELECT * FROM pageviews");
                    $total_pageviews = mysqli_num_rows($pageviews);

                    //To Get Total Articles
                    $articles = mysqli_query($conn, "SELECT * FROM tb_paket");
                    $total_articles = mysqli_num_rows($articles);
                    ?>
                  <p class="text-justify text-white">Total Visitors : <span class="text-justify text-white"><?php echo $total_visitors; ?></span></p>
                  <p class="text-justify text-white">Visitors Online : <span class="text-justify text-white" id="online_visior_val"><?php echo $total_online_visitors; ?></span></p>
                  <p class="text-justify text-white">Total Pageviews : <span class="text-justify text-white"><?php echo $total_pageviews; ?></span></p>
                  <p class="text-justify text-white">Total Articles : <span class="text-justify text-white"><?php echo $total_articles; ?></span></p>
              </div>
          </div>
      </div>
      <div class="row text-center">
          <div class="col-md-12">
              <p>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  Copyright &copy;</script>
                  <script>
                      document.write(new Date().getFullYear());
                  </script> All rights reserved | Managed <i class="icon-heart text-danger" aria-hidden="true"></i> By <a href="#" target="_blank">Pigura Sari</a>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
          </div>
      </div>
  </footer>