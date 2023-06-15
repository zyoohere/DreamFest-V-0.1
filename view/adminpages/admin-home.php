<?php

include '../../auth/koneksi.php';

session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>

  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
  <?php include('admin-header.php') ?>

  <h1 class="text-center m-5">D A S H B O A R D</h1>
  <section class="container text-center px-4">
    <div class="row g-3 p-4 m-5 justify-content-center align-items-center">
      <div class="col-5 shadow p-3 m-2 rounded border border-secondary p-2 mb-2 border-opacity-75  ">
        <?php
        $total_pendings = 0;
        $select_pending = mysqli_query($con, "SELECT total_harga FROM `transaksi` WHERE status_pembayaran = 'pending'") or die('query failed');
        if (mysqli_num_rows($select_pending) > 0) {
          while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
            $total_harga = $fetch_pendings['total_harga'];
            $total_pendings += $total_harga;
          };
        };
        ?>
        <h3>Rp <?php echo $total_pendings; ?> /-</h3>
        <p>Total Pendings</p>

      </div>
      <div class="col-5 shadow p-3 m-2 rounded border border-secondary p-2 mb-2 border-opacity-75 ">
        <?php
        $total_berhasil = 0;
        $select_berhasil = mysqli_query($con, "SELECT total_harga FROM `transaksi` WHERE status_pembayaran = 'berhasil'") or die('query failed');
        if (mysqli_num_rows($select_berhasil) > 0) {
          while ($fetch_berhasil = mysqli_fetch_assoc($select_berhasil)) {
            $total_harga = $fetch_berhasil['total_harga'];
            $total_berhasil += $total_harga;
          };
        };
        ?>
        <h3>Rp <?php echo $total_berhasil; ?> /-</h3>
        <p>Pembayaran Berhasil </p>
      </div>
      <div class="col-5 shadow p-3 m-2 rounded border border-secondary p-2 mb-2 border-opacity-75 ">
        <?php
        $select_transaksi = mysqli_query($con, "SELECT * FROM `transaksi`") or die('query failed');
        $number_of_transaksi = mysqli_num_rows($select_transaksi);
        ?>
        <h3><?php echo $number_of_transaksi; ?></h3>
        <p>Pesanan Ditempatkan</p>
      </div>

      <div class="col-5 shadow p-3 m-2 rounded border border-secondary p-2 mb-2 border-opacity-75 ">
        <?php
        $select_events = mysqli_query($con, "SELECT * FROM `events`") or die('query failed');
        $number_of_events = mysqli_num_rows($select_events);
        ?>
        <h3><?php echo $number_of_events; ?></h3>
        <p>Events Ditambahkan</p>
      </div>
      <div class="col-5 shadow p-3 m-2 rounded border border-secondary p-2 mb-2 border-opacity-75 ">
        <?php
        $select_users = mysqli_query($con, "SELECT * FROM `user` WHERE user_type = 'costumer'") or die('query failed');
        $number_of_users = mysqli_num_rows($select_users);
        ?>
        <h3><?php echo $number_of_users; ?></h3>
        <p>USER COSTUMER</p>
      </div>

      <div class="col-5 shadow p-3 m-2 rounded border border-secondary p-2 mb-2 border-opacity-75 ">
        <?php
        $select_admins = mysqli_query($con, "SELECT * FROM `user` WHERE user_type = 'admin'") or die('query failed');
        $number_of_admins = mysqli_num_rows($select_admins);
        ?>
        <h3><?php echo $number_of_admins; ?></h3>
        <p>USER ADMIN</p>
      </div>

      <div class="col-5 shadow p-3 m-2 rounded border border-secondary p-2 mb-2 border-opacity-75 ">
        <?php
        $select_account = mysqli_query($con, "SELECT * FROM `user`") or die('query gagal');
        $number_of_account = mysqli_num_rows($select_account);
        ?>
        <h3><?php echo $number_of_account; ?></h3>
        <p>Total Account</p>
      </div>

      <div class="col-5 shadow p-3 m-2 rounded border border-secondary p-2 mb-2 border-opacity-75 ">
        <?php
        $select_messages = mysqli_query($con, "SELECT * FROM `rate_view`") or die('query failed');
        $number_of_messages = mysqli_num_rows($select_messages);
        ?>
        <h3><?php echo $number_of_messages; ?></h3>
        <p>Komentar Baru</p>
      </div>

    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>