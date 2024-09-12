<?php 
namespace controller;

use model\karyawan;
use model\absensi;
use model\keterangan;
use model\pengaturan;
use model\incomingmail;

class Authentication {
    protected $konfigs;
    public function __construct($konfigs)
    {
        $this->konfigs = new karyawan($konfigs);
    }

    public function SignIn(){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $data = $this->konfigs->Login($userInput, $password);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_akun = htmlspecialchars($_GET['id_akun']) ? htmlentities($_GET['id_akun']) : strip_tags($_GET['id_akun']);
        $data = $this->konfigs->delete($id_akun);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function buatedit(){
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : strip_tags($_POST['username']);
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : strip_tags($_POST['email']);
        $nama = htmlentities($_POST['nama']) ? htmlspecialchars($_POST['nama']) : strip_tags($_POST['nama']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $repassword = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : strip_tags($_POST['role']);
        $data = $this->konfigs->create($username, $email, $nama, $password, $repassword, $role);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class attedance {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new absensi($konfig);
    }

    public function attdance(){
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : $_POST['nama'];
        $tanggal = htmlspecialchars($_POST['tanggal_input']) ? htmlentities($_POST['tanggal_input']) : $_POST['tanggal_input'];
        $absensi = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : $_POST['jam'];
        $jam = htmlspecialchars($_POST['jam2']) ? htmlentities($_POST['jam2']) : $_POST['jam2'];
        $data = $this->konfig->simpan_absensi($nama, $tanggal, $absensi, $jam);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class document {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new keterangan($konfig);
    }

    public function buat_keterangan(){
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $keterangan = htmlspecialchars($_POST['keterangan']) ? htmlentities($_POST['keterangan']) : strip_tags($_POST['keterangan']);
        $alasan = htmlspecialchars($_POST['alasan']) ? htmlentities($_POST['alasan']) : strip_tags($_POST['alasan']);
        $tanggal = htmlspecialchars($_POST['tanggal']) ? htmlentities($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $jam = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : strip_tags($_POST['jam']);
        $data = $this->konfig->simpan_keterangan($nama, $keterangan, $alasan, $tanggal, $jam);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class settings {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new pengaturan($konfig);
    }

    public function edit(){
        $uid_jam = htmlspecialchars($_POST['id_jam']) ? htmlentities($_POST['id_jam']) : strip_tags($_POST['id_jam']);
        $jam_pagi = htmlspecialchars($_POST['jam_pagi']) ? htmlentities($_POST['jam_pagi']) : strip_tags($_POST['jam_pagi']);
        $jam_siang = htmlspecialchars($_POST['jam_siang']) ? htmlentities($_POST['jam_siang']) : strip_tags($_POST['jam_siang']);
        $jam_malam = htmlspecialchars($_POST['jam_malam']) ? htmlentities($_POST['jam_malam']) : strip_tags($_POST['jam_malam']);
        # code Sistem Website
        $uid = htmlspecialchars($_POST['id_sistem']) ? htmlentities($_POST['id_sistem']) : strip_tags($_POST['id_sistem']);
        $nama = htmlspecialchars($_POST['developer']) ? htmlentities($_POST['developer']) : strip_tags($_POST['developer']);
        $status = htmlspecialchars($_POST['status']) ? htmlentities($_POST['status']) : strip_tags($_POST['status']);
        $data = $this->konfig->update($uid_jam, $jam_pagi, $jam_siang, $jam_malam, $uid, $nama, $status);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class mailincomming {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new incomingmail($konfig);
    }

    public function buat(){
        $nomorsurat = htmlentities($_POST['nomor_surat']) ? htmlspecialchars($_POST['nomor_surat']) : strip_tags($_POST['nomor_surat']);
        $tanggal = htmlentities($_POST['tanggal']) ? htmlspecialchars($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $pengirim = htmlentities($_POST['pengirim']) ? htmlspecialchars($_POST['pengirim']) : strip_tags($_POST['pengirim']);
        $penerima = htmlentities($_POST['penerima']) ? htmlspecialchars($_POST['penerima']) : strip_tags($_POST['penerima']);
        $perihal = htmlentities($_POST['perihal']) ? htmlspecialchars($_POST['perihal']) : strip_tags($_POST['perihal']);
        $keterangan = htmlentities($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : strip_tags($_POST['keterangan']);
        $data = $this->konfig->create($nomorsurat,$tanggal,$pengirim,$penerima,$perihal,$keterangan);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        // Penginputan
        $nomorsurat = htmlentities($_POST['nomor_surat']) ? htmlspecialchars($_POST['nomor_surat']) : strip_tags($_POST['nomor_surat']);
        $tanggal = htmlentities($_POST['tanggal']) ? htmlspecialchars($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $pengirim = htmlentities($_POST['pengirim']) ? htmlspecialchars($_POST['pengirim']) : strip_tags($_POST['pengirim']);
        $penerima = htmlentities($_POST['penerima']) ? htmlspecialchars($_POST['penerima']) : strip_tags($_POST['penerima']);
        $perihal = htmlentities($_POST['perihal']) ? htmlspecialchars($_POST['perihal']) : strip_tags($_POST['perihal']);
        $keterangan = htmlentities($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : strip_tags($_POST['keterangan']);
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : strip_tags($_POST['id']);
        $data = $this->konfig->update($nomorsurat,$tanggal,$pengirim,$penerima,$perihal,$keterangan,$id);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : strip_tags($_GET['id']);
        $data = $this->konfig->delete($id);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

?>