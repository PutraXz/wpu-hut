<?php
header('Content-Type: application/json; charset=utf8');
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "select * from menu";
    $query = mysqli_query($koneksi, $sql);
    $array_data = array();
    while ($data = mysqli_fetch_assoc($query)) {
        $array_data[] = $data;
    }
    echo json_encode($array_data);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $kategori = $_POST['kategori'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $nama_foto = $_POST['gambar'];

    $sql = "INSERT INTO menu (kategori, nama, deskripsi, harga, gambar) 
            VALUES ('$kategori','$nama', '$deskripsi', '$harga', '$nama_foto')";

    $cek = mysqli_query($koneksi, $sql);
    if ($cek) {
        echo json_encode(['status' => 'berhasil']);
    } else {
        echo json_encode(['status' => 'gagal', 'error' => mysqli_error($koneksi)]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $put_vars);

    $id = $put_vars['id_menu'];
    $kategori = $put_vars['kategori'];
    $nama = $put_vars['nama'];
    $deskripsi = $put_vars['deskripsi'];
    $harga = $put_vars['harga'];
    $nama_foto = $put_vars['gambar'];
    $sql = "UPDATE menu SET kategori='$kategori', nama='$nama', deskripsi='$deskripsi',harga='$harga', gambar='$nama_foto' WHERE id_menu='$id'";
    $cek = mysqli_query($koneksi, $sql);
    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode([$data]);
    } else {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode([$data]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id_menu'];
    $sql = "DELETE FROM menu WHERE id_menu='$id'";
    $cek = mysqli_query($koneksi, $sql);
    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode([$data]);
    } else {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode([$data]);
    }
}