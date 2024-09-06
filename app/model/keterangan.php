<?php 
namespace model;

class keterangan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function simpan_keterangan($nama, $keterangan, $alasan, $tanggal, $jam){
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $keterangan = htmlspecialchars($_POST['keterangan']) ? htmlentities($_POST['keterangan']) : strip_tags($_POST['keterangan']);
        $alasan = htmlspecialchars($_POST['alasan']) ? htmlentities($_POST['alasan']) : strip_tags($_POST['alasan']);
        $tanggal = htmlspecialchars($_POST['tanggal']) ? htmlentities($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $jam = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : strip_tags($_POST['jam']);

        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif'); 
        $photo_src = htmlentities($_FILES["foto"]["name"]) ? htmlspecialchars($_FILES["foto"]["name"]) : $_FILES["foto"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['foto']['size'];
        $file_tmp_photo_src = $_FILES['foto']['tmp_name'];

        if(in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true){
            if($ukuran_photo_src < 10440070){
                move_uploaded_file($file_tmp_photo_src, "../../../../../assets/image/" . $photo_src);
            }else{
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;                
            }
        }else{
            echo "Tidak Dapat Ter - Upload Gambar";
            exit;
        }

        $table = "keterangan";
        $base = $this->db->query("SELECT * FROM $table WHERE nama = '$nama' and tanggal = '$tanggal'");
        $cek = mysqli_num_rows($base);

        if($cek){
            echo "<script>document.location.href = '../ui/header.php?aksi=keterangan-karyawan&info=dialog';</script>";
            die;
        }else{
            $insert = "INSERT INTO $table SET nama = '$nama', keterangan = '$keterangan', alasan = '$alasan', tanggal = '$tanggal', jam = '$jam', foto = '$photo_src'";
            $data = $this->db->query($insert);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?aksi=keterangan-karyawan&info=berhasil';</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?aksi=keterangan-karyawan&info=gagal';</script>";
                die;                
            }
        }
    }
}

?>