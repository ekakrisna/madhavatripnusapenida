<?php
include_once '../proses/connect.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
if (!isset($_SESSION['username'])) {
    header("Location:../dashboard/");
}

if (isset($_POST['update'])) {
    $id_image = mysqli_escape_string($conn, $_POST['id_galery']);
    $ekstensi_diperbolehkan    = array('png', 'jpg');
    $nama = uniqid('uploaded-', true) . '.' . strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION));
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran    = $_FILES['files']['size'];
    $file_tmp = $_FILES['files']['tmp_name'];
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if (move_uploaded_file($file_tmp, '../images/galery/' . $nama) || $ukuran < 844070) {
            $query = "SELECT * FROM tb_galery WHERE id_galery = '$id_image'";
            $sql = mysqli_query($conn, $query);
            $data = mysqli_fetch_array($sql);
            // var_dump($data);
            if (is_file("../images/galery/" . $data['nama_galery'])) {
                unlink("../images/galery/" . $data['nama_galery']);
            }
            $inserting_data = mysqli_query($conn, "UPDATE tb_galery SET nama_galery = '$nama' WHERE id_galery ='$id_image'");
            if ($inserting_data) {
                // echo "Sukses";
                echo "<script type='text/javascript'>alert('Update Data Succes');window.location.href='../dashboard/galeri';</script>";
            } else {
                // echo "Gagal";
                echo "<script type='text/javascript'>alert('Update Data Failed');window.location.href='../dashboard/galeri';</script>";
            }
        } else {
            // echo "Kurang";
            echo "<script type='text/javascript'>alert('Update Data Failed');window.location.href='../dashboard/galeri';</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Update Image failed');window.location.href='../dashboard/galeri';</script>";
    }
}

if (isset($_POST['submit'])) {
    $targetDir = "../images/galery/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if (!empty(array_filter($_FILES['files']['name']))) {
        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path
            // $fileName = basename($_FILES['files']['name'][$key]);
            $fileName = uniqid('uploaded-', true) . '.' . strtolower(pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION));
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    $insertValuesSQL .= "('" . $fileName . "'),";
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ', ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ', ';
            }
        }
        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            $insert = mysqli_query($conn, "INSERT INTO tb_galery (nama_galery) VALUES $insertValuesSQL");
            if ($insert) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . $errorUpload : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . $errorUploadType : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                echo "<script type='text/javascript'>alert('Succes Upload Images !!');window.location.href='../dashboard/galeri';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Failed To Upload Images');window.location.href='../dashboard/galeri';</script>";
            }
        }
    } else {
        echo "<script type='text/javascript'>alert('Please Select Images !!!');window.location.href='../dashboard/galeri';</script>";
    }
    echo $statusMsg;
}

if (isset($_GET['option']) && isset($_GET['id'])) :
    if ($_GET['option'] == 'delete') {
        $flag = $_GET['id'];
        $checkUser = mysqli_query($conn, "SELECT * FROM tb_galery WHERE id_galery = '$flag'");
        if (mysqli_num_rows($checkUser) > 0) {
            $row = mysqli_fetch_assoc($checkUser);
            $image = $row['nama_galery'];
            unlink('../images/galery/' . $row['nama_galery']);
            $deleteUser = mysqli_query($conn, "DELETE FROM tb_galery WHERE id_galery ='$flag'");
            if ($deleteUser) {
                echo "<script type='text/javascript'>alert('Succes Delete Wisata !!');window.location.href='../dashboard/galeri';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Failed To Delete Wisata !!');window.location.href='../dashboard/galeri';</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Image Wisata Not Available !!');window.location.href='../dashboard/galeri';</script>";
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
    <title>Madhava Trip Nusa Penida | Dashboard - Galeri</title>
    <link rel="icon" href="../favicon.png">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/menu.css">
    <style media="screen">
        html {
            scroll-behavior: smooth;
        }

        div.dataTables_wrapper {
            width: 100%;
            /* margin: 0 80%; */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include 'navbar.php';?>
        <div id="content">
            <!-- Modal -->
            <form class="needs-validation" action="galeri" method="post" enctype="multipart/form-data">
                <div class="modal hide fade" data-backdrop="static" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add Image Galeri</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="">Image</label>
                                <div class="col-lg-12 ">
                                    <input type="file" class="custom-file-input" name="files[]" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" multiple>
                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" name="submit" class="btn btn-primary" value="Simpan Gambar">
                                <!-- <button type="button" name="submit" class="btn btn-primary">Save</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            </div>
            <!-- Button trigger modal -->
            <!-- Table Gambar -->
            <h3 class="center-card">Informasi Galeri</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                Tambah Gambar Galeri
            </button>
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1">
                Add Category
            </button> -->
            <?php
            // Get images from the database
            $query = mysqli_query($conn, "SELECT * FROM tb_galery ORDER BY id_galery DESC");
            ?>
            <div class="dataTables_wrapper my-4">
                <table id="example" class="table table-striped display nowrap" style="width:100%">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>No</th>
                            <th>Image</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr><td>" . $i++ . "</td>";
                            echo "<td><a href='#' class='pop'><img style=" . 'border-radius:8px;' . " src='../images/galery/" . $row['nama_galery'] . "' width='100' height='100'></a></td>";
                            echo "<td><a href='#' class='open_modal' id='" . $row['id_galery'] . "'><i class='fas fa-edit'></i></a> | <a href='#' class='link-delete' data-id='$row[id_galery]'><i class='fas fa-trash'></i></a></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <img src="" class="imagepreview" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table Gambar -->
        </div>
    </div>
</body>
<!-- Menu Icon  -->
<!-- Menu Icon  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
    $(".link-delete").click(function() {
        var r = confirm("Are You Sure You Want To Delete?");
        var GetAttr = $(this).attr("data-id");
        if (r == true) {
            window.location = "galeri.php?option=delete&id=" + GetAttr;
        } else {
            return false;
        }
    });
    // $(document).ready(function() {
    //     $('#example').DataTable({
    //         "scrollX": true
    //     });
    //     $('.dataTables_length').addClass('bs-select');
    // });
    $(document).ready(function() {
        $('#example').DataTable({
            "scrollY": 200,
            "scrollX": 100
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('.pop').on('click', function() {
            $('.imagepreview').attr('src', $(this).find('img').attr('src'));
            $('#imagemodal').modal('show');
        });
    });
</script>
<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
    $(document).ready(function() {
        $(".open_modal").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "../proses/galery.php",
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