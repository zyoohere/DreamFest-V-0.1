<?php

include '../auth/koneksi.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pemesanan | DreamFest</title>

   <!-- CDN -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
   <?php include('./header-footer/header.php') ?>

   <section class="container-lg border border-3">
      <div class="d-flex justify-content-center">
         <?php
         $trns_query = mysqli_query($con, "SELECT * FROM `transaksi` WHERE id_user = '$id_user'") or die('query gagal;');
         if (mysqli_num_rows($trns_query) > 0) {
            while ($fetch_trns = mysqli_fetch_assoc($trns_query)) {
         ?>
               <div class="form-control">
                  <p> placed on : <span><?php echo $fetch_trns['tgl_transaksi']; ?></span> </p>
                  <p> name : <span><?php echo $fetch_trns['nama']; ?></span> </p>
                  <p> number : <span><?php echo $fetch_trns['no_tlpn']; ?></span> </p>
                  <p> email : <span><?php echo $fetch_trns['email']; ?></span> </p>
                  <p> address : <span><?php echo $fetch_trns['alamat']; ?></span> </p>
                  <p> payment method : <span><?php echo $fetch_trns['metode_pembayaran']; ?></span> </p>
                  <p> your orders : <span><?php echo $fetch_trns['total_events']; ?></span> </p>
                  <p> total price : <span>Rp<?php echo $fetch_trns['total_harga']; ?>/-</span> </p>
                  <p> payment status : <span style="color:<?php if ($fetch_trns['status_pembayaran'] == 'pending') {
                                                               echo 'red';
                                                            } else {
                                                               echo 'green';
                                                            } ?>;"><?php echo $fetch_trns['status_pembayaran']; ?></span> </p>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>
      </div>
   </section>


   <?php include('./header-footer/footer.php') ?>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>