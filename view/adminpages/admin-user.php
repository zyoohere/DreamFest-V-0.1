<?php

include '../../auth/koneksi.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Panel</title>

  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
  <?php include('admin-header.php') ?>

  <h1 class="text-center">USER PANEL</h1>

  <section>
    <div class="row">
      <div class="box-container">
        <?php
        $select_users = mysqli_query($con, "SELECT * FROM `user`") or die('query gagal');
        while ($fetch_users = mysqli_fetch_assoc($select_users)) {
        ?>
          <div class="box">
            <p> USER ID : <span><?php echo $fetch_users['id_user']; ?></span> </p>
            <p> Nama : <span><?php echo $fetch_users['nama']; ?></span> </p>
            <p> password : <span><?php echo $fetch_users['password']; ?></span> </p>
            <p> Jenis Kelamin : <span><?php echo $fetch_users['jenis_kelamin']; ?></span> </p>
            <p> No Telepon : <span><?php echo $fetch_users['no_tlpn']; ?></span> </p>
            <p> Email : <span><?php echo $fetch_users['email']; ?></span> </p>
            <p> Type User : <span style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                                                  echo 'color:blue;';
                                                } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
            <a href="admin-user.php?delete=<?php echo $fetch_users['id_user']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">Hapus</a>
          </div>
        <?php
        };
        ?>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>