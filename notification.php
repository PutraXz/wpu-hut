<?php
require_once 'midtrans_config.php';
include 'koneksi.php';

// Terima JSON notifikasi dari Midtrans
$notif = json_decode(file_get_contents("php://input"));

if (!$notif) {
    http_response_code(400);
    exit("Invalid notification");
}

// Ambil data penting dari notifikasi
$transaction_id = $notif->order_id;
$transaction_status = $notif->transaction_status;
$status_message = $notif->status_message ?? '';
$payment_code = '';
$pdf_url = '';

// Handle payment code & pdf url tergantung tipe pembayaran
if (isset($notif->va_numbers)) {
    $payment_code = $notif->va_numbers[0]->va_number;
} elseif (isset($notif->bill_key)) {
    $payment_code = $notif->bill_key;
}

if (isset($notif->pdf_url)) {
    $pdf_url = $notif->pdf_url;
}

// Update ke database
$status = $transaction_status === 'settlement' || $transaction_status === 'capture' ? 'success' : $transaction_status;

$sql = "UPDATE transaksi 
        SET status = '$status',
            status_message = '$status_message',
            payment_code = '$payment_code',
            pdf_url = '$pdf_url'
        WHERE transaction_id = '$transaction_id'";

$conn->query($sql);

// Kirim response ke Midtrans
http_response_code(200);
echo "Notification handled";
?>