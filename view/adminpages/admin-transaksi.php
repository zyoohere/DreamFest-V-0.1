<?php

include '../../auth/koneksi.php';


session_start();

if (isset($_POST['update_transaksi'])) {

  $transaksi_update_id = $_POST['id_order'];
  $update_pembayaran = $_POST['update_pembayaran'];
  mysqli_query($con, "UPDATE `transaksi` SET status_pembayaran = '$update_pembayran' WHERE id_transaksi = '$transaksi_update_id'") or die('query gagal');
  $message[] = 'payment status has been updated!';
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($con, "DELETE FROM `transaksi` WHERE id_transaksi = '$delete_id'") or die('query gagal');
  header('location:admin-transaksi.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaksi Users</title>

  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
  <?php include('admin-header.php') ?>

  <h1 class="text-center fs-3 fw-bold">TRANSAKSI</h1>
  <section>
    <div class="row justify-content-items">
      <div class="shadow m-5">
        <?php
        $select_transaksi = mysqli_query($con, "SELECT * FROM `transaksi`") or die('query gagal');
        if (mysqli_num_rows($select_transaksi) > 0) {
          while ($fetch_transaksi = mysqli_fetch_assoc($select_transaksi)) {
        ?>
            <div class="box">
              <p> user id : <span><?php echo $fetch_transaksi['id_user']; ?></span> </p>
              <p> Tanggal: <span><?php echo $fetch_transaksi['tgl_transaksi']; ?></span> </p>
              <p> name : <span><?php echo $fetch_transaksi['nama']; ?></span> </p>
              <p> number : <span><?php echo $fetch_transaksi['no_tlpn']; ?></span> </p>
              <p> email : <span><?php echo $fetch_transaksi['email']; ?></span> </p>
              <p> address : <span><?php echo $fetch_transaksi['alamat']; ?></span> </p>
              <p> total products : <span><?php echo $fetch_transaksi['total_events']; ?></span> </p>
              <p> total price : <span>Rp <?php echo $fetch_transaksi['total_harga']; ?>/-</span> </p>
              <p> payment method : <span><?php echo $fetch_transaksi['metode_pembayaran']; ?></span> </p>
              <form action="" method="post">
                <input type="hidden" name="id_transaksi" value="<?php echo $fetch_transaksi['id_transaksi']; ?>">
                <select name="update_payment">
                  <option value="" selected disabled><?php echo $fetch_transaksi['status_pembayaran']; ?></option>
                  <option value="pending">pending</option>
                  <option value="completed">completed</option>
                </select>
                <input type="submit" value="update" name="update_transaksi" class="option-btn">
                <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
              </form>
            </div>
        <?php
          }
        } else {
          echo '<p class="empty">Belum Ada Transaksi!</p>';
        }
        ?>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>