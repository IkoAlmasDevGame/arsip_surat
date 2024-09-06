<?php 
require_once("../../../../database/koneksi.php");
$hasil = mysqli_fetch_array($konfigs->query("SELECT * FROM sistem WHERE status = '1' order by id_sistem asc"));
/* Files Model & Files Controller */ 
/* Files Model */
require_once("../../../../model/karyawan.php");
$karyawan = new model\karyawan($konfigs);
require_once("../../../../model/absensi.php");
$absensi = new model\absensi($konfigs);
require_once("../../../../model/keterangan.php");
$keterangan = new model\keterangan($konfigs);
require_once("../../../../model/arsip_surat.php");
require_once("../../../../model/pengaturan.php");
require_once("../../../../model/pengguna.php");
require_once("../../../../model/surat_masuk.php");
require_once("../../../../model/surat_keluar.php");
/* Files Controller */
require_once("../../../../controller/controller.php");
$AuthUser = new controller\Authentication($konfigs);
$attedance = new controller\attedance($konfigs);
$document = new controller\document($konfigs);

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

        case 'absensi':
            $title = "Data Master absensi";
            require_once("../absensi/absensi.php");
            break;
            
        case 'keterangan':
            $title = "Data Master keterangan";
            require_once("../keterangan/keterangan.php");
            break;

        case 'settings':
            $title = "Data Master pengaturan";
            require_once("../pengaturan/pengaturan.php");
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
        # Master Absensi
        case 'absensi-karyawan':
            require_once("../absensi/tambah.php");
            break;
            case 'simpan-absensi':
                $attedance->attdance();
                break;
        # Master Absensi

        # Master Keterangan
        case 'keterangan-karyawan':
            require_once("../keterangan/tambah.php");
            break;
            case 'simpan-keterangan':
                $document->buat_keterangan();
                break;
        # Master Keterangan
        
        # Master Karyawan
        case 'daftar-karyawan':
            $title = "Pendaftaran Karyawan";
            require_once("../karyawan/tambah.php");
            break;
        case 'ubah-karyawan':
            $title = "ubah Karyawan";
            require_once("../pengguna/ubah.php");
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