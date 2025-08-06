<?php

session_start();
include 'koneksi.php';
$data = file_get_contents('http://localhost/source-code-rest-api/api.php');
$menu = json_decode($data, true);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizza Yuuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-giamupfJMz0g8ZOK">
    </script>
    <style>
    .card-img-top {
        object-fit: cover;
        height: 180px;
        width: 100%;
    }

    .card {
        width: 18rem;
        height: 30rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-text,
    .card-title,
    .card-body h5 {
        margin-bottom: 0.5rem;
    }
    </style>
</head>

<body>
    <?php include 'navbar_index.php'; ?>
    <div class="jumbotron">
        <div class="row p-0 me-0">

            <img src="assets/img/pizza_banner.png" class="img-fluid p-0" alt="">
        </div>
    </div>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 px-0">
                <div class="ms-5" style="overflow-x: auto;">
                    <h1>All Menu</h1>
                    <div class="owl-carousel owl-theme mt-5">
                        <?php foreach ($menu as $row): ?>
                        <div class="item">
                            <div class="card" style="width: 18rem; height:28rem">
                                <img src="./img/pizza/<?= $row["gambar"]; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['nama']; ?></h5>
                                    <p class="card-text"><?= $row['deskripsi']; ?></p>
                                    <h5><?= $row['harga']; ?></h5>
                                    <button type="button" class="btn bg-dark btn-fw text-light" data-bs-toggle="modal"
                                        data-bs-target="#menu-<?= $row['id_menu'] ?>">Pesan Sekarang</button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($menu as $row): ?>
    <div class="modal fade" id="menu-<?= $row['id_menu'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="index.php">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_menu" value="<?= $row['id_menu'] ?>">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img src="./img/pizza/<?= $row["gambar"]; ?>" class="img-fluid"
                                    style="max-height: 300px; object-fit: cover;" alt="<?= $row['nama'] ?>">
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Tambah Pesanan</h6>
                                <p class="bg-light px-2 py-1 d-inline-block rounded">Rp.
                                    <?= number_format($row['harga'], 0, ',', '.') ?>
                                </p>
                                <div class="my-2 d-flex gap-2">
                                    <button type="button" class="btn btn-light border">+</button>
                                    <button type="button" class="btn btn-light border">-</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <p style="font-size: 14px;"><?= $row['deskripsi'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="addPesanan" class="btn btn-primary w-100">Tambah Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach ?>

    <div class="modal fade" id="keranjang" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="checkout.php">
                    <div class="modal-header">
                        <h5 class="modal-title">Keranjang Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body bg-light">
                        <?php
                        $id_user = $_SESSION['id_user'];
                        $sql = $conn->query("SELECT *
                                FROM orders
                                INNER JOIN user ON orders.id_user = user.id
                                INNER JOIN menu on orders.id_menu = menu.id_menu where orders.id_user='$id_user'");
                        while ($item = $sql->fetch_array()) {
                            ?>
                        <div class="p-3 mb-3 bg-white rounded shadow-sm">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-3 text-center">
                                    <img src="./img/pizza/<?= $item['gambar'] ?>" class="img-fluid" alt="..."
                                        style="max-height: 80px; object-fit: cover;">
                                </div>
                                <div class="col-md-7 col-6">
                                    <h6 class="fw-bold"><?= $item['nama'] ?></h6>
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            onclick="ubahJumlah(<?= $item['id_menu'] ?>, 'kurang')">-</button>
                                        <input type="text" name="jumlah[<?= $item['id_menu'] ?>]"
                                            id="jumlah-<?= $item['id_menu'] ?>" value="<?= $item['jumlah'] ?>"
                                            class="form-control text-center" style="width: 50px;" readonly>
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            onclick="ubahJumlah(<?= $item['id_menu'] ?>, 'tambah')">+</button>
                                        <span class="ms-3 fw-bold">Rp. <span
                                                id="total-<?= $item['id_menu'] ?>"><?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></span></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-3 text-end">
                                    <button type="button" class="btn btn-secondary w-100 checkout-button"
                                        data-id="<?= $item['id_menu'] ?>" data-nama="<?= $item['nama'] ?>"
                                        data-harga="<?= $item['harga'] ?>">
                                        Checkout
                                    </button>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php include 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel();
    });

    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
    </script>
    <script>
    $('.checkout-button').click(function() {
        const id_menu = $(this).data('id');
        const nama = $(this).data('nama');
        const harga = $(this).data('harga');

        console.log({
            id_menu,
            nama,
            harga
        }); // ⬅️ log untuk debugging

        $.ajax({
            url: 'snap_token.php',
            method: 'POST',
            data: {
                id_menu: id_menu,
                nama: nama,
                harga: harga
            },
            success: function(response) {
                snap.pay(response, {
                    onSuccess: function(result) {
                        alert("Pembayaran sukses!");
                        location.reload();
                    },
                    onPending: function(result) {
                        alert("Menunggu pembayaran.");
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal.");
                    }
                });
            },
            error: function(xhr, status, error) {
                alert("Gagal mendapatkan Snap Token");
                console.log(xhr.responseText); // ⬅️ Tambahkan ini untuk melihat error detail
            }
        });
    });
    </script>

</body>

</html>

<?php
if (isset($_POST['addPesanan'])) {
    $id_menu = $_POST['id_menu'];
    $id_user = $_SESSION['id_user'];
    $q = $conn->query("select * from menu where id_menu='$id_menu'");
    $data = $q->fetch_assoc();
    $harga = $data['harga'];
    $jumlah = 2;
    $status = 0;
    $jumlah_harga = $harga * $jumlah;
    $sql = $conn->query("insert into orders (id_menu, id_user, jumlah, jumlah_harga, status) values ('$id_menu', '$id_user','$jumlah','$jumlah_harga', '$status')");
    if ($sql) {
        echo 'berhasil';
    } else {
        echo 'gagal \n';
        var_dump($sql);
    }

}
?>