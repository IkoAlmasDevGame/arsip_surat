<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
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
                        <a href="?page=suratmasuk" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            <?php echo $title2 ?>
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=ubah-surat-masuk&id=<?php echo $_GET['id']?>" aria-current="page"
                            aria-label="Data Master" class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title fs-5 text-black-50 fw-semibold"><?php echo $title ?></h4>
            </div>
            <div class="card-body mt-2 mt-lg-2">
                <div class="container">
                    <div class="table-responsive">
                        <?php if(isset($_GET['id'])){ ?>
                        <?php 
                            $id = htmlspecialchars($_GET['id']);
                            $data = $konfigs->query("SELECT * FROM surat_masuk WHERE id = '$id'");
                            while($isi = mysqli_fetch_array($data)){
                        ?>
                        <form action="?aksi=ubah-suratmasuk" method="post">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="card col-sm-6 col-md-6">
                                    <div class="card-header text-center card-title shadow shadow-sm
                                     fst-normal fw-semibold text-black-50">
                                        Ubah Data Surat Masuk
                                    </div>
                                    <div class="card-body mt-1 mt-lg-1">
                                        <div class="form-group mt-lg-1 mt-1">
                                            <div class="form-inline row justify-content-center 
                                                align-items-start flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default fs-5 
                                                        fst-normal text-dark">Nomor Surat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="nomor_surat"
                                                        value="<?php echo $isi['nomor_surat']?>" readonly maxlength="32"
                                                        required aria-required="TRUE" class="form-control"
                                                        placeholder="masukkan nomor surat ..." id="">
                                                    <small>contoh nomor surat : 12.010/DP-KM/IX/2019</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-lg-1 mt-1">
                                            <div class="form-inline row justify-content-center 
                                                align-items-start flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default fs-5 
                                                        fst-normal text-dark">Tanggal Pengirim</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="date" name="tanggal" required aria-required="TRUE"
                                                        aria-readonly="TRUE" readonly class="form-control"
                                                        value="<?php echo $isi['tanggal']?>" id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-lg-1 mt-1">
                                            <div class="form-inline row justify-content-center 
                                                align-items-start flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default fs-5 
                                                        fst-normal text-dark">Pengirim Surat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="pengirim"
                                                        value="<?php echo $isi['pengirim']?>" maxlength="255" required
                                                        aria-required="TRUE" class="form-control"
                                                        placeholder="masukkan pengirim surat ..." id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-lg-1 mt-1">
                                            <div class="form-inline row justify-content-center 
                                                align-items-start flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default fs-5 
                                                        fst-normal text-dark">Penerima Surat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="penerima"
                                                        value="<?php echo $isi['penerima']?>" maxlength="255" required
                                                        aria-required="TRUE" class="form-control"
                                                        placeholder="masukkan penerima surat ..." id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-lg-1 mt-1">
                                            <div class="form-inline row justify-content-center 
                                                align-items-start flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default fs-5 
                                                        fst-normal text-dark">Perihal Surat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" name="perihal"
                                                        value="<?php echo $isi['perihal']?>" readonly maxlength="255"
                                                        required aria-required="TRUE" class="form-control"
                                                        placeholder="masukkan perihal surat ..." id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-lg-1 mt-1">
                                            <div class="form-inline row justify-content-center 
                                                align-items-start flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default fs-5 
                                                        fst-normal text-dark">Keterangan Surat</label>
                                                </div>
                                                <div class="col-sm-7 col-md-7">
                                                    <textarea name="keterangan"
                                                        placeholder="masukkan keterangan surat ..."
                                                        style="height: 200px; min-height: 100%;" maxlength="1000"
                                                        required aria-required="TRUE" class="form-control"
                                                        id=""><?php echo $isi['keterangan']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer container">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save fa-1x"></i>
                                                    <span>Update Surat</span>
                                                </button>
                                                <a href="?page=beranda" aria-current="page"
                                                    class="btn btn-dark btn-outline-light">Cancel</a>
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
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>