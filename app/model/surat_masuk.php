<?php 
namespace model;

class incomingmail {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($nomorsurat,$tanggal,$pengirim,$penerima,$perihal,$keterangan){
        // Penginputan
        $nomorsurat = htmlentities($_POST['nomor_surat']) ? htmlspecialchars($_POST['nomor_surat']) : strip_tags($_POST['nomor_surat']);
        $tanggal = htmlentities($_POST['tanggal']) ? htmlspecialchars($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $pengirim = htmlentities($_POST['pengirim']) ? htmlspecialchars($_POST['pengirim']) : strip_tags($_POST['pengirim']);
        $penerima = htmlentities($_POST['penerima']) ? htmlspecialchars($_POST['penerima']) : strip_tags($_POST['penerima']);
        $perihal = htmlentities($_POST['perihal']) ? htmlspecialchars($_POST['perihal']) : strip_tags($_POST['perihal']);
        $keterangan = htmlentities($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : strip_tags($_POST['keterangan']);

        // Database Create
        $table = "surat_masuk";
        $select = $this->db->query("SELECT * FROM $table WHERE id = '$_POST[id]' order by id asc");
        $select = mysqli_num_rows($select);

        if($select > 0){
            echo "<script>document.location.href = '../ui/header.php?page=suratmasuk'; alert('maaf id surat masuk ini sama ...');</script>";
            die;
        }else{
            $insert = "INSERT INTO $table SET nomor_surat = '$nomorsurat', tanggal = '$tanggal',
             pengirim = '$pengirim', penerima = '$penerima', jenis_surat = 'masuk', perihal = '$perihal', keterangan = '$keterangan', status = 'belum_dibaca'";
            $this->db->query("INSERT INTO surat_keluar SET nomor_surat = '$nomorsurat', tanggal = '$tanggal',
             pengirim = '$pengirim', penerima = '$penerima', jenis_surat = 'keluar', perihal = '$perihal', keterangan = '$keterangan', status = 'belum_dibaca'");
            $data = $this->db->query($insert);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=suratmasuk'; alert('selamat anda sudah berhasil membuat surat masuk untuk penerima ...');</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?aksi=tambah-surat-masuk'; alert('anda gagal membuat surat masuk untuk penerima ...');</script>";
                die;
            }
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : strip_tags($_GET['id']);
        $table = "surat_masuk";
        $table2 = "surat_keluar";
        $delete = "DELETE * FROM $table WHERE id = '$id'";
        $delete2 = "DELETE * FROM $table2 WHERE id = '$id'";
        $dataHapus = $this->db->query($delete2);
        $data = $this->db->query($delete);
        if($data != null && $dataHapus != null){
            if($data && $dataHapus){
                echo "<script>alert('surat ini sudah ter-hapus'); document.location.href = '../ui/header.php?page=suratmasuk'</script>";
                die;
            }
        }else{
            echo "<script>alert('surat ini gagal ter-hapus'); document.location.href = '../ui/header.php?page=suratmasuk'</script>";
            die;
        }
    }
    
    public function update($nomorsurat,$tanggal,$pengirim,$penerima,$perihal,$keterangan,$id){
        // Penginputan
        $nomorsurat = htmlentities($_POST['nomor_surat']) ? htmlspecialchars($_POST['nomor_surat']) : strip_tags($_POST['nomor_surat']);
        $tanggal = htmlentities($_POST['tanggal']) ? htmlspecialchars($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $pengirim = htmlentities($_POST['pengirim']) ? htmlspecialchars($_POST['pengirim']) : strip_tags($_POST['pengirim']);
        $penerima = htmlentities($_POST['penerima']) ? htmlspecialchars($_POST['penerima']) : strip_tags($_POST['penerima']);
        $perihal = htmlentities($_POST['perihal']) ? htmlspecialchars($_POST['perihal']) : strip_tags($_POST['perihal']);
        $keterangan = htmlentities($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : strip_tags($_POST['keterangan']);
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : strip_tags($_POST['id']);

        $table = "surat_masuk";
        $insert = "UPDATE $table SET nomor_surat = '$nomorsurat', tanggal = '$tanggal', pengirim = '$pengirim',
         penerima = '$penerima', jenis_surat = 'masuk', perihal = '$perihal', keterangan = '$keterangan', status = 'belum_dibaca' WHERE id = '$id'";
        $this->db->query("UPDATE surat_keluar SET nomor_surat = '$nomorsurat', tanggal = '$tanggal', pengirim = '$pengirim',
         penerima = '$penerima', jenis_surat = 'keluar', perihal = '$perihal', keterangan = '$keterangan', status = 'belum_dibaca' WHERE id = '$id'");
        $data = $this->db->query($insert);
        if($data != null){
            if($data){
                echo "<script>document.location.href = '../ui/header.php?page=suratmasuk'; alert('selamat anda sudah berhasil mengubah surat masuk untuk penerima ...');</script>";
                die;
            }
        }else{
            echo "<script>document.location.href = '../ui/header.php?aksi=ubah-surat-masuk&id=$id'; alert('anda gagal mengubah surat masuk untuk penerima ...');</script>";
            die;
        }
    }
}
?>