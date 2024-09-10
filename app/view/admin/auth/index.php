<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Administrasi - Arsip Surat -</title>
        <link rel="stylesheet" href="../auth/style.css" crossorigin="anonymous">
        <link rel="stylesheet" crossorigin="anonymous"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" crossorigin="anonymous"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <?php 
            require_once("../../../database/koneksi.php");
            $data = $config->prepare("SELECT * FROM sistem WHERE status = '1' order by id_sistem asc");
            $data->execute();
            $hasil = $data->fetchAll();
        ?>
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
                        <h4 class="card-title text-center">- Login Administrasi - Arsip Surat -</h4>
                    </div>
                    <div class="card-body mt-1">
                        <?php require_once("../auth/function.php"); ?>
                        <?php 
                            require_once("../../../controller/controller.php");
                            require_once("../../../model/karyawan.php");

                            $authentication = new controller\Authentication($konfigs);
                            if(!isset($_GET['aksi'])){
                            }else{
                                switch ($_GET['aksi']) {
                                    case 'login':
                                        $authentication->SignIn();
                                        break;
                                    
                                    default:
                                        require_once("../../../controller/controller.php");
                                        break;
                                }
                            }
                        ?>
                        <form action="?aksi=login" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <div class="form-inline row justify-content-center
                                     align-items-center flex-wrap mb-1 mt-1">
                                    <div class="form-label col-sm-2 col-md-3">
                                        <label for="" class="label label-default">User Input</label>
                                    </div>
                                    <div class="col-sm-8 col-md-9">
                                        <input type="text" name="userInput" aria-required="TRUE" class="form-control"
                                            placeholder="masukkan username atau email anda ..." required id="">
                                    </div>
                                </div>
                                <div class="form-inline row justify-content-center
                                 align-items-center flex-wrap mb-1 mt-1">
                                    <div class="form-label col-sm-2 col-md-3">
                                        <label for="" class="label label-default">Kata Sandi</label>
                                    </div>
                                    <div class="col-sm-8 col-md-9">
                                        <input type="password" name="password" aria-required="TRUE" class="form-control"
                                            placeholder="masukkan kata sandi anda ..." required id="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer m-1">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-sign-in-alt fa-1x"></i>
                                        <span>Sign In</span>
                                    </button>
                                    <button type="reset" class="btn btn-danger">
                                        <i class="fa fa-eraser fa-1x"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                                <div class="container mt-4 p-1">
                                    <footer class="footer">
                                        <p id="year" class="text-center"></p>
                                    </footer>
                                </div>
                            </div>
                        </form>
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