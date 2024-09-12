<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <body onload="window.print();">
        <?php if(isset($_GET['id'])){ ?>
        <?php 
            $id = htmlspecialchars($_GET['id']);
            $data = mysqli_query($konfigs, "SELECT * FROM surat_masuk WHERE id = '$id'");
            while($isi = mysqli_fetch_array($data)){
        ?>
        <div class="card col-sm-9 col-md-9">
            <div class="card-header">
                <div class="border border-top border-dark mt-1 mb-1"></div>
                <div class="d-flex justify-content-center align-items-start flex-wrap">
                    <div class="card-img-top">
                        <img class='img-responsive' src='...' class="card-img card-img-overlay">
                    </div>
                    <?php echo $isi['pengirim'] ?>
                </div>
                <div class="text-end">
                    <?php echo date('d, M Y', timestamp:null); ?>
                </div>
                <div class="border border-bottom border-dark mt-1 mb-1"></div>
            </div>
            <div class="card-body">
                <div class="form-group mt-1 mt-lg-1">
                    <div class="form-inline row justify-content-center align-items-start flex-wrap">
                        <div class="ms-5 ms-lg-5">
                            <input type="text" name="" value="Yth Kepada, <?php echo $isi['penerima']?>." readonly
                                class="form-control border border-0 fs-5 fst-normal text-dark" id="">
                        </div>
                    </div>
                    <div class="form-inline row justify-content-center align-items-start flex-wrap">
                        <div class="form-label col-sm-4 col-md-4">
                            <label for="" class="label label-default fs-5 fst-normal text-dark">Nomor Surat</label>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <input type="text" name="" value="<?php echo $isi['nomor_surat']?>" readonly
                                class="form-control border border-0" id="">
                        </div>
                    </div>
                    <div class="form-inline row justify-content-center align-items-start flex-wrap">
                        <div class="form-label col-sm-4 col-md-4">
                            <label for="" class="label label-default fs-5 fst-normal text-dark">Lampiran</label>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <input type="text" name="" value="-" readonly class="form-control border border-0" id="">
                        </div>
                    </div>
                    <div class="form-inline row justify-content-center align-items-start flex-wrap">
                        <div class="form-label col-sm-4 col-md-4">
                            <label for="" class="label label-default fs-5 fst-normal text-dark">Perihal</label>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <input type="text" name="" value="<?php echo $isi['perihal']?>" readonly
                                class="form-control border border-0" id="">
                        </div>
                    </div>
                    <br>
                    <div class="form-inline row justify-content-center align-items-start flex-wrap">
                        <div class="form-label col-sm-4 col-md-4">
                            <label for="" class="label label-default fs-5 fst-normal text-dark">Keterangan</label>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <textarea class="fs-6 fst-normal fw-normal form-control border border-0" readonly
                                style="letter-spacing: 1px;
                                min-width: 150px; height: 300px; min-height: 100%;"><?php echo $isi['keterangan']?></textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <p class="col-sm-8 col-md-8 fs-6 fst-normal text-dark">
                        Salam dari <?php echo $isi['pengirim'] ?> untuk Bapak/Ibu <?php echo $isi['penerima'] ?>.
                    </p>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-end">
                    <p class="fs-6 fst-normal text-dark">
                        <?php echo ucfirst($isi['pengirim']) ?>
                        <br>
                    <div class="me-5 me-lg-5">
                        <br>
                        ....
                        <br>
                    </div>
                    <br>
                    <?php echo date('d, M Y', timestamp:null) ?>
                    </p>
                </div>
                <div class="border border-bottom border-dark mt-1 mb-1"></div>
            </div>
        </div>
        <?php
            }    
        ?>
        <?php } ?>
        <?php require_once("../ui/footer.php"); ?>