<?php

include '../../auth/koneksi.php';

session_start();


if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($con, "DELETE FROM `rate_view` WHERE id_rate = '$delete_id'") or die('query gagal');
  header('location:admin-message.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Message Users</title>

  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
  <?php include('admin-header.php') ?>

  <h1 class="text-center">Message</h1>
  <section>
    <div class="row justify-content-center">
      <div class="shadow">
        <?php
        $select_message = mysqli_query($con, "SELECT * FROM `rate_view`") or die('query failed');
        if (mysqli_num_rows($select_message) > 0) {
          while ($fetch_message = mysqli_fetch_assoc($select_message)) {

        ?>
            <div class="box">
              <p> user id : <span><?php echo $fetch_message['id_user']; ?></span> </p>
              <p> name : <span><?php echo $fetch_message['nama']; ?></span> </p>
              <p> number : <span><?php echo $fetch_message['no_tlpn']; ?></span> </p>
              <p> email : <span><?php echo $fetch_message['email']; ?></span> </p>
              <p> message : <span><?php echo $fetch_message['komentar']; ?></span> </p>
              <a href="admin-message.php?delete=<?php echo $fetch_message['id_rate']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
            </div>
        <?php
          };
        } else {
          echo '<p class="empty">Kamu belum ada pesan dari costumer!</p>';
        }
        ?>

      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>