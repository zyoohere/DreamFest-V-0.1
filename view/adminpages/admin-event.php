<?php

include '../../auth/koneksi.php';

session_start();

if (isset($_POST['add_events'])) {

  $nama = mysqli_real_escape_string($con, $_POST['nama_events']);
  $harga = $_POST['harga_events'];
  $image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = 'uploaded_img/' . $image;

  $select_events_name = mysqli_query($con, "SELECT nama_events FROM `events` WHERE nama_events = '$nama'") or die('query failed');

  if (mysqli_num_rows($select_events_name) > 0) {
    $message[] = 'Nama Events Berhasil Ditambahkan';
  } else {
    $add_event_query = mysqli_query($con, "INSERT INTO `events`(nama_events, harga_events, image) VALUES('$nama', '$harga', '$image')") or die('query failed');

    if ($add_event_query) {
      if ($image_size > 2000000) {
        $message[] = 'Gambar Terlalu Besar';
      } else {
        move_uploaded_file($image_tmp_nama, $image_folder);
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

  mysqli_query($con, "UPDATE `events` SET nama_events = '$update_nama', harga_events = '$update_harga' WHERE id_events = '$update_p_id'") or die('query gagal');

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

  <h1 class="text-center m-5">E V E N T S</h1>
  <!-- TAMBAH EVENT -->
  <section class="container-fluid d-flex justify-content-center">
    <div class=" shadow p-3 m-3 rounded border border-4 border border-secondary" style=" width: 700px;">
      <form action="" method="post" enctype="multipart/form-data">
        <h3 class="text-center m-3">Tambah Event</h3>
        <div class="m-3">
          <input type="text" name="nama_events" class="form-control border border-secondary" placeholder="Masukan Nama Events" required>
        </div>
        <div class="m-3">
          <input type="number" min="0" name="harga_events" class="form-control border border-secondary" placeholder="Masukan Harga Events" required>
        </div>
        <div class="m-3">

          <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="form-control border border-secondary" required>
        </div>
        <div class="m-3">

          <input type="submit" value="add events" name="add_events" class="btn btn-outline-secondary form-control">
        </div>
      </form>
    </div>
  </section>

  <!--Tampilan Events -->
  <section class="container-fluid d-flex justify-content-center">
    <div class="shadow p-3 m-3 border border-4  border border-secondary  rounded text-center" style="width: 700px;">

      <?php
      $select_events = mysqli_query($con, "SELECT * FROM `events`") or die('query gagal');
      if (mysqli_num_rows($select_events) > 0) {
        while ($fetch_events = mysqli_fetch_assoc($select_events)) {
      ?>
          <div class=" border border-secondary m-4 ">
            <img src="uploaded_img/<?php echo $fetch_events['image']; ?>" alt="">
            <div class="nama_events"><?php echo $fetch_events['nama_events']; ?></div>
            <div class="harga_events">Rp <?php echo $fetch_events['harga_events']; ?> /-</div>
            <a href="admin-event.php?update=<?php echo $fetch_events['id_events']; ?>" class="btn  text-decoration-none btn-secondary">update</a>
            <a href="admin-event.php?delete=<?php echo $fetch_events['id_events']; ?>" class="btn text-decoration-none" onclick="return confirm('Hapus Event ini?');">Hapus</a>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">Belum ada Event yang ditambahkan!</p>';
      }
      ?>
    </div>
  </section>


  <!-- EDIT EVENT -->
  <section class="container-fluid d-flex justify-content-center">
    <div class="shadow p-3 m-3 rounded  border border-secondary border-4" style="width: 700px;">
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

              <div class="m-3">
                <input type="text" name="update_nama" value="<?php echo $fetch_update['nama_events']; ?>" class="form-control border border-secondary" required placeholder="Masukan Nama Event">
              </div>
              <div class="m-3">
                <input type="number" name="update_harga" value="<?php echo $fetch_update['harga_events']; ?>" min="0" class="form-control border border-secondary" required placeholder="Masukan Harga Events">
              </div>
              <div class="m-3">

                <input type="file" class="form-control border border-secondary" name="update_image" accept="image/jpg, image/jpeg, image/png">
              </div>
              <div class="m-3">



                <input type="submit" value="update" name="update_events" class="btn btn-outline-secondary">

                <input type="reset" value="cancel" id="close-update" class="btn btn-outline-secondary">
              </div>

            </form>
      <?php
          }
        }
      } else {
        echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
      ?>
    </div>
  </section>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>