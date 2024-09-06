<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Absensi Karyawan</title>
        <?php 
            if($_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
                require_once("../../../../database/koneksi.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                die;
            }
        ?>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="panel container panel-default bg-body-secondary">
            <div class="panel-body">
                <h4 class="panel-heading panel-title">Absensi Karyawan</h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap mx-2">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=absensi-karyawan" aria-current="page"
                            class="text-decoration-none text-primary">Absensi Karyawan</a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title">Absensi Karyawan
                    <div class="text-end display-4 fs-5"><?php echo $_SESSION['nama'] ?></div>
                </h4>
                <a href="?aksi=absensi-karyawan" hidden aria-current="page" class="btn btn-info">
                    <i class="fa fa-refresh fa-1x"></i>
                    <span>Refresh Halaman</span>
                </a>
            </div>
            <div class="card-body mt-1">
                <?php require_once("../absensi/function.php") ?>
                <div class="container">
                    <div class="table-responsive">
                        <form action="?aksi=simpan-absensi" method="post">
                            <?php 
                                if(isset($_SESSION['nama']) && isset($_SESSION['role'])){
                                    $sql = "SELECT * FROM users WHERE nama = '$_SESSION[nama]' and role = '$_SESSION[role]'";
                                    $data = $konfigs->query($sql);
                                while($pro = mysqli_fetch_array($data)){
                            ?>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="card col-sm-7 col-md-8">
                                    <div class="card-body">
                                        <div class="card-header card-title border border-0">
                                            <div class="text-center display-4 fs-5">
                                                <?php echo ucfirst(ucwords($_SESSION['nama'])) ?>
                                            </div>
                                        </div>
                                        <div class="border border-top my-1 row-cols-3 row-cols-sm-3"></div>
                                        <div class="form-inline mt-1">
                                            <div class="form- row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default">Nama Karyawan</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <input type="text" name="nama" class="form-control" required
                                                        readonly aria-required="TRUE" value="<?php echo $pro['nama']?>"
                                                        id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline mt-1">
                                            <div class="form- row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default">Tanggal Absensi</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <input type="date" name="tanggal_input" class="form-control"
                                                        required readonly aria-required="TRUE"
                                                        value="<?php echo date('Y-m-d')?>" id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline mt-1">
                                            <div class="form- row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default">Jam Absensi</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <input type="text" name="jam" class="form-control" required readonly
                                                        aria-required="TRUE" value="<?php echo date('H:i:s')?>" id="">
                                                    <input type="hidden" name="jam2" class="form-control" required
                                                        readonly aria-required="TRUE" value="<?php echo date('H:i:s')?>"
                                                        id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer mt-1">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-fingerprint fa-1x"></i>
                                                    <span>Absensi Karyawan</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>