<?php 

namespace model;

class absensi {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function simpan_absensi($nama, $tanggal, $absensi, $jam){
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : $_POST['nama'];
        $tanggal = htmlspecialchars($_POST['tanggal_input']) ? htmlentities($_POST['tanggal_input']) : $_POST['tanggal_input'];
        $absensi = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : $_POST['jam'];
        $jam = htmlspecialchars($_POST['jam2']) ? htmlentities($_POST['jam2']) : $_POST['jam2'];

        $table = "absensi";
        $base = $this->db->query("SELECT * FROM $table WHERE nama = '$nama' and tanggal_input = '$tanggal'");
        $match = mysqli_num_rows($base);
        
        if($match){
            echo "<script>alert('Anda sudah absensi di tanggal ($tanggal) segini');</script>";
            die;
        }else{
            $insert = "INSERT INTO $table SET nama = '$nama', tanggal_input = '$tanggal', jam = '$absensi', jam2 = '$jam'";
            $data = $this->db->query($insert);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?aksi=absensi-karyawan&info=absensi';</script>";
                    die;
                }
            }else{
                echo "<script>alert('Maaf anda belum absensi ... !');</script>";
                die;
            }
        }
    }
}
?>