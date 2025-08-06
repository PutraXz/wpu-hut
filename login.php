<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Login Page</title>
</head>

<body>
    <div class="container-fluid p-0" style="max-width: 100% !important;">
        <div class="container-fluid d-flex align-items-center justify-content-center min-vh-100"
            style="background: #3B376B ;">
            <div class="card shadow-lg border-0 rounded-4 p-4" style="width: 100%; max-width: 450px; background: #fff;">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Welcome back!</h2>
                </div>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="username" class="form-control" name="username" required
                            autocomplete="username" autofocus placeholder="Masukkan Username Anda">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required
                            autocomplete="current-password" placeholder="Masukkkan Password Anda">
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg rounded-pill text-center"
                            style="background-color:#3B376B;border-color: #3B376B; ">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
if (isset($_POST['submit'])) {
    @$username = mysqli_real_escape_string($conn, $_POST['username']);
    @$password = $_POST['password'];

    $sql = "select * from user where username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['id_user'] = $row['id'];
        $_SESSION['level'] = $row['level'];
        if ($row['level'] == 'admin') {
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        echo '
            <script type="text/javascript">
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Username atau Password anda salah!!!!"
                });
            </script>
        ';
    }


}

?>