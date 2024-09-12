<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Pengguna - Arsip Surat -</title>
        <link rel="stylesheet" href="../auth/style.css" crossorigin="anonymous">
        <link rel="stylesheet" crossorigin="anonymous"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" crossorigin="anonymous"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <?php 
            require_once("../../database/koneksi.php");
            $data = $konfigs->query("SELECT * FROM sistem WHERE status = '1' order by id_sistem asc");
            $hasil = mysqli_fetch_array($data);
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

    <body class="body" onload="startTime()">
        <!-- Layout Start -->
        <nav class="navbar navbar-default navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a href="index.php" aria-current="page" class="navbar-brand">Arsip Surat</a>
            </div>
        </nav>
        <div class="container-fluid mt-4 pt-5">
            <div class="d-flex justify-content-center align-items-center flex-wrap mt-1 pt-1">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h4 class="card-title text-center">- Register Pengguna - Arsip Surat -</h4>
                        <div class="text-end">
                            <a href="./register.php" aria-current="page" class="btn btn-sm btn-info btn-outline-dark">
                                <div class="fa fa-refresh fa-1x"></div>
                                <span>Muat Ulang</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body mt-1">
                        <?php if(isset($_GET['info'])){ ?>
                        <?php if($_GET['info'] == "passconfirm"){ ?>
                        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                            <strong>Informasi </strong>
                            <p>Kata sandi dan Ulangi Kata Sandi anda tidak cocok ...</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                onclick="document.location.href='./register.php'" aria-label="Close"></button>
                        </div>
                        <?php }else if($_GET['info'] == "berhasil"){ ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Informasi </strong>
                            <p>Anda telah berhasil membuat akun baru ...</p>
                            <button type="button" class="btn-close" onclick="document.location.href='./register.php'"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php }else if($_GET['info'] == "gagal"){ ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Informasi </strong>
                            <p>Anda telah gagal membuat akun baru ...</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                onclick="document.location.href='./register.php'" aria-label="Close"></button>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <?php 
                            require_once("../../controller/controller.php");
                            require_once("../../model/pengguna.php");
                            $registered = new controller\penggunaAuth($konfigs);
                            if(!isset($_GET['aksi'])){
                            }else{
                                switch ($_GET['aksi']) {
                                    case 'register-akun':
                                        $registered->buat();
                                        break;
                                    
                                    default:
                                        require_once("../../controller/controller.php");
                                        break;
                                }
                            }
                        ?>
                        <form action="?aksi=register-akun" enctype="multipart/form-data" method="post">
                            <div class="form-group mt-1 mt-lg-1">
                                <div class="form-inline row justify-content-center align-items-start flex-wrap">
                                    <div class="form-label col-sm-4 col-md-4">
                                        <label for="" class="label label-default fs-6
                                         text-dark fst-normal">User Name</label>
                                    </div>
                                    <div class="col-sm-8 col-md-8">
                                        <input type="text" name="username" maxlength="100" class="form-control" required
                                            aria-required="TRUE" placeholder="masukkan username baru anda ..." id="">
                                    </div>
                                </div>
                                <div class="mt-1 mb-1"></div>
                                <div class="form-inline row justify-content-center align-items-start flex-wrap">
                                    <div class="form-label col-sm-4 col-md-4">
                                        <label for="" class="label label-default fs-6
                                         text-dark fst-normal">Email Input</label>
                                    </div>
                                    <div class="col-sm-8 col-md-8">
                                        <input type="email" name="email" maxlength="255" class="form-control" required
                                            aria-required="TRUE" placeholder="masukkan email anda ..." id="">
                                    </div>
                                </div>
                                <div class="mt-1 mb-1"></div>
                                <div class="form-inline row justify-content-center align-items-start flex-wrap">
                                    <div class="form-label col-sm-4 col-md-4">
                                        <label for="" class="label label-default fs-6
                                         text-dark fst-normal">Nama Pengguna</label>
                                    </div>
                                    <div class="col-sm-8 col-md-8">
                                        <input type="text" name="nama" maxlength="80" class="form-control" required
                                            aria-required="TRUE" placeholder="masukkan nama anda ..." id="">
                                        <small>nama pengguna ini ialah sih penerima surat ...</small>
                                    </div>
                                </div>
                                <div class="mt-1 mb-1"></div>
                                <div class="form-inline row justify-content-center align-items-start flex-wrap">
                                    <div class="form-label col-sm-4 col-md-4">
                                        <label for="" class="label label-default fs-6
                                         text-dark fst-normal">Kata Sandi</label>
                                    </div>
                                    <div class="col-sm-8 col-md-8">
                                        <input type="password" name="password" maxlength="255" class="form-control"
                                            required aria-required="TRUE" placeholder="masukkan password anda ..."
                                            id="passwrd">
                                    </div>
                                </div>
                                <div class="mt-1 mb-1"></div>
                                <div class="form-inline row justify-content-center align-items-start flex-wrap">
                                    <div class="form-label col-sm-4 col-md-4">
                                        <label for="" class="label label-default fs-6
                                         text-dark fst-normal">Ulangi Kata Sandi</label>
                                    </div>
                                    <div class="col-sm-8 col-md-8">
                                        <input type="password" name="repassword" maxlength="255" class="form-control"
                                            required aria-required="TRUE"
                                            placeholder="masukkan ulangi password anda ..." id="repasswrd">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-end flex-wrap me-5 me-lg-5">
                                    <p style="color: salmon; font-size: 16px; display: none;" id="error">
                                        Password dan Repassword anda tidak cocok</p>
                                    <p style="color: green; font-size: 16px; display: none;" id="success">
                                        Password dan Repassword anda cocok
                                    </p>
                                </div>
                                <div class="mb-1 mt-1"></div>
                                <div hidden class="form-inline row justify-content-center align-items-start">
                                    <div class="form-label col-sm-4 col-md-4">
                                        <label for="" class="label label-default fs-6  text-dark">User Photo</label>
                                    </div>
                                    <div class="col-sm-7 col-md-8">
                                        <div class="form-icon img-thumbnail w-25">
                                            <img id="preview" alt="" src="../../../assets/image/profile/user_logo.png"
                                                width="64" class="img-rounded img-fluid">
                                        </div>
                                        <div class="form-control mt-1">
                                            <input type="file" name="foto" accept="image/*" id="fileInput"
                                                class="form-control-file" onchange="this.fileInput"
                                                aria-required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer mt-1">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save fa-1x"></i>
                                        <span>Simpan data</span>
                                    </button>
                                    <a href="./index.php" aria-current="page"
                                        class="btn btn-dark btn-outline-light">Cancel</a>
                                    <button type="reset" class="btn btn-danger">
                                        <i class="fa fa-eraser fa-1x"></i>
                                        <span>Hapus semua</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Layout Finish -->
        <script crossorigin="anonymous" lang="javascript"
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        </script>
        <script crossorigin="anonymous" lang="javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
        </script>
        <script crossorigin="anonymous" lang="javascript"
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
        </script>
        <script type="text/javascript" crossorigin="anonymous">
        function startTime() {
            var day = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];
            var today = new Date();
            var h = today.getHours();
            var tahun = today.getFullYear();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('year').innerHTML =
                "&copy <?php echo $hasil['developer']?> " + tahun + "<br>" + day[today.getDay()] + ", " + h +
                " : " +
                m +
                " : " + s;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
        </script>
    </body>

</html>