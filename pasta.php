<?php
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
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
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
    <div class="container mt-3">
        <h1 class="mb-4">Pasta</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            <?php foreach ($menu as $row): 
                if($row['kategori'] == 'pasta'){
            ?>
            <div class="col">
                <div class="card h-100">
                    <img src="./img/pizza/<?= $row["gambar"]; ?>" class="card-img-top menu-img"
                        alt="<?= $row['nama']; ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $row['nama']; ?></h5>
                        <p class="card-text flex-grow-1"><?= $row['deskripsi']; ?></p>
                        <h5><?= $row['harga']; ?></h5>
                        <a href="#" class="btn btn-primary mt-2">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <?php } endforeach ?>
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

</body>

</html>