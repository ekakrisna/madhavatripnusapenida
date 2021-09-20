<?php
include "connect.php";
$flag = $_GET['flag'];
// var_dump($flag);
$modal = mysqli_query($conn, "SELECT * FROM tb_galery WHERE id_galery = '$flag'");
$r = mysqli_fetch_array($modal);
?>
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Edit Galery Gambar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="../dashboard/galeri.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            <div class="modal-body">
                <div class="eventInsForm">                    
                    <input class="form-control addresspicker" readonly type="hidden" name="id_galery" id="" value="<?php echo $r['id_galery']; ?>" required="true">                    
                </div>
                <label for="">Image</label>
                <div class="col-lg-12 ">
                    <input type="file" class="custom-file-input" name="files" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" multiple>
                    <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="update" class="btn btn-primary" value="Save changes">
                    <!-- <button type="button" name="submit" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </form>
    </div>
</div>