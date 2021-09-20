<nav id="sidebar">
  <ul class="list-unstyled components">
    <!-- <li>
      <a href="admin">Admin</a>
    </li> -->
    <!-- <li>
      <a href="#pageSubpromo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">News</a>
      <ul class="collapse list-unstyled" id="pageSubpromo">
        <li>
          <a href="news">List News</a>
        </li>
        <li>
          <a href="images">News Image Galeri</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#pageSubshop" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Wisata</a>
      <ul class="collapse list-unstyled" id="pageSubshop">
        <li>
          <a href="wisata">List Wisata</a>
        </li>
        <li>
          <a href="image">Wisata Image Galeri</a>
        </li>
      </ul>
    </li> -->
    <li>
      <a href="admin">Admin</a>
    </li>
    <li>
      <a href="galeri">Galeri</a>
    </li>
    <li>
      <a href="booking">Booking</a>
    </li>
  </ul>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <button type="button" id="sidebarCollapse" class="btn btn-dark">
      <i class="fas fa-align-left"></i>
      <span>Dashboard</span>
    </button>
    <button class="btn btn-info d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-align-justify"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav ml-auto text-white">
        <?php if (isset($_SESSION['username'])) { ?>
          <li><a href="../proses/logout">Logout</a></li>
        <?php } else { ?>
          <li><a href="index.php">Login</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>