<?php

include '../auth/koneksi.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:../auth/login.php');
}

if (isset($_POST['add_cart'])) {

$nama  = $_POST['nama_events'];
$harga_events = $_POST['harga_events'];
$image = $_POST['image'];
$jumlah_events = $_POST['jumlah_events'];

$check_cart_numbers = mysqli_query($con, "SELECT * FROM `cart` WHERE nama = '$nama' AND id_user = '$user_id'") or die('query gagal');

if (mysqli_num_rows($check_cart_numbers) > 0) {
$message[] = 'Berhasil Ditambahkan!';
} else {
mysqli_query($con, "INSERT INTO `cart`(id_user, nama, harga_events, jumlah_events, image) VALUES('$user_id', '$nama', '$harga_events', '$jumlah_events', '$image')") or die('query gagal');
$message[] = 'Event ditambahkan!';
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events | Dream Fest</title>
  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


</head>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,200&display=swap");

  * {
    font-family: "Poppins", sans-serif;
  }

  .headings {
    min-height: 40vh;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    background: url(../assets//img/banner-cart.jpg) no-repeat;
    background-size: cover;
    background-position: center;
    text-align: center;

  }

  .pags {

    min-width: 10vh;
    height: 30px;
    padding: 3px 3px 3px;
    background-color: #EEEEEE;

  }

  a {
    color: #19376d;
  }

  a:hover {
    color: black;
  }
</style>

<body>
  <?php include('./header-footer/header.php') ?>
  <div class="headings">
    <h1 class="text-white fs-1 fw-bolder text-uppercase">Events Terbaru</h1>
    <div class="pags rounded" aria-label="breadcrumb">
      <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="home.php" class="text-decoration-none fs-bold fs-5">Home</a></li>
        <li class="breadcrumb-item active text-decoration-none fs-bold fs-5" aria-current="page">Events</li>
      </ol>
    </div>

  </div>
  <?php
  $select_events = mysqli_query($con, "SELECT * FROM `events`") or die('query gagal');
  if (mysqli_num_rows($select_events) > 0) {
    while ($fetch_events = mysqli_fetch_assoc($select_events)) {
  ?>
      <section class="d-flex align-items-center row row-cols-3 g-2 g-lg-3 row-cols-lg-4 justify-content-center">
        <div class="col-5 bg-white" style="height: auto;">
          <div class="m-2 border border-3">
            <form action="" method="post" class="text-center">
              <img class="image" src="uploaded_img/<?php echo $fetch_events['image']; ?>" alt="">
              <div class="name"><?php echo $fetch_events['nama_events']; ?></div>
              <div class="price">Rp <?php echo $fetch_events['harga_events']; ?>/-</div>
              <input type="number" min="1" name="jumlah_events" value="1" class="qty">
              <input type="hidden" name="nama_events" value="<?php echo $fetch_events['nama_events']; ?>">
              <input type="hidden" name="harga_events" value="<?php echo $fetch_events['harga_events']; ?>">
              <input type="hidden" name="image" value="<?php echo $fetch_events['image']; ?>">
              <input type="submit" value="add to cart" name="add_cart" class="btn btn-secondary m-2">
            </form>
          </div>
        </div>
      </section>



  <?php
    }
  } else {
    echo '<p class="empty">Belum ada Event!</p>';
  }
  ?>

  <?php include('./header-footer/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>