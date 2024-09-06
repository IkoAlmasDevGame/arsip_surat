<?php 
namespace controller;

use model\karyawan;
use model\absensi;
use model\keterangan;

class Authentication {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new karyawan($konfig);
    }

    public function SignIn(){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $data = $this->konfig->Login($userInput, $password);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_akun = htmlspecialchars($_GET['id_akun']) ? htmlentities($_GET['id_akun']) : strip_tags($_GET['id_akun']);
        $data = $this->konfig->delete($id_akun);
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
        $data = $this->konfig->create($username, $email, $nama, $password, $repassword, $role);
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

?>