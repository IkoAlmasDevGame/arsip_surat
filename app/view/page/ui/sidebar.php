<?php 
if($_SESSION['role'] == ""){
    echo "<script>document.location.href = '../../auth/index.php?info=gagal'</script>";
    exit;
}
?>

<?php 
if($_SESSION['role'] == "pengguna"){
?>
<header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
            Arsip Surat - Pengguna
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto mx-3">
        <ul>
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                    data-bs-toggle="dropdown" aria-controls="dropdown">
                    <?php $baseFile = mysqli_fetch_array($konfigs->query("SELECT * FROM pengguna WHERE email = '$_SESSION[email]'")); ?>
                    <img <?php if($_SESSION['foto']){?> src="../../../../assets/image/<?php echo $baseFile['foto']; ?>"
                        <?php }else{?> src="../../../../assets/image/profile/<?php echo $baseFile['foto']; ?>"
                        <?php } ?> width="32" height="32" alt="<?php echo $_SESSION['nama']?>"
                        class="rounded-3 img-circle img-responsive">
                    <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <hr class="dropdown-divider">
                        <div class="text-start">username : <?php echo $baseFile['username'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Email : <?php echo $baseFile['email'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">nama : <?php echo $baseFile['nama'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Jabatan : <?php echo $_SESSION['role'] ?></div>
                        <hr class="dropdown-divider">
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<!-- ======= Header ======= -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=beranda">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Blank Page Nav -->
        <br>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=suratmasuk">
                <i class="bi bi-mailbox2 fa-1x"></i>
                <?php $countSM = mysqli_fetch_array($konfigs->query("SELECT count(jenis_surat) as masuk FROM surat_masuk WHERE jenis_surat = 'masuk' and status = 'belum_dibaca'")); ?>
                <span>Surat Masuk</span>
                <div class="ms-auto ms-lg-auto"><?php echo $countSM['masuk'] ?></div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=suratkeluar">
                <i class="bi bi-mailbox fa-1x"></i>
                <?php $countSK = mysqli_fetch_array($konfigs->query("SELECT count(jenis_surat) as keluar FROM surat_keluar WHERE jenis_surat = 'keluar' and status = 'belum_dibaca'")); ?>
                <span>Surat Keluar</span>
                <div class="ms-auto ms-lg-auto"><?php echo $countSK['keluar'] ?></div>
            </a>
        </li>
        <br>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=arsip-suratmasuk">
                <i class="bi bi-bookmark fa-1x"></i>
                <?php $countASM = mysqli_fetch_array($konfigs->query("SELECT count(jenis_surat) as masuk FROM arsip_surat WHERE jenis_surat = 'masuk'")); ?>
                <span>Arsip Surat Masuk</span>
                <div class="ms-auto ms-lg-auto"><?php echo $countASM['masuk'] ?></div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=arsip-suratkeluar">
                <i class="bi bi-bookmarks fa-1x"></i>
                <?php $countASK = mysqli_fetch_array($konfigs->query("SELECT count(jenis_surat) as keluar FROM arsip_surat WHERE jenis_surat = 'keluar'")); ?>
                <span>Arsip Surat Keluar</span>
                <div class="ms-auto ms-lg-auto"><?php echo $countASK['keluar'] ?></div>
            </a>
        </li>
        <br>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?aksi=ubah-profile&id=<?php echo $_SESSION['id']?>"
                onclick="return confirm('Apakah anda ingin edit profile anda ?')">
                <i class="fa fa-user-edit fa-1x"></i>
                <span>Edit Profile</span>
            </a>
        </li>
        <br>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                onclick=" return confirm('Apakah anda ingin logout ?')">
                <i class="fa fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Blank Page Nav -->
    </ul>
</aside>
<!-- ======= Sidebar ======= -->

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                </div>

            </div><!-- End Right side columns -->

        </div>
    </section>
    <?php
}else{
    echo "<script>document.location.href = '../../auth/index.php'</script>";
    exit;

}
?>