<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['role'] == "pengguna"){
                require_once("../ui/header.php");
                require_once("../../../database/koneksi.php");
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
                <h4 class="panel-title"><i class="fa fa-envelope-open fa-1x text-danger shadow shadow-sm"></i>
                    <?php echo $title ?></h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=suratkeluar" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container mb-3">
            <div class="card-header py-3">
                <h4 class="card-title fs-5 display-4 fst-normal text-dark fw-medium">
                    Surat Keluar - <?php echo $_SESSION['nama'] ?> -
                </h4>
            </div>
            <div class="card-body mt-2">
                <div class="container">
                    <div class="table-responsive">
                        <form action="" method="post">
                            <select name="length" id="example1_length" aria-controls="example2_length" required>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <input type="search" name="cari" aria-controls="example2_filter" id="example1_filter"
                                required>
                        </form>
                        <div class="d-table">
                            <table class="table-layout" id="example1">
                                <thead>
                                    <th class="table-layout-2 text-center">No.</th>
                                    <th class="table-layout-2 text-center">Nomor Surat</th>
                                    <th class="table-layout-2 text-center">Tanggal Surat</th>
                                    <th class="table-layout-2 text-center">Penerima Surat</th>
                                    <th class="table-layout-2 text-center">Jenis Surat</th>
                                    <th class="table-layout-2 text-center">Keterangan</th>
                                    <th class="table-layout-2 text-center">Status</th>
                                    <th class="table-layout-2 text-center">Arsip Surat</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $sql = "SELECT * FROM surat_keluar WHERE penerima = '$_SESSION[nama]' and jenis_surat = 'keluar'";
                                        $data = $konfigs->query($sql);
                                        while($isi = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $no; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['nomor_surat'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['tanggal'] ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php echo $isi['penerima']; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['jenis_surat'] ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php if($isi['status'] == "belum_dibaca"){ ?>
                                            <div class="fs-6 fst-normal fw-normal">Tidak Ada File</div>
                                            <?php }else{ ?>
                                            <button type="button" class="btn btn-light btn-outline-secondary"
                                                data-bs-target="#exampleKeterangan<?php echo $isi['id']?>"
                                                data-bs-toggle="modal" aria-current="page">
                                                <i class="fa fa-file fa-1x text-dark"></i>
                                            </button>
                                            <?php } ?>
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <?php if($isi['status'] == "belum_dibaca"){ echo "belum dibaca"; } else { echo "sudah dibaca"; } ?>
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <?php if($isi['status'] == "sudah_dibaca"){ ?>
                                            <form action="?aksi=arsip-keluar" method="post">
                                                <input type="hidden" name="nomor_surat"
                                                    value="<?php echo $isi['nomor_surat']?>">
                                                <input type="hidden" name="tanggal"
                                                    value="<?php echo $isi['tanggal'] ?>">
                                                <input type="hidden" name="pengirim"
                                                    value="<?php echo $isi['pengirim']; ?>">
                                                <input type="hidden" name="penerima"
                                                    value="<?php echo $isi['penerima']; ?>">
                                                <input type="hidden" name="jenis_surat"
                                                    value="<?php echo $isi['jenis_surat'] ?>">
                                                <input type="hidden" name="perihal"
                                                    value="<?php echo $isi['perihal'] ?>">
                                                <input type="hidden" name="keterangan"
                                                    value="<?php echo $isi['keterangan'] ?>">
                                                <button type="submit" class="btn btn-dark btn-outline-secondary"
                                                    onclick="return confirm('Apakah anda ingin mengarsip surat masuk ini ?')">
                                                    <i class="fa fa-file fa-1x"></i>
                                                </button>
                                            </form>
                                            <?php }else{ ?>
                                            <div class="fs-6 fst-normal fw-normal">Tidak Ada File</div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <!--  -->
                                    <div class="modal fade" tabindex="-1" aria-hidden="false" aria-expanded="false"
                                        id="exampleKeterangan<?php echo $isi['id']?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Keterangan Surat</h4>
                                                    <button type='button' class='btn btn-close'
                                                        data-bs-dismiss='modal'></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group mt-1 mt-lg-1">
                                                        <div class="form-inline row justify-content-center 
                                                            align-items-start flex-wrap">
                                                            <div class="ms-5 ms-lg-5">
                                                                <input type="text" name=""
                                                                    value="Yth Kepada, <?php echo $isi['penerima']?>."
                                                                    readonly class="form-control border border-0 fs-5
                                                                     fst-normal text-dark" id="">
                                                            </div>
                                                        </div>
                                                        <div class="form-inline row justify-content-center 
                                                            align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4">
                                                                <label for="" class="label label-default fs-5
                                                                fst-normal text-dark">Nomor Surat</label>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <input type="text" name=""
                                                                    value="<?php echo $isi['nomor_surat']?>" readonly
                                                                    class="form-control border border-0" id="">
                                                            </div>
                                                        </div>
                                                        <div class="form-inline row justify-content-center 
                                                            align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4">
                                                                <label for="" class="label label-default fs-5
                                                                fst-normal text-dark">Lampiran</label>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <input type="text" name="" value="-" readonly
                                                                    class="form-control border border-0" id="">
                                                            </div>
                                                        </div>
                                                        <div class="form-inline row justify-content-center 
                                                            align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4">
                                                                <label for="" class="label label-default fs-5
                                                                fst-normal text-dark">Perihal</label>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <input type="text" name=""
                                                                    value="<?php echo $isi['perihal']?>" readonly
                                                                    class="form-control border border-0" id="">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-inline row justify-content-center 
                                                            align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4">
                                                                <label for="" class="label label-default fs-5
                                                                fst-normal text-dark">Keterangan</label>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <textarea class="fs-6 fst-normal fw-normal form-control"
                                                                    readonly
                                                                    style="letter-spacing: 1px;
                                                                    min-width: 100%; 
                                                                    height: 200px; 
                                                                    min-height: 100%;"><?php echo $isi['keterangan']?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <?php
                                    $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>