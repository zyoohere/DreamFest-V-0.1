<?php

include '../../auth/koneksi.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:../../auth/login.php');
};

if (isset($_POST['add_events'])) {

  $nama = mysqli_real_escape_string($conn, $_POST['nama_events']);
  $harga = $_POST['harga_events'];
  $image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = 'uploaded_img/' . $image;

  $select_product_name = mysqli_query($con, "SELECT name FROM `events` WHERE nama = '$nama'") or die('query failed');

  if (mysqli_num_rows($select_product_name) > 0) {
    $message[] = 'product name already added';
  } else {
    $add_product_query = mysqli_query($con, "INSERT INTO `events`(nama_events, harga_events, image) VALUES('$nama', '$harga', '$image')") or die('query failed');

    if ($add_product_query) {
      if ($image_size > 2000000) {
        $message[] = 'image size is too large';
      } else {
        move_uploaded_file($image_tmp_name, $image_folder);
        $message[] = 'product added successfully!';
      }
    } else {
      $message[] = 'product could not be added!';
    }
  }
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $delete_image_query = mysqli_query($con, "SELECT image FROM `events` WHERE id_events = '$delete_id'") or die('query failed');
  $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
  unlink('uploaded_img/' . $fetch_delete_image['image']);
  mysqli_query($con, "DELETE FROM `events` WHERE id_events = '$delete_id'") or die('query failed');
  header('location:admin_products.php');
}

if (isset($_POST['update_product'])) {

  $update_p_id = $_POST['update_p_id'];
  $update_nama = $_POST['update_nama'];
  $update_harga = $_POST['update_harga'];

  mysqli_query($con, "UPDATE `events` SET nama_events = '$update_nama', harga_events = '$update_harga' WHERE id_events = '$update_p_id'") or die('query failed');

  $update_image = $_FILES['update_image']['nama_events'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_size = $_FILES['update_image']['size'];
  $update_folder = 'uploaded_img/' . $update_image;
  $update_old_image = $_POST['update_old_image'];

  if (!empty($update_image)) {
    if ($update_image_size > 2000000) {
      $message[] = 'image file size is too large';
    } else {
      mysqli_query($con, "UPDATE `events` SET image = '$update_image' WHERE id_events = '$update_p_id'") or die('query failed');
      move_uploaded_file($update_image_tmp_name, $update_folder);
      unlink('uploaded_img/' . $update_old_image);
    }
  }

  header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>products</title>

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

  <?php include 'admin-header.php'; ?>

  <!-- product CRUD section starts  -->

  <section class="add-products">

    <h1 class="title">shop products</h1>

    <form action="" method="post" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" name="nama_events" class="box" placeholder="enter product name" required>
      <input type="number" min="0" name="harga_events" class="box" placeholder="enter product price" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="add product" name="add_product" class="btn">
    </form>

  </section>

  <!-- product CRUD section ends -->

  <!-- show products  -->

  <section class="show-products">

    <div class="box-container">

      <?php
      $select_products = mysqli_query($con, "SELECT * FROM `events`") or die('query failed');
      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
      ?>
          <div class="box">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_products['nama_events']; ?></div>
            <div class="price">$<?php echo $fetch_products['harga_events']; ?>/-</div>
            <a href="test.php?update=<?php echo $fetch_products['id_events']; ?>" class="option-btn">update</a>
            <a href="test.php?delete=<?php echo $fetch_products['id_events']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">no products added yet!</p>';
      }
      ?>
    </div>

  </section>

  <section class="edit-product-form">

    <?php
    if (isset($_GET['update'])) {
      $update_id = $_GET['update'];
      $update_query = mysqli_query($con, "SELECT * FROM `events` WHERE id = '$update_id'") or die('query failed');
      if (mysqli_num_rows($update_query) > 0) {
        while ($fetch_update = mysqli_fetch_assoc($update_query)) {
    ?>
          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
            <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
            <input type="text" name="update_nama" value="<?php echo $fetch_update['nama_events']; ?>" class="box" required placeholder="enter product name">
            <input type="number" name="update_harga" value="<?php echo $fetch_update['harga_events']; ?>" min="0" class="box" required placeholder="enter product price">
            <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
            <input type="submit" value="update" name="update_events" class="btn">
            <input type="reset" value="cancel" id="close-update" class="option-btn">
          </form>
    <?php
        }
      }
    } else {
      echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
    }
    ?>

  </section>







  <!-- custom admin js file link  -->
  <script src="js/admin_script.js"></script>

</body>

</html>