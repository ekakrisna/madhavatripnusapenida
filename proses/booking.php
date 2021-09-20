<?php
include "connect.php";
$flag = $_GET['flag'];
$modal = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE id_tour = '$flag'");
$r = mysqli_fetch_array($modal);
?>
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Lihat Booking</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="eventInsForm">
                <input class="form-control" type="text" readonly value="<?php echo $r['id_tour']; ?>">
                <label for="">Nama Booking</label>
                <input class="form-control" type="text" readonly value="<?php echo $r['nama_booking']; ?>">
                <label for="">Alamat Booking</label>
                <input class="form-control" type="text" readonly value="<?php echo $r['alamat_booking']; ?>">
                <label for="">Telpon Booking</label>
                <input class="form-control" type="text" readonly value="<?php echo $r['telpon_booking']; ?>">
                <label for="">Jumlah Booking</label>
                <input class="form-control" type="text" readonly value="<?php echo $r['jumlah_booking']; ?>">
                <label for="">Paket Booking</label>
                <input class="form-control" type="text" readonly value="<?php echo $r['paket_booking']; ?>">
                <label for="">Tanggal Booking (Tahun-Bulan-Tanggal)</label>
                <input class="form-control" type="text" readonly value="<?php echo $r['tanggal_booking']; ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="update" class="btn btn-primary" value="Save changes">
                <!-- <button type="button" name="submit" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>