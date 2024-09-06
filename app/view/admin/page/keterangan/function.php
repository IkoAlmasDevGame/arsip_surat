<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "berhasil"){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>anda sudah membuat laporan keterangan !</p>
    <button type="button" class="btn-close" onclick="location.href = '../ui/header.php?aksi=keterangan-karyawan'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }else if($_GET['info'] == "dialog"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>anda sudah membuat laporan keterangan sebelumnya !</p>
    <button type="button" class="btn-close" onclick="location.href = '../ui/header.php?aksi=keterangan-karyawan'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php        
    }else if($_GET['info'] == "gagal"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>maaf anda belum isi semua form surat keterangan !</p>
    <button type="button" class="btn-close" onclick="location.href = '../ui/header.php?aksi=keterangan-karyawan'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php        
    }
}
?>