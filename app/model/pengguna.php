<?php 
namespace model;

class pengguna {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function SignIn($userInput, $password){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        password_verify($password, PASSWORD_DEFAULT);

        if($userInput == "" || $password == ""){
            echo "<script>document.location.href = '../auth/index.php'</script>";
            die;
        }

        $table = "pengguna";
        $sql = "SELECT * FROM $table WHERE username= '$userInput'  and password='$password' || email = '$userInput' and password = '$password'";
        $data = $this->db->query($sql);
        $cek = mysqli_num_rows($data);

        if($cek > 0){
            $response = array($userInput, $password);
            $response[$table] = $response;
            if($row = $data->fetch_assoc()){
                if($row['role'] == "pengguna"){
                    $_SESSION['status'] = true;
                    $_SERVER['HTTPS'] = "on";
                    // SESSION DataBase
                    $_SESSION['id'] = $row['id_pengguna'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['foto'] = $row['foto'];
                    $_SESSION['role'] = "pengguna";
                    echo "<script>document.location.href = '../page/ui/header.php?page=beranda';</script>";
                }
                $_COOKIE['cookies'] = $userInput;
                setcookie($response[$table], $row, time() + (86400 * 30), "/");
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

    public function create($username, $email, $nama, $password, $repassword){
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $repassword = md5(htmlspecialchars($_POST['password']), false);
        $role = "pengguna";
        $photo_src = "user_logo.png";

        if($password != $repassword){
            echo "<script>document.location.href = '../auth/register.php?info=passconfirm';</script>";
            die;
        }

        // DataBase
        $table = "pengguna";
        $select = $this->db->query("SELECT * FROM $table WHERE username = '$username' and email = '$email'");
        $select = mysqli_num_rows($select);
        $response['pengguna'] = array($username,$email,$nama,$password,$repassword, 'role' => $_POST['role'], 'foto' => $_FILES['foto']['name']);
        
        if($select){
            echo "<script>document.location.href = '../auth/register.php?info=gagal';</script>";
            die;
        }else{
            $insert = "INSERT INTO $table SET username = '$username', email = '$email', nama = '$nama', password = '$password', repassword = '$repassword', role = '$role', foto = '$photo_src'";
            $data = $this->db->query($insert);
            array_push($response['pengguna'], $response);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../auth/register.php?info=berhasil';</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../auth/register.php?info=gagal';</script>";
                die;
            }
        }
    }

    public function update($username, $email, $nama, $password, $repassword){
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $repassword = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : strip_tags($_POST['role']);
        # code ... Foto Karyawan
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif'); 
        $photo_src = htmlentities($_FILES["foto"]["name"]) ? htmlspecialchars($_FILES["foto"]["name"]) : "user_logo.png";
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['foto']['size'];
        $file_tmp_photo_src = $_FILES['foto']['tmp_name'];

        if(in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true){
            if($ukuran_photo_src < 10440070){
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/image/" . $photo_src);
            }else{
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;                
            }
        }else{
            echo "Tidak Dapat Ter - Upload Gambar";
            exit;
        }

        $table = "pengguna";
        $select = $this->db->query("SELECT * FROM $table WHERE id_pengguna = '$_POST[id_pengguna]'");
        $cekselect = mysqli_fetch_array($select);

        if(isset($_POST['ubahfoto'])){
            if($cekselect['foto'] == ""){
                $update = "UPDATE $table SET username = '$username', email = '$email', nama = '$nama', password = '$password',
                 repassword = '$repassword', role = '$role', foto = '$photo_src' WHERE id_pengguna = '$_POST[id_pengguna]'";
                $data = $this->db->query($update);
                if($data != null){
                    if($data){
                        echo "<script>document.location.href = '../ui/header.php?aksi=ubah-profile&id=$_GET[id_pengguna]&info=ubahdata'</script>";
                        die;
                    }
                }else{
                    echo "<script>document.location.href = '../ui/header.php?aksi=ubah-profile&id=$_GET[id_pengguna]&info=gagal'</script>";
                    die;
                }
            }elseif($cekselect['foto'] != ""){
                if($photo_src != ""){
                    $updated = "UPDATE $table SET username = '$username', email = '$email', nama = '$nama', password = '$password',
                     repassword = '$repassword', role = '$role', foto = '$photo_src' WHERE id_pengguna = '$_POST[id_pengguna]'";
                    $data = $this->db->query($updated);
                    unlink("../../../../assets/image/$cekselect[foto]");
                    if($data != null){
                        if($data){
                            echo "<script>document.location.href = '../ui/header.php?aksi=ubah-profile&id=$_GET[id_pengguna]&info=ubahdata'</script>";
                            die;
                        }
                    }else{
                        echo "<script>document.location.href = '../ui/header.php?aksi=ubah-profile&id=$_GET[id_pengguna]&info=gagal'</script>";
                        die;
                    }
                }
            }
        }
    }
}

?>