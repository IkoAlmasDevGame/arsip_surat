<?php 
require_once("../../../../database/koneksi.php");
$hasil = mysqli_fetch_array($konfigs->query("SELECT * FROM sistem WHERE status = '1' order by id_sistem asc"));
/* Files Model & Files Controller */ 
/* Files Model */
require_once("../../../../model/karyawan.php");
$karyawan = new model\karyawan($konfigs);
require_once("../../../../model/absensi.php");
require_once("../../../../model/keterangan.php");
require_once("../../../../model/arsip_surat.php");
require_once("../../../../model/pengaturan.php");
require_once("../../../../model/pengguna.php");
require_once("../../../../model/surat_masuk.php");
require_once("../../../../model/surat_keluar.php");
/* Files Controller */
require_once("../../../../controller/controller.php");
$AuthUser = new controller\Authentication($konfigs);

// Action & Page 
if(!isset($_GET['page'])){
}else{
    switch($_GET['page']){
        case 'beranda':
            require_once("../dashboard/index.php");
            break;
            
        case 'karyawan':
            $title = "Data Master Karyawan";
            require_once("../karyawan/karyawan.php");
            break;

        case 'keluar':
            if(isset($_SESSION['status'])){
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../../auth/index.php");
            exit(0);
            break;
        
        default:
            require_once("../dashboard/index.php");
            break;
    }
}

if(!isset($_GET['aksi'])){
}else{
    switch ($_GET['aksi']) {  
        # Master Karyawan
        case 'daftar-karyawan':
            $title = "Pendaftaran Karyawan";
            require_once("../karyawan/tambah.php");
            break;
            case 'tambah-karyawan':
                $AuthUser->buatedit();
                break;
            case 'hapus-karyawan':
                $AuthUser->hapus();
                break;
        # Master Karyawan

        
        default:
        require_once("../../../../controller/controller.php");
            break;
    }
}
?>