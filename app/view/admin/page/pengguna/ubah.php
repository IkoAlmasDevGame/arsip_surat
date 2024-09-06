<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['role'] == "superadmin" || $_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda';</script>";
                die;
            }
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const password = document.getElementById('passwrd');
            const repassword = document.getElementById('repasswrd');
            const error = document.getElementById('error');
            const success = document.getElementById('success');

            function validatePasswords() {
                if (password.value === repassword.value &&
                    password.value !== '' && repassword.value !== '') {
                    success.style.display = 'block';
                    error.style.display = 'none';
                } else {
                    success.style.display = 'none';
                    if (password.value === '' || repassword.value === '') {
                        error.style.display = 'none';
                    } else {
                        error.style.display = 'block';
                    }
                }
            }
            // Menambahkan event listener untuk 'keyup' pada kedua input
            password.addEventListener('keyup', validatePasswords);
            repassword.addEventListener('keyup', validatePasswords);
            // Opsional: Validasi saat input kehilangan fokus
            password.addEventListener('blur', validatePasswords);
            repassword.addEventListener('blur', validatePasswords);
        });
        </script>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="panel panel-body container bg-body-tertiary">
            <div class="panel-heading">
                <h4 class="panel-title"><?php echo $title ?></h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=ubah-karyawan&id=<?php echo $_SESSION['id']?>" aria-current="page"
                            aria-label="Data Master" class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container">
            <div class="card-header">
                <?php require_once("../karyawan/function.php"); ?>
            </div>
            <div class="card-body mt-4">
                <div class="container">
                    <?php if(isset($_SESSION['id']) && isset($_SESSION['role'])){ ?>
                    <?php 
                        $id = $_SESSION['id'];
                        $data = $konfigs->query("SELECT * FROM users WHERE id_akun = '$id' and role = '$_SESSION[role]'");
                        while($isi = mysqli_fetch_array($data)){
                    ?>
                    <form action="?aksi=tambah-karyawan" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id_akun" value="<?php echo $id;?>">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="card col-sm-7 col-md-8">
                                <div class="card-body mt-1 bg-secondary">
                                    <div class="card-header card-title text-center text-light shadow-sm bg-secondary">
                                        <?php echo $title ?>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">User Name</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="text" name="username" maxlength="100"
                                                    value="<?php echo $isi['username']?>" class="form-control"
                                                    placeholder="masukkan username karyawan baru ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Nama Karyawan</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="text" name="nama" maxlength="80"
                                                    value="<?php echo $isi['nama']?>" class="form-control"
                                                    placeholder="masukkan nama karyawan ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">E - Mail</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="email" name="email" value="<?php echo $isi['email']?>"
                                                    maxlength="255" class="form-control"
                                                    placeholder="masukkan email karyawan baru ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Kata
                                                    Sandi</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="password" name="password" required aria-required="TRUE"
                                                    placeholder="masukkan kata sandi baru ..." maxlength="255"
                                                    class="form-control" id="passwrd">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                         align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Ulangi Kata
                                                    Sandi</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="password" name="password" required aria-required="TRUE"
                                                    placeholder="ulangi kata sandi baru ..." maxlength="255"
                                                    class="form-control" id="repasswrd">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-end flex-wrap me-4 me-lg-5">
                                            <p style="color: salmon; display: none;" id="error">
                                                Password dan Repassword anda tidak cocok</p>
                                            <p style="color: lightgreen; display: none;" id="success">
                                                Password dan Repassword anda cocok
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Jabatan Karyawan</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <select name="role" required aria-required="TRUE" aria-disabled="false"
                                                    class="form-select" id="">
                                                    <option value="">Pilih Jabatan Karyawan</option>
                                                    <?php if($isi['role'] == 'superadmin'){ ?>
                                                    <option <?php if($isi['role'] == $_SESSION['role']){?> selected
                                                        <?php } ?> value="superadmin">Superadmin</option>
                                                    <?php }else{ ?>
                                                    <option <?php if($isi['role'] == $_SESSION['role']){?> selected
                                                        <?php } ?> value="admin">Admin</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Photo</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <div class="form-icon img-thumbnail w-25">
                                                    <img <?php if($isi['foto']){ ?>
                                                        src="../../../../../assets/image/<?php echo $isi['foto']?>"
                                                        <?php }else{ ?>
                                                        src="../../../../assets/image/profile/user_logo.png" <?php } ?>
                                                        id="preview" alt="" width="64" class="img-rounded img-fluid">
                                                </div>
                                                <div class="form-control mt-1">
                                                    <input type="file" name="foto" accept="image/*" id="fileInput"
                                                        class="form-control-file" required onchange="this.fileInput"
                                                        aria-required="true">
                                                </div>
                                                <br>
                                                <input type="checkbox" name="ubahfoto" id=""> Klik jika ingin ubah
                                                foto
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-secondary container mt-1">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save fa-1x"></i>
                                                <span>Update data</span>
                                            </button>
                                            <a href="?page=beranda" aria-current="page"
                                                class="btn btn-outline-light">Cancel</a>
                                            <button type="reset" class="btn btn-danger">
                                                <i class="fa fa-eraser fa-1x"></i>
                                                <span>Hapus semua</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>