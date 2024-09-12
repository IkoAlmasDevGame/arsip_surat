<?php 
require_once("../../../database/koneksi.php");
$data = $konfigs->query("SELECT * FROM sistem WHERE status = '1' order by id_sistem asc") or mysqli_connect_errno();
$hasil = mysqli_fetch_array($data) or mysqli_error($data);

/* Files Model & Files Controller */ 
/* Files Model */
require_once("../../../model/surat_masuk.php");
$incomming = new model\incomingmail($konfigs);
require_once("../../../model/arsip_surat.php");
$arsipmail = new model\ArsipMailing($konfigs);
require_once("../../../model/pengguna.php");
$Authregistered = new model\pengguna($konfigs);
/* Files Controller */
require_once("../../../controller/controller.php");
$Authentication = new controller\penggunaAuth($konfigs);
$mailin = new controller\mailincomming($konfigs);
$arsip = new controller\Arsip($konfigs);

// Action & Page 
if(!isset($_GET['page'])){
}else{
    switch($_GET['page']){
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'suratmasuk':
            $title = "surat masuk";
            require_once("../surat_masuk/surat_masuk.php");
            break;
            
        case 'suratkeluar':
            $title = "surat keluar";
            require_once("../surat_keluar/surat_keluar.php");
            break;
            
        case 'arsip-suratmasuk':
            $title = "arsip surat masuk";
            require_once("../arsip/arsip_masuk.php");
            break;
            
        case 'arsip-suratkeluar':
            $title = "arsip surat keluar";
            require_once("../arsip/arsip_keluar.php");
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
    switch($_GET['aksi']){
        case 'ubah-profile':
            $title = "Ubah Profile Pribadi";
            require_once("../profile/ubah.php");
            break;
        case 'ubah-pengguna':
            $Authentication->ubah();
            break;
        # Master Penggun - Profile -

        # Master Surat Masuk
        case 'open-surat':
            $mailin->buka();
            break;
        # Master Surat Masuk

        # Master Arsip Surat
        case 'arsip-masuk':
            $arsip->arsip_masuk();
            break;
        case 'arsip-keluar':
            $arsip->arsip_keluar();
            break;
        # Master Arsip Surat

        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
?>