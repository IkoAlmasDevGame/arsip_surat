<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['role'] == "superadmin"){
                require_once("../ui/header.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda';</script>";
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
                        <a href="?page=keterangan" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container">
            <div class="card-header py-2">
                <h4 class="card-title">Master Keterangan</h4>
                <a href="?page=keterangan" aria-current="page" class="btn btn-info">
                    <i class="fa fa-refresh fa-1x"></i>
                    <span>Refresh Page</span>
                </a>
            </div>
            <div class="card-body mt-1">
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
                                    <tr>
                                        <th class="table-layout-2 text-center">No.</th>
                                        <th class="table-layout-2 text-center">Nama Karyawan</th>
                                        <th class="table-layout-2 text-center">Keterangan</th>
                                        <th class="table-layout-2 text-center">Alasan Keterangan</th>
                                        <th class="table-layout-2 text-center">Tanggal Keterangan</th>
                                        <th class="table-layout-2 text-center">Jam Keterangan</th>
                                        <th class="table-layout-2 text-center">Foto Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $sql = "SELECT * FROM keterangan order by id_keterangan asc";
                                        $data = $konfigs->query($sql);
                                        while($pro = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $no; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['nama']?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['keterangan']?></td>
                                        <td class="table-layout-2 text-center">
                                            <p><?php echo $isi['alasan']?></p>
                                        </td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['tanggal']?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['jam']?></td>
                                        <td class="table-layout-2 text-center">
                                            <img src="../../../../assets/keterangan/<?php echo $isi['foto']?>" alt=""
                                                width="64" class="rounded-2 img-circle">
                                        </td>
                                    </tr>
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
        <?php require_once("../ui/footer.php") ?>