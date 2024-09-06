<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['role'] == "superadmin"){
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
                        <a href="?page=absensi" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container">
            <div class="card-header py-2">
                <h4 class="card-title">Master Absensi Karyawan</h4>
                <a href="?page=absensi" aria-current="page" class="btn btn-info">
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
                                        <th class="table-layout-2 text-center">Tanggal Sekarang</th>
                                        <th class="table-layout-2 text-center">Jam Absensi Pagi</th>
                                        <th class="table-layout-2 text-center">Jam Absensi Siang</th>
                                        <th class="table-layout-2 text-center">Status Absensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $sql = "SELECT * FROM absensi order by id_absensi asc";
                                        $data = $konfigs->query($sql);
                                        while($pro = $data->fetch_array()){
                                    ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $no; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pro['nama'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pro['tanggal_input'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $pro['jam'] ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php 
                                                $select_jam = $konfigs->query("SELECT * FROM jam_masuk inner join absensi on jam_masuk.jam_pagi = absensi.pagi_jam order by jam_pagi asc");
                                                $jam_masuk = mysqli_fetch_array($select_jam);
                                                if($pro['jam'] > $jam_masuk['jam_pagi']){
                                                    echo "<b style='color: red;'>telat</b>";
                                                }else{
                                                    echo "<b style='color: green;'>tepat waktu</b>";                                                    
                                                }
                                            ?>
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <?php 
                                                $select_jam = $konfigs->query("SELECT * FROM jam_masuk inner join absensi on jam_masuk.jam_siang = absensi.siang_jam order by jam_siang asc");
                                                $jam_masuk = mysqli_fetch_array($select_jam);
                                                if($pro['jam'] > $jam_masuk['jam_siang']){
                                                    echo "<b style='color: red;'>telat</b>";
                                                }else{
                                                    echo "<b style='color: green;'>tepat waktu</b>";                                                    
                                                }
                                            ?>
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
        <?php 
            require_once("../ui/footer.php");
        ?>