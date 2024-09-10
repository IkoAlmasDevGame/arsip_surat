<?php 

namespace model;

class pengaturan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function update($uid_jam, $jam_pagi, $jam_siang, $jam_malam, $uid, $nama, $status){
        # code Jam Masuk
        $uid_jam = htmlspecialchars($_POST['id_jam']) ? htmlentities($_POST['id_jam']) : strip_tags($_POST['id_jam']);
        $jam_pagi = htmlspecialchars($_POST['pagi']) ? htmlentities($_POST['pagi']) : strip_tags($_POST['pagi']);
        $jam_siang = htmlspecialchars($_POST['siang']) ? htmlentities($_POST['siang']) : strip_tags($_POST['siang']);
        $jam_malam = htmlspecialchars($_POST['malam']) ? htmlentities($_POST['malam']) : strip_tags($_POST['malam']);
        # code Sistem Website
        $uid = htmlspecialchars($_POST['id_sistem']) ? htmlentities($_POST['id_sistem']) : strip_tags($_POST['id_sistem']);
        $nama = htmlspecialchars($_POST['developer']) ? htmlentities($_POST['developer']) : strip_tags($_POST['developer']);
        $status = htmlspecialchars($_POST['status']) ? htmlentities($_POST['status']) : strip_tags($_POST['status']);
        if(isset($_POST['ubah'])){
            # code update 1
            $uJam = "UPDATE jam_masuk SET pagi = '$jam_pagi', siang = '$jam_siang', malam = '$jam_malam' WHERE id_jam = '$uid_jam'";
            $this->db->query($uJam);
            # code update 2
            $uSistem = "UPDATE sistem SET developer = ?, status = ? WHERE id_sistem = ?";
            $data = $this->db->prepare($uSistem);
            $data->execute(array($nama, $status, $uid));
            # code interaksi
            echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
            die;
        }else{
            echo "<script>document.location.href = '../ui/header.php?page=settings'</script>";
            die;
        }
    }
}
?>