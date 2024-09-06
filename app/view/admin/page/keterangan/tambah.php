<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Keterangan Karyawan</title>
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
                <h4 class="panel-heading panel-title">Keterangan Karyawan</h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap mx-2">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=keterangan-karyawan" aria-current="page"
                            class="text-decoration-none text-primary">Keterangan Karyawan</a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container">
            <div class="card-header py-2">
                <h4 class="card-title">
                    <div class="fs-5 display-3">Keterangan Karyawan</div>
                    <div class="text-end display-4 fs-5">
                        <?php echo $_SESSION['nama'] ?>
                    </div>
                </h4>
            </div>
            <div class="card-body mt-1">
                <div class="container">
                    <div class="table-responsive">
                        <form action="?aksi=simpan-keterangan" enctype="multipart/form-data" method="post">
                            <?php 
                                if(isset($_SESSION['nama']) && isset($_SESSION['role'])){
                                    $sql = "SELECT * FROM users WHERE nama = '$_SESSION[nama]' and role = '$_SESSION[role]'";
                                    $data = $konfigs->query($sql);
                                while($pro = mysqli_fetch_array($data)){
                            ?>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="card col-sm-7 col-md-8">
                                    <div class="card-body">
                                        <div class="card-header card-title border-0">
                                            <div class="text-center">Keterangan
                                                - <?php echo $_SESSION['nama'] ?> - Karyawan
                                            </div>
                                        </div>
                                        <div class="border border-top my-1 row-cols-3 row-cols-sm-3"></div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default">Nama Karyawan</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <input type="text" name="nama" required aria-required="TRUE"
                                                        readonly id="" value="<?php echo $pro['nama']?>"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default">Keterangan
                                                        Karyawan</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <input type="radio" name="keterangan" value="izin"
                                                        class="radio radio-inline me-3" id="" required
                                                        aria-required="TRUE">Izin
                                                    <input type="radio" name="keterangan" value="sakit"
                                                        class="radio radio-inline me-3 ms-3" id="" required
                                                        aria-required="TRUE">Sakit
                                                    <input type="radio" name="keterangan" value="cuti"
                                                        class="radio radio-inline me-3 ms-3" id="" required
                                                        aria-required="TRUE">Cuti
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default">Alasan Keterangan</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <textarea name="alasan" maxlength="255" required
                                                        class="form-control" aria-required="TRUE"
                                                        placeholder="masukkan alasan keterangan yang logis ..."
                                                        id=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default">Tanggal Keterangan</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <input type="date" name="tanggal" required class="form-control"
                                                        aria-required="TRUE" aria-readonly="TRUE" readonly id=""
                                                        value="<?php echo date('Y-m-d')?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default">Jam Keterangan</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <input type="text" name="jam" required class="form-control"
                                                        aria-required="TRUE" aria-readonly="TRUE" readonly id=""
                                                        value="<?php echo date('H:i:s') ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default">Foto Keterangan</label>
                                                </div>
                                                <div class="col-sm-6 col-md-7">
                                                    <div class="form-icon">
                                                        <img src="https://th.bing.com/th/id/OIP.Ken-Ns27rvoun1mbm-CSJwHaHa?w=130&h=180&c=7&r=0&o=5&pid=1.7"
                                                            id="preview" alt="" width="64"
                                                            class="img-rounded img-fluid">
                                                        <br>
                                                        <input type="file" name="foto" accept="image/*"
                                                            class="form-control form-control-file mb-1 mb-lg-1 mt-2 mt-lg-2"
                                                            required onchange="previewImage(this)" aria-required="true">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="fa fa-save fa-1x"></i>
                                                    <span class="text">Simpan Keterangan</span>
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