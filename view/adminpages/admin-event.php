<?php

include '../../auth/koneksi.php';

session_start();

if (isset($_POST['add_product'])) {

  $nama = mysqli_real_escape_string($con, $_POST['nama_events']);
  $harga = $_POST['harga_events'];
  $image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = 'uploaded_img/' . $image;

  $select_product_name = mysqli_query($con, "SELECT nama_events FROM `events` WHERE nama_events = '$nama'") or die('query failed');

  if (mysqli_num_rows($select_product_name) > 0) {
    $message[] = 'Nama Events Berhasil Ditambahkan';
  } else {
    $add_event_query = mysqli_query($con, "INSERT INTO `events`(nama_events, harga_events, image) VALUES('$nama', '$harga', '$image')") or die('query failed');

    if ($add_event_query) {
      if ($image_size > 2000000) {
        $message[] = 'Gambar Terlalu Besar';
      } else {
        move_uploaded_file($image_tmp_name, $image_folder);
        $message[] = 'Event Berhasil Ditambahkan!';
      }
    } else {
      $message[] = 'Events Belum Bisa Ditambahkan!';
    }
  }
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $delete_image_query = mysqli_query($con, "SELECT image FROM `events` WHERE id_events = '$delete_id'") or die('query gagal');
  $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
  unlink('uploaded_img/' . $fetch_delete_image['image']);
  mysqli_query($con, "DELETE FROM `events` WHERE id_events = '$delete_id'") or die('query gagal');
  header('location:admin-events.php');
}

if (isset($_POST['update_events'])) {

  $update_p_id = $_POST['update_p_id'];
  $update_nama = $_POST['update_nama'];
  $update_harga = $_POST['update_harga'];

  mysqli_query($con, "UPDATE `events` SET nama = '$update_nama', harga_events = '$update_harga' WHERE id_events = '$update_p_id'") or die('query gagal');

  $update_image = $_FILES['update_image']['nama_events'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_size = $_FILES['update_image']['size'];
  $update_folder = 'uploaded_img/' . $update_image;
  $update_old_image = $_POST['update_old_image'];

  if (!empty($update_image)) {
    if ($update_image_size > 2000000) {
      $message[] = 'image file size is too large';
    } else {
      mysqli_query($con, "UPDATE `events` SET image = '$update_image' WHERE id_events = '$update_p_id'") or die('query gagal');
      move_uploaded_file($update_image_tmp_name, $update_folder);
      unlink('uploaded_img/' . $update_old_image);
    }
  }

  header('location:admin-events.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events </title>

  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
  <?php include('admin-header.php') ?>

  <h1 class="text-center">Tampilan Events</h1>

  <section class="container-fluid">
    <div class="row justify-content-center">
      <div class="shadow p-3 m-3 rounded">
        <form action="" method="post" enctype="multipart/form-data">
          <h3>Tambah Event</h3>
          <input type="text" name="nama_events" class="box" placeholder="Masukan Nama Events" required>
          <input type="number" min="0" name="harga_events" class="box" placeholder="Masukan Harga Events" required>
          <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
          <input type="submit" value="add product" name="add_product" class="btn">
        </form>
      </div>
      <div class="shadow p-3 m-3 rounded">

        <?php
        $select_events = mysqli_query($con, "SELECT * FROM `events`") or die('query gagal');
        if (mysqli_num_rows($select_events) > 0) {
          while ($fetch_events = mysqli_fetch_assoc($select_events)) {
        ?>
            <div class="box">
              <img src="uploaded_img/<?php echo $fetch_events['image']; ?>" alt="">
              <div class="nama_events"><?php echo $fetch_events['nama_events']; ?></div>
              <div class="harga_events">Rp <?php echo $fetch_events['harga_events']; ?> /-</div>
              <a href="admin-events.php?update=<?php echo $fetch_events['id_events']; ?>" class="option-btn">update</a>
              <a href="admin-events.php?delete=<?php echo $fetch_events['id_events']; ?>" class="delete-btn" onclick="return confirm('Hapus Event ini?');">Hapus</a>
            </div>
        <?php
          }
        } else {
          echo '<p class="empty">Belum ada Event yang ditambahkan!</p>';
        }
        ?>
      </div>
      <div class="shadow p-3 m-3 rounded">
        <?php
        if (isset($_GET['update'])) {
          $update_id = $_GET['update'];
          $update_query = mysqli_query($con, "SELECT * FROM `events` WHERE id_events = '$update_id'") or die('query gagal');
          if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
        ?>
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id_events']; ?>">
                <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                <input type="text" name="update_nama" value="<?php echo $fetch_update['nama_events']; ?>" class="box" required placeholder="Masukan Nama Event">
                <input type="number" name="update_harga" value="<?php echo $fetch_update['harga_events']; ?>" min="0" class="box" required placeholder="Masukan Harga Events">
                <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                <input type="submit" value="update" name="update_product" class="btn">
                <input type="reset" value="cancel" id="close-update" class="option-btn">
              </form>
        <?php
            }
          }
        } else {
          echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        }
        ?>
      </div>

    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>