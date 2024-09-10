<?php 
require_once("../../../../database/koneksi.php");
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
$pengaturan = new model\pengaturan($konfigs);
require_once("../../../../model/pengguna.php");
require_once("../../../../model/surat_masuk.php");
$incomming = new model\incomingmail($konfigs);
require_once("../../../../model/surat_keluar.php");
/* Files Controller */
require_once("../../../../controller/controller.php");
$AuthUser = new controller\Authentication($konfigs);
$attedance = new controller\attedance($konfigs);
$document = new controller\document($konfigs);
$setting = new controller\settings($konfigs);
$mailin = new controller\mailincomming($konfigs);

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
            
        case 'suratmasuk':
            $title = "Data Master surat masuk";
            require_once("../surat_masuk/surat_masuk.php");
            break;
            
        case 'suratkeluar':
            $title = "Data Master surat keluar";
            require_once("../surat_keluar/surat_keluar.php");
            break;

        case 'settings':
            $title = "Data Master pengaturan";
            require_once("../pengaturan/pengaturan.php");
            break;

        case 'keluar':
            $jam_pulang = date('H:i:s');
            $name = $_SESSION['nama'];
            $data = $config->prepare("UPDATE absensi SET jam2 = ? WHERE nama = ?");
            $data->execute(array($jam_pulang, $name));
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
        # Master Surat Masuk
        case 'tambah-surat-masuk':
            $title = "Tambah Surat Masuk";
            $title2 = "Data Master surat masuk";
            require_once("../surat_masuk/tambah.php");
            break;
        case 'ubah-surat-masuk':
            $title = "Ubah Surat Masuk";
            $title2 = "Data Master surat masuk";
            require_once("../surat_masuk/ubah.php");
            break;
            case 'tambah-suratmasuk':
                $mailin->buat();
                break;
            case 'ubah-suratmasuk':
                $mailin->ubah();
                break;
            case 'hapus-suratmasuk':
                # code...
                break;
        # Master Surat Masuk

        # Master Pengaturan
        case 'update-settings':
            $setting->edit();
            break;
        # Master Pengaturan

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