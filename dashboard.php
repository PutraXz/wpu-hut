<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("Location: index.php");
    exit();
}


;
$data = file_get_contents('http://localhost/source-code-rest-api/api.php');
$menu = json_decode($data, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container-scroller">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid page-body-wrapper">
            <?php include 'sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Data Menu </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <button type="button" class="btn btn-info btn-fw" data-bs-toggle="modal"
                                        data-bs-target="#add-menu">Add Data</button>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mt-3">
                                            <thead>
                                                <tr>
                                                    <th> No </th>
                                                    <th> Nama</th>
                                                    <th> Kategori </th>
                                                    <th> Deskripsi </th>
                                                    <th> Harga </th>
                                                    <th> Gambar </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($menu as $row): ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['nama'] ?></td>
                                                        <td><?= $row['kategori'] ?></td>
                                                        <td><?= $row['deskripsi'] ?></td>
                                                        <td><?= $row['harga'] ?></td>
                                                        <td><img src="./img/pizza/<?= $row["gambar"]; ?>" alt=""></td>
                                                        <td>
                                                            <div class="modal fade" id="edit-<?= $row['id_menu'] ?>"
                                                                tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="post" action="dashboard.php"
                                                                            enctype="multipart/form-data">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Edit Data Menu</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="id_menu"
                                                                                    value="<?= $row['id_menu'] ?>">
                                                                                <input type="hidden" name="gambar_lama"
                                                                                    value="<?= $row['gambar'] ?>">

                                                                                <div class="mb-3">
                                                                                    <label for="nama">Nama</label>
                                                                                    <input type="text" class="form-control"
                                                                                        name="nama"
                                                                                        value="<?= $row['nama'] ?>"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="kategori">Kategori</label>
                                                                                    <input type="text" class="form-control"
                                                                                        name="kategori"
                                                                                        value="<?= $row['kategori'] ?>"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="deskripsi">Deskripsi</label>
                                                                                    <input type="text" class="form-control"
                                                                                        name="deskripsi"
                                                                                        value="<?= $row['deskripsi'] ?>"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="harga">Harga</label>
                                                                                    <input type="number"
                                                                                        class="form-control" name="harga"
                                                                                        value="<?= $row['harga'] ?>"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="gambar">Gambar
                                                                                        Lama</label><br>
                                                                                    <img src="./img/pizza/<?= $row["gambar"]; ?>"
                                                                                        width="120" height="120"
                                                                                        alt=""><br><br>
                                                                                    <label for="gambar">Ganti Gambar
                                                                                        (Opsional)</label>
                                                                                    <input type="file" class="form-control"
                                                                                        name="gambar">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" name="edit"
                                                                                    class="btn btn-primary">Simpan
                                                                                    Perubahan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <a href="#" class="btn btn-sm btn-warning"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit-<?= $row['id_menu'] ?>">Edit</a>
                                                            <a href="dashboard.php?page=hapus&id_menu=<?= $row['id_menu'] ?>"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-menu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="dashboard.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" name="kategori" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar">Foto</label>
                            <input type="file" class="form-control" name="gambar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="menu" class="btn btn-info">Add
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>

</body>

</html>

<?php
$page = @$_GET['page'];
if ($page == 'hapus') {
    $id_menu = $_GET['id_menu'];
    $url = 'http://localhost/source-code-rest-api/api.php?id_menu=' . $id_menu;
    $opts = array(
        'http' =>
            array(
                'method' => 'DELETE',
                'header' => 'Content-type: application/x-www-form-urlencoded'
            )
    );

    $context = stream_context_create($opts);

    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        echo '
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Gagal Menghapus Menu"
                });
            </script>';
    } else {
        echo '
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Data Menu berhasil Dihapus"
                    }).then(() => window.location.href = "dashboard.php");
                </script>';
    }
}
;
if (isset($_POST['edit'])) {
    $id_menu = $_POST['id_menu'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $foto_tmp = $_FILES['gambar']['tmp_name'];
        $nama_foto = $_FILES['gambar']['name'];
        move_uploaded_file($foto_tmp, 'img_api/' . $nama_foto);
    } else {
        $nama_foto = $_POST['gambar_lama'];
    }
    $data = http_build_query([
        'id_menu' => $id_menu,
        'nama' => $nama,
        'kategori' => $kategori,
        'deskripsi' => $deskripsi,
        'harga' => $harga,
        'gambar' => $nama_foto
    ]);

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded",
            'method' => 'PUT',
            'content' => $data,
        ]
    ];

    $context = stream_context_create($options);
    $url = 'http://localhost/source-code-rest-api/api.php';
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        echo '
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Gagal Mengedit Menu"
                });
            </script>';
    } else {
        echo '
            <script>
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Data Menu berhasil diedit"
                }).then(() => window.location.href = "dashboard.php");
            </script>';
    }
}



if (isset($_POST['menu'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    $foto_tmp = $_FILES['gambar']['tmp_name'];
    $nama_foto = $_FILES['gambar']['name'];
    move_uploaded_file($foto_tmp, 'img_api/' . $nama_foto);
    $data = http_build_query([
        'nama' => $nama,
        'kategori' => $kategori,
        'deskripsi' => $deskripsi,
        'harga' => $harga,
        'gambar' => $nama_foto
    ]);
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded",
            'method' => 'POST',
            'content' => $data,
        ]
    ];

    $context = stream_context_create($options);
    $url = 'http://localhost/source-code-rest-api/api.php';
    $result = file_get_contents($url, false, $context);


    if ($result === FALSE) {
        echo '
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Gagal Menambahkan Menu"
                });
            </script>';
    } else {
        echo '
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Data Menu berhasil ditambahkan"
                    }).then(() => window.location.href = "dashboard.php");
                </script>';
    }
}
?>