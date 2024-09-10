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
                echo "<script>document.location.href = '../ui/header.php?page=beranda';</script>";
                die;
            }
        ?>
        <script type="text/javascript">
        function fetchData() {
            $.ajax({
                url: '../karyawan/get_karyawan.php', // Path ke skrip PHP Anda
                method: 'GET',
                dataType: 'json', // Meminta data dalam format JSON
                success: function(data) {
                    var dataList = $('#dataList');
                    dataList.empty(); // Kosongkan daftar sebelumnya

                    if (Array.isArray(data)) {
                        $.each(data, function(index, item) {
                            var listItem = $('<li></li>').html(JSON.stringify(data, {
                                'id_akun': item.id_akun,
                                'username': item.username,
                                'email': item.email,
                                'password': item.password,
                                'repassword': item.repassword,
                                'role': item.role,
                                'foto': item.foto
                            }, 10));
                            console.log(data);
                            dataList.append(listItem);
                        });
                    } else {
                        // Menampilkan pesan jika tidak ada data
                        var listItem = $('<li></li>').text(data.message || 'Tidak ada data');
                        dataList.append(listItem);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan:', error);
                    var dataList = $('#dataList');
                    dataList.empty();
                    dataList.append('<li>Terjadi kesalahan saat mengambil data.</li>');
                }
            });
        }
        </script>
    </head>

    <body onload="fetchData()">
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
                        <a href="?page=karyawan" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title"><?php echo $title ?></h4>
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
                        <ul id="dataList" hidden></ul>
                        <div class="d-table">
                            <table class="table-layout" id="example1">
                                <thead>
                                    <tr>
                                        <th class="table-layout-2 text-center">No.</th>
                                        <th class="table-layout-2 text-center">User Name</th>
                                        <th class="table-layout-2 text-center">Email Karyawan</th>
                                        <th class="table-layout-2 text-center">Nama Karyawan</th>
                                        <th class="table-layout-2 text-center">Password</th>
                                        <th class="table-layout-2 text-center">Repassword</th>
                                        <th class="table-layout-2 text-center">Jabatan Karyawan</th>
                                        <th class="table-layout-2 text-center">Foto Karyawan</th>
                                        <th class="table-layout-2 text-center">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $table = "users";
                                        $data = $konfigs->query("SELECT * FROM $table WHERE role = 'admin'");
                                        while($row = $data->fetch_array()){
                                    ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $no; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $row['username'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $row['email'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $row['nama'] ?></td>
                                        <td class="table-layout-2 text-center">Password Ter-Enkripsi</td>
                                        <td class="table-layout-2 text-center">Password Ter-Enkripsi</td>
                                        <td class="table-layout-2 text-center"><?php echo $row['role'] ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php $baseFile = "../../../../../assets/image/$row[foto]"; ?>
                                            <img src="<?php echo $baseFile;?>" class="img-responsive" width="64" alt="">
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <a href="?aksi=hapus-karyawan&id_akun=<?php echo $row['id_akun']?>"
                                                onclick="return confirm('Apakah anda ingin menghapus data karyawan ini ?')"
                                                aria-current="page" class="btn btn-danger">
                                                <i class="fa fa-trash-alt fa-1x"></i>
                                            </a>
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