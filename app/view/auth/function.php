<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "kosong"){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda Belum Ter-isi Form Login.</p>
    <button type="button" class="btn-close" onclick="location.href = '../auth/index.php'" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
<?php
    }else if($_GET['info'] == "gagal"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Username dan Password anda salah.</p>
    <button type="button" class="btn-close" onclick="location.href = '../auth/index.php'" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
<?php        
    }
}
?>