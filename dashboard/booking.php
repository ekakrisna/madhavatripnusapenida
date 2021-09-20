<?php
include_once '../proses/connect.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
if (!isset($_SESSION['username'])) {
    header("Location:../dashboard/");
}
if (isset($_GET['option']) && isset($_GET['id'])) :
    if ($_GET['option'] == 'delete') {
        $flag = $_GET['id'];
        $checkUser = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE id_tour = '$flag'");
        if (mysqli_num_rows($checkUser) > 0) {
            $deleteUser = mysqli_query($conn, "DELETE FROM tb_transaksi WHERE id_tour ='$flag'");
            if ($deleteUser) {
                echo "<script type='text/javascript'>alert('Succes Delete Booking !!');window.location.href='../dashboard/booking';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Failed To Delete Booking !!');window.location.href='../dashboard/booking';</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Booking Not Available !!');window.location.href='../dashboard/booking';</script>";
        }
    }
endif;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Madhava Trip Nusa Penida | Dashboard - Booking</title>
    <link rel="icon" href="../favicon.png">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/menu.css">
    <style media="screen">
        html {
            scroll-behavior: smooth;
        }

        div.dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include 'navbar.php' ?>
        <div id="content">
            <br>
            <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            </div>
            <h3 class="center-card">Informasi Booking</h3>
            <?php
            // Get images from the database
            $query = mysqli_query($conn, "SELECT * FROM tb_transaksi ORDER BY id_tour DESC");
            ?>
            <div class="dataTables_wrapper">
                <table id="example" class="table table-striped display nowrap" style="width:100%">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Paket</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $row['nama_booking'] . "</td>";
                            echo "<td>" . $row['telpon_booking'] . "</td>";
                            echo "<td>" . $row['alamat_booking'] . "</td>";
                            echo "<td>" . $row['paket_booking'] . "</td>";
                            echo "<td>" . $row['jumlah_booking'] . "</td>";
                            echo "<td>" . $row['tanggal_booking'] . "</td>";
                            echo "<td><a href='#' class='open_modal' id='" . $row['id_tour'] . "'><i class='fas fa-eye'></i></a> | <a href='#' class='link-delete' data-id='$row[id_tour]'><i class='fas fa-trash'></i></a></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Table Gambar -->
        </div>
    </div>
</body>
<!-- Menu Icon  -->
<!-- Menu Icon  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
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
<script type="text/javascript">
    $(".link-delete").click(function() {
        var r = confirm("Are You Sure You Want To Delete?");
        var GetAttr = $(this).attr("data-id");
        if (r == true) {
            window.location = "booking.php?option=delete&id=" + GetAttr;
        } else {
            return false;
        }
    });
    $(document).ready(function() {
        $('#example').DataTable({
            "scrollY": 200,
            "scrollX": 100
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".open_modal").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "../proses/booking.php",
                type: "GET",
                data: {
                    flag: m,
                },
                success: function(ajaxData) {
                    console.log(ajaxData);
                    $("#ModalEdit").html(ajaxData);
                    $("#ModalEdit").modal('show', {
                        backdrop: 'true'
                    });
                }
            });
        });
    });
</script>

</html>