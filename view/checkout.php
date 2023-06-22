<?php

include '../auth/koneksi.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:../auth/login.php');
}


if (isset($_POST['order_btn'])) {

$nama = mysqli_real_escape_string($con, $_POST['nama']);
$no_tlpn = $_POST['no_tlpn'];
$email = mysqli_real_escape_string($con, $_POST['email']);
$method = mysqli_real_escape_string($con, $_POST['method']);
$address = mysqli_real_escape_string($con, $_POST['alamat']);
$tgl_transaksi = date('d-M-Y');

$cart_total = 0;
$cart_events[] = '';

$cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE id_user = '$user_id'") or die('query gagal');
if (mysqli_num_rows($cart_query) > 0) {
while ($cart_item = mysqli_fetch_assoc($cart_query)) {
$cart_events[] = $cart_item['nama'] . ' (' . $cart_item['jumlah_events'] . ') ';
$sub_total = ($cart_item['harga_events'] * $cart_item['jumlah_events']);
$cart_total += $sub_total;
}
}

$total_events = implode(', ', $cart_events);

$order_query = mysqli_query($con, "SELECT * FROM `transaksi` WHERE nama = '$nama' AND no_tlpn = '$no_tlpn' AND email = '$email' AND metode_pembayaran = '$method' AND alamat = '$address' AND total_events = '$total_events' AND total_harga = '$cart_total'") or die('query gagal');

if ($cart_total == 0) {
$message[] = 'Cart kamu kosong';
} else {
if (mysqli_num_rows($order_query) > 0) {
$message[] = 'Transaksi kamu berhasil';
} else {
mysqli_query($con, "INSERT INTO `transaksi`(id_user, nama, no_tlpn, email, metode_pembayaran, alamat, total_events, total_harga, tgl_transaksi) VALUES('$user_id', '$nama', '$no_tlpn', '$email', '$method', '$address', '$total_events', '$cart_total', '$tgl_transaksi')") or die('query gagal');
$message[] = 'transaksi sudah berhasil!';
mysqli_query($con, "DELETE FROM `cart` WHERE id_user = '$user_id'") or die('query gagal');
}
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | DreamFest</title>

  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
  <?php include('../view/header-footer/header.php') ?>
  <section class="shadow rounded m-5">
    <h2 class="text-center fs-4 m-4 p-3 fw-medium">Let's Go Checkout</h2>
    <div class=" d-flex justify-content-center ">
      <ol class=" breadcrumb ">
        <li class="breadcrumb-item "><a href="home.php" class="text-decoration-none fw-light fs-6" style="color: #19376d;">Home</a></li>
        <li class="breadcrumb-item active text-decoration-none fw-ligy fs-6" aria-current="page">Checkout</li>
      </ol>
    </div>
  </section>

  </div>
  <section class="d-flex align-items-center">

    <?php
    $grand_total = 0;
    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE id_user = '$user_id'") or die('query gagal');
    if (mysqli_num_rows($select_cart) > 0) {
      while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $total_harga = ($fetch_cart['harga_events'] * $fetch_cart['jumlah_events']);
        $grand_total += $total_harga;
    ?>
        <p> <?php echo $fetch_cart['nama']; ?> <span>(<?php echo 'Rp' . $fetch_cart['harga_events'] . '/-' . ' x ' . $fetch_cart['jumlah_events']; ?>)</span> </p>
    <?php
      }
    } else {
      echo '<p class="empty">your cart is empty</p>';
    }
    ?>
    <div class="grand-total"> grand total : <span>Rp <?php echo $grand_total; ?>/-</span> </div>

  </section>

  <section class="d-flex justify-content-center">

    <form action="" method="post" class=" p-5 shadow rounded">
      <h3 class="text-center fs-2 p-3">Isi Data Identitas</h3>
      <div class="flex">
        <div class="">
          <span>Nama</span>
          <input type="text" name="nama" required placeholder="enter your name" class="form-control">
        </div>
        <div class="inputBox">
          <span>Email</span>
          <input type="email" name="email" required placeholder="enter your email" class="form-control">
        </div>
        <div class="inputBox">
          <span>Nomor Telepon</span>
          <input type="number" name="no_tlpn" required placeholder="enter your number" class="form-control">
        </div>
        <div class="inputBox">
          <span>Metode Pembayaran</span>
          <select name="method" class="form-control">
            <option value="cash on delivery">Transfer Bank</option>
            <option value="credit card">Credit Card</option>
            <option value="paypal">E-Wallet</option>
          </select>
        </div>
        <div class="inputBox">
          <span>Alamat</span>
          <input type="text" min="0" name="alamat" required placeholder="Alamat Lengkap" class="form-control">
        </div>


        <div class="inputBox">
          <span>Kode Pos</span>
          <input type="number" min="0" name="kode_pos" required placeholder=",,, 25021" class="form-control">
        </div>
      </div>
      <input type="submit" value="order now" class="btn btn-outline-dark form-control" name="order_btn">
    </form>

  </section>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>