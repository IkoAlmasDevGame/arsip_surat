<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "absensi"){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda sudah berhasil absensi di hari ini ...</p>
    <button type="button" class="btn-close" onclick="location.href = '../ui/header.php?aksi=absensi-karyawan'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php        
    }
}
?>