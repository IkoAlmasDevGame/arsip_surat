<?php 
namespace controller;

use model\karyawan;

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

?>