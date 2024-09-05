<?php 
namespace model;

class karyawan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($username, $email, $nama, $password, $repassword, $role){
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : strip_tags($_POST['username']);
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : strip_tags($_POST['email']);
        $nama = htmlentities($_POST['nama']) ? htmlspecialchars($_POST['nama']) : strip_tags($_POST['nama']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $repassword = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : strip_tags($_POST['role']);
        # code ... Foto Karyawan
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

        $table = "users";
        $select = $this->db->query("SELECT * FROM $table WHERE id_akun = '$_POST[id_akun]'");
        $cekselect = mysqli_fetch_array($select);

        if($cekselect['id_akun'] > 0){
            if(isset($_POST['ubahfoto'])){
                if($cekselect['foto'] == ""){
                    $update = "UPDATE $table SET username = '$username', email = '$email', nama = '$nama', password = '$password',
                     repassword = '$repassword', role = '$role', foto = '$photo_src' WHERE id_akun = '$_POST[id_akun]'";
                    $data = $this->db->query($update);
                    if($data != null){
                        if($data){
                            echo "<script>document.location.href = '../ui/header.php?aksi=ubah-karyawan&id=$_GET[id_akun]&info=ubahdata'</script>";
                            die;
                        }
                    }else{
                        echo "<script>document.location.href = '../ui/header.php?aksi=ubah-karyawan&id=$_GET[id_akun]&info=gagal'</script>";
                        die;
                    }
                }elseif($cekselect['foto'] != ""){
                    if($photo_src != ""){
                        $updated = "UPDATE $table SET username = '$username', email = '$email', nama = '$nama', password = '$password',
                         repassword = '$repassword', role = '$role', foto = '$photo_src' WHERE id_akun = '$_POST[id_akun]'";
                        $data = $this->db->query($updated);
                        unlink("../../../../../assets/image/$cekselect[foto]");
                        if($data != null){
                            if($data){
                                echo "<script>document.location.href = '../ui/header.php?aksi=ubah-karyawan&id=$_GET[id_akun]&info=ubahdata'</script>";
                                die;
                            }
                        }else{
                            echo "<script>document.location.href = '../ui/header.php?aksi=ubah-karyawan&id=$_GET[id_akun]&info=gagal'</script>";
                            die;
                        }
                    }
                }
            }
        }else{
            $insert = "INSERT INTO $table SET username = '$username', email = '$email', nama = '$nama', password = '$password', repassword = '$repassword', role = '$role', foto = '$photo_src'";
            $data = $this->db->query($insert);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?aksi=daftar-karyawan&info=berhasil'</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?aksi=daftar-karyawan&info=gagal'</script>";
                die;
            }
        }
    }

    public function delete($id_akun){
        $id_akun = htmlspecialchars($_GET['id_akun']) ? htmlentities($_GET['id_akun']) : strip_tags($_GET['id_akun']);
        $table = "users";
        $select = $this->db->query("SELECT * FROM $table WHERE id_akun = '$id_akun'");
        $array = mysqli_fetch_array($select);
        $foto = $array["foto"];

        if($array["foto"] == ""){
            $delete = "DELETE FROM $table WHERE id_akun = '$id_akun'";
            $data = $this->db->query($delete);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/hedaer.php?page=karyawan'</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/hedaer.php?page=karyawan'</script>";
                die;
            }
        }else{
            unlink("../../../../../assets/image/$foto");
            $data = $this->db->query("DELETE FROM $table WHERE id_akun = '$id_akun'");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/hedaer.php?page=karyawan'</script>";
                    die;
                    }
            }else{
                echo "<script>document.location.href = '../ui/hedaer.php?page=karyawan'</script>";
                die;                
            }            
        }
    }

    public function Login($userInput, $password){
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        password_verify($password, PASSWORD_DEFAULT);

        if($userInput == "" || $password == ""){
            echo "<script>document.location.href = '../auth/index.php'</script>";
            die;
        }

        $table = "users";
        $sql = "SELECT * FROM $table WHERE username = '$userInput' and password = '$password' || email = '$userInput' and password = '$password'";
        $data = $this->db->query($sql);
        $cek = mysqli_num_rows($data);

        if($cek > 0){
            $response = array($userInput, $password);
            $response[$table] = array($userInput, $password);
            if($row = mysqli_fetch_assoc($data)){
                if($row['role'] == "superadmin"){
                    $_SESSION['status'] = true;
                    $_SERVER['HTTPS'] = "on";
                    // SESSION DataBase
                    $_SESSION['id'] = $row['id_akun'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['foto'] = $row['foto'];
                    $_SESSION['role'] = "superadmin";
                    echo "<script>document.location.href = '../page/ui/header.php?page=beranda'</script>";
                }elseif($row['role'] == "admin"){
                    $_SESSION['status'] = true;
                    $_SERVER['HTTPS'] = "on";
                    // SESSION DataBase
                    $_SESSION['id'] = $row['id_akun'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['foto'] = $row['foto'];
                    $_SESSION['role'] = "admin";
                    echo "<script>document.location.href = '../page/ui/header.php?page=beranda'</script>";
                }
                $_COOKIE['cookies'] = $userInput;
                setcookie($response[$table], $row[$userInput], time() + (86400*30), "/");
                array_push($response['users'], $row);
                exit;
            }
        }else{
            $_SESSION['status'] = false;
            $_SERVER['HTTPS'] = "off";
            echo "<script>document.location.href = '../auth/index.php?info=gagal';</script>";
            exit;
        }
    }
}

?>