<?php 
namespace model;

class ArsipMailing {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_masuk($nomorsurat,$tanggal,$jenis,$pengirim,$penerima,$perihal,$keterangan){
        // Penginputan
        $nomorsurat = htmlentities($_POST['nomor_surat']) ? htmlspecialchars($_POST['nomor_surat']) : strip_tags($_POST['nomor_surat']);
        $tanggal = htmlentities($_POST['tanggal']) ? htmlspecialchars($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $jenis = "masuk";
        $pengirim = htmlentities($_POST['pengirim']) ? htmlspecialchars($_POST['pengirim']) : strip_tags($_POST['pengirim']);
        $penerima = htmlentities($_POST['penerima']) ? htmlspecialchars($_POST['penerima']) : strip_tags($_POST['penerima']);
        $perihal = htmlentities($_POST['perihal']) ? htmlspecialchars($_POST['perihal']) : strip_tags($_POST['perihal']);
        $keterangan = htmlentities($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : strip_tags($_POST['keterangan']);

        // DataBase Arsip
        $table = "arsip_surat";
        $insertUpdate = "INSERT INTO $table SET nomor_surat = '$nomorsurat', tanggal = '$tanggal', pengirim = '$pengirim',
         penerima = '$penerima', jenis_surat = '$jenis', perihal = '$perihal', keterangan = '$keterangan'";
        $dataInsert = $this->db->query($insertUpdate);
        if($dataInsert != null){
            if($dataInsert){
                echo "<script>document.location.href = '../ui/header.php?page=arsip-suratmasuk';</script>";
                die;
            }
        }else{
            echo "<script>document.location.href = '../ui/header.php?page=suratmasuk';</script>";
            die;
        }
    }
    
    public function create_keluar($nomorsurat,$tanggal,$jenis,$pengirim,$penerima,$perihal,$keterangan){
        // Penginputan
        $nomorsurat = htmlentities($_POST['nomor_surat']) ? htmlspecialchars($_POST['nomor_surat']) : strip_tags($_POST['nomor_surat']);
        $tanggal = htmlentities($_POST['tanggal']) ? htmlspecialchars($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $jenis = "keluar";
        $pengirim = htmlentities($_POST['pengirim']) ? htmlspecialchars($_POST['pengirim']) : strip_tags($_POST['pengirim']);
        $penerima = htmlentities($_POST['penerima']) ? htmlspecialchars($_POST['penerima']) : strip_tags($_POST['penerima']);
        $perihal = htmlentities($_POST['perihal']) ? htmlspecialchars($_POST['perihal']) : strip_tags($_POST['perihal']);
        $keterangan = htmlentities($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : strip_tags($_POST['keterangan']);

        // DataBase Arsip
        $table = "arsip_surat";
        $insertUpdate = "INSERT INTO $table SET nomor_surat = '$nomorsurat', tanggal = '$tanggal',
         pengirim = '$pengirim', penerima = '$penerima', jenis_surat = '$jenis', perihal = '$perihal', keterangan = '$keterangan'";
        $dataInsert = $this->db->query($insertUpdate);
        if($dataInsert != null){
            if($dataInsert){
                echo "<script>document.location.href = '../ui/header.php?page=arsip-suratkeluar';</script>";
                die;
            }
        }else{
            echo "<script>document.location.href = '../ui/header.php?page=suratkeluar';</script>";
            die;
        }

    }
}
?>