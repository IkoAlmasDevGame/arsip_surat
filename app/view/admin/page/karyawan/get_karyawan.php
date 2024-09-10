<?php 
require_once("../../../../database/koneksi.php");
$table = "users";
$cache_file = 'api_karyawan.json';
$result = $config->prepare("SELECT * FROM users WHERE role = 'admin'");
$result->execute();
$data = $result->fetchAll(PDO::FETCH_ASSOC);
$json_data = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents($cache_file, $json_data, FILE_USE_INCLUDE_PATH);
file_get_contents($cache_file);
echo $json_data;
?>