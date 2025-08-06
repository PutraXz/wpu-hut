<?php
if (!isset($_POST['id_menu'], $_POST['harga'], $_POST['nama'])) {
    http_response_code(400);
    echo "ERROR: Data tidak lengkap";
    exit();
}

require_once 'midtrans_config.php';
session_start();
include 'koneksi.php';

$id_menu = $_POST['id_menu'];
$harga = intval($_POST['harga']);
$nama_menu = $_POST['nama'];
$user_id = $_SESSION['id_user'];

$order_id = "ORDER-" . time();
$params = [
    'transaction_details' => [
        'order_id' => $order_id,
        'gross_amount' => $harga,
    ],
    'item_details' => [
        [
            'id' => $id_menu,
            'price' => $harga,
            'quantity' => 1,
            'name' => $nama_menu,
        ]
    ],
    'customer_details' => [
        'first_name' => 'User',
        'email' => 'user@example.com'
    ]
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    $conn->query("INSERT INTO transaksi (user_id, id_menu, status, jumlah_harga, transaction_id)
        VALUES ('$user_id', '$id_menu', 'pending', '$harga', '$order_id')");

    echo $snapToken;
} catch (Exception $e) {
    http_response_code(500);
    echo "ERROR: " . $e->getMessage();
}