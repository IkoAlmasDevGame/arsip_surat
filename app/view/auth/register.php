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
    </head>

    <body class="body" onload="startTime()">
        <!-- Layout Start -->
        <nav class="navbar navbar-default navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a href="index.php" aria-current="page" class="navbar-brand">Arsip Surat</a>
            </div>
        </nav>
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