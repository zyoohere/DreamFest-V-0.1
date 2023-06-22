<?php

include '../auth/koneksi.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:../auth/login.php');
}

if (isset($_POST['send'])) {

$nama = mysqli_real_escape_string($con, $_POST['nama']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$tlpn = $_POST['no_tlpn'];
$msg = mysqli_real_escape_string($con, $_POST['komentar']);

$select_message = mysqli_query($con, "SELECT * FROM `rate_view` WHERE nama = '$nama' AND email = '$email' AND no_tlpn = '$tlpn' AND komentar = '$msg'") or die('query gagal');

if (mysqli_num_rows($select_message) > 0) {
$message[] = 'message sent already!';
} else {
mysqli_query($con, "INSERT INTO `rate_view`(id_user, nama, email, no_tlpn, komentar) VALUES('$user_id', '$nama', '$email', '$tlpn', '$msg')") or die('query failed');
$message[] = 'message sent successfully!';
}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <?php include('./header-footer/header.php') ?>

  <main class="container-fluid">
    <section class="shadow rounded m-5" style="background-color: #19376d;">
      <h2 class="text-center fs-4 m-4 p-3 fw-medium text-white">PERTANYAAN UMUM</h2>
      <div class=" d-flex justify-content-center bg-white">
        <ol class=" breadcrumb ">
          <li class="breadcrumb-item "><a href="home.php" class="text-decoration-none fw-light fs-6" style="color: #19376d;">Home</a></li>
          <li class="breadcrumb-item active text-decoration-none fw-ligy fs-6" aria-current="page">Contact</li>
        </ol>
      </div>
    </section>
    <section class="shadow rounded m-5 p-4 border border-3" style="background-color: #19376d;">
      <div class="d-flex justify-content-center">
        <form action="" method="post" class="p-4">
          <h3 class="text-center text-capitalize text-white fw-bold p-2 fs-2">say something!</h3>
          <div class="row mb-3  d-flex justify-content-center" style="width: 500px;">
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama" placeholder="Masukan nama kamu">
            </div>
          </div>
          <div class="row mb-3  d-flex justify-content-center" style="width: 500px;">
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Masukan email kamu">
            </div>
          </div>
          <div class="row mb-3  d-flex justify-content-center" style="width: 500px;">
            <div class="col-sm-10">
              <input type="number" class="form-control" name="no_tlpn" placeholder="Masukan nomor telpon kamu">
            </div>
          </div>
          <div class="row mb-3  d-flex justify-content-center" style="width: 500px;">
            <div class="col-sm-10">
              <textarea name="komentar" class="form-control" placeholder="masukan komentar anda" cols="30" rows="10"></textarea>
            </div>
          </div>
          <div class="row mb-3  d-flex justify-content-center" style="width: 500px;">
            <div class="col-sm-10">
              <input type="submit" value="Kirim Pesan" name="komentar" class="btn btn-outline-light form-control">
            </div>
          </div>
      </div>
      </form>
    </section>
  </main>
  <?php include('./header-footer/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>