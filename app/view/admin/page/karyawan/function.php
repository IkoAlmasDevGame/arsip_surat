<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "berhasil"){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>anda berhasil menambahkan karyawan baru ...</p>
    <button type="button" class="btn-close" onclick="location.href = '../ui/header.php?aksi=daftar-karyawan'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }else if($_GET['info'] == "ubahdata"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>anda berhasil mengubah data pribadi ...</p>
    <button type="button" class="btn-close"
        onclick="location.href = '../ui/header.php?aksi=ubah-karyawan&id=<?php echo $_SESSION['id']?>'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php        
    }else if($_GET['info'] == "gagal"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>anda gagal menambahkan karyawan baru ...</p>
    <button type="button" class="btn-close" onclick="location.href = '../ui/header.php?aksi=daftar-karyawan'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php        
    }
}
?>