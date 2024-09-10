<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pengaturan Aplikasi Perpustakaan</title>
        <?php 
            if($_SESSION['role'] == 'superadmin'){
                require_once("../ui/header.php");
                require_once("../../../../database/koneksi.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                die;
            }
        ?>
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
                        <a href="?page=settings" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title text-center fs-5
                 display-4 text-black-50"><?php echo $title ?></h4>
            </div>
            <div class="card-body mt-2">
                <div class="container">
                    <form action="?aksi=update-settings" method="post">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-7 col-md-8 bg-secondary">
                                <div class="card-body bg-secondary mt-2">
                                    <h4 class="card-header card-title text-center">Sistem Pengaturan</h4>
                                    <h4 class="card-header card-title
                                     text-center">Arsip Surat Berbasis Website</h4>
                                    <div class="mb-2 mt-2"></div>
                                    <div class="border border-top my-2"></div>
                                    <div class="mb-2 mt-2"></div>
                                    <?php 
                                        $sql = "SELECT * FROM jam_masuk WHERE id_jam = '1'";
                                        $data = $konfigs->query($sql);
                                        while($pro = $data->fetch_array()){
                                    ?>
                                    <div class="form-group mt-1">
                                        <input type="hidden" name="id_jam" value="<?php echo $pro['id_jam']?>" id="">
                                        <div class="form-inline row justify-content-center align-items-center mb-1">
                                            <div class="form-label col-sm 4 col-md-4">
                                                <label for="" class="label label-default display-4 
                                                    fs-5 text-light">Jam Pagi</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7 time-label">
                                                <input type="time" name="pagi" class="form-control time-formate"
                                                    required aria-required="TRUE" value="<?php echo $pro['pagi']?>"
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="form-inline row justify-content-center align-items-center mb-1">
                                            <div class="form-label col-sm 4 col-md-4">
                                                <label for="" class="label label-default display-4 
                                                    fs-5 text-light">Jam Siang</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7 time-label">
                                                <input type="time" name="siang" class="form-control time-formate"
                                                    required aria-required="TRUE" value="<?php echo $pro['siang']?>"
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="form-inline row justify-content-center align-items-center mb-1">
                                            <div class="form-label col-sm 4 col-md-4">
                                                <label for="" class="label label-default display-4 
                                                    fs-5 text-light">Jam Malam</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7 time-label">
                                                <input type="time" name="malam" class="form-control time-formate"
                                                    required aria-required="TRUE" value="<?php echo $pro['malam']?>"
                                                    id="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="mb-2 mt-2"></div>
                                    <div class="border border-top my-2"></div>
                                    <div class="mb-2 mt-2"></div>
                                    <?php 
                                        $sql2 = "SELECT * FROM sistem WHERE id_sistem = '1'";
                                        $data2 = $konfigs->query($sql2);
                                        while($isi = $data2->fetch_array()){
                                    ?>
                                    <div class="form-group mt-1">
                                        <input type="hidden" name="id_sistem" value="<?php echo $isi['id_sistem']?>">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm 4 col-md-4">
                                                <label for="" class="label label-default display-4 
                                                    fs-5 text-light">Nama Developer</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="text" name="developer"
                                                    value="<?php echo $isi['developer']?>" class="form-control" required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm 4 col-md-4">
                                                <label for="" class="label label-default display-4 
                                                    fs-5 text-light">Status Website</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <select name="status" required aria-required="TRUE" class="form-select"
                                                    id="">
                                                    <option value="">Pilih Status Website</option>
                                                    <option value="0" <?php if($isi['status'] == '0'){?> selected
                                                        <?php } ?>>Status Website Tidak Aktif</option>
                                                    <option value="1" <?php if($isi['status'] == '1'){?> selected
                                                        <?php } ?>>Status Website Aktif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-7 ms-auto me-4 text-light">
                                        <input type="checkbox" name="ubah" id=""> Klick ini jika anda setujui, untuk
                                        merubah sistem arsip surat website
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="card-footer bg-secondary container mt-2 mt-lg-2">
                                        <div class="text-center mt-5 mt-lg-5">
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
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>