<?php

include '../auth/koneksi.php';

session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:../auth/login.php');
}
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About | DreamFest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <?php include('./header-footer/header.php') ?>
  <main class="container-lg ">

    <h2 class="text-center fs-1 m-4 fw-medium" style="color: #19376d;">TENTANG EVENTS</h2>
    <div class="m-3 d-flex justify-content-center">
      <ol class=" breadcrumb">
        <li class="breadcrumb-item "><a href="home.php" class="text-decoration-none fw-light fs-6" style="color: #19376d;">Home</a></li>
        <li class="breadcrumb-item active text-decoration-none fw-ligy fs-6" aria-current="page">About</li>
      </ol>
    </div>

    <section class="m-5">
      <div class="container p-3">
        <div class=" d-flex justify-content-center">
          <video muted autoplay width="2400" height="450">
            <source src="../assets/img/about.mp4" type="video/mp4">
          </video>
        </div>
        <h1 class="text-center m-3">Apa Itu DreamFest?</h1>
        <p class="text-center"> Dreamfest Music adalah festival musik tahunan yang menampilkan berbagai genre musik, dari pop dan rock hingga jazz dan klasik. Setiap tahun, para musisi terkemuka dan calon bintang muncul di panggung Dreamfest Music untuk berbagi bakat mereka dengan dunia. Konser-konser yang luar biasa ini tidak hanya menyuguhkan musik yang indah, tetapi juga menciptakan pengalaman mendalam bagi penonton.
          <br> <br> Salah satu daya tarik utama Dreamfest Music adalah kehadiran bintang-bintang musik terkenal. Para penyanyi dan band papan atas ini mengisi panggung dengan energi yang tak tergantikan, menghibur penonton dengan suara dan penampilan yang mengagumkan. Konser-konser ini memberikan kesempatan bagi para penonton untuk menyaksikan aksi panggung yang luar biasa dan merasakan keajaiban musik secara langsung
        </p>
      </div>
    </section>
    <section class="m-5">
      <div class="container" style="min-height: 30vh;">
        <h1 class="text-center fw-medium">Partnership</h1>
        <div class="row row-cols-2  row-cols-lg-5 g-2 g-lg-3 m-3 d-flex justify-content-center">
          <div class="col">
            <img src="../assets/img/logo1.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo2.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo3.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo4.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
        </div>
        <div class="row row-cols-2  row-cols-lg-5 g-2 g-lg-3 m-3 d-flex justify-content-center">
          <div class="col">
            <img src="../assets/img/logo5.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo6.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo7.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo8.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
        </div>
    </section>
    <section class="m-5">
      <h1 class="text-center m-4">Team Project</h1>
      <div class="row row-cols-1  row-cols-lg-6 d-flex justify-content-center align-items-center" style="min-height: 30vh;">
        <div class="col card shadow m-3" style="width: 18rem;">
          <img src="../assets/img/zyoo.jpg" class="card-img-top p-2" alt="Trio Tahril Rifandi">
          <div class="card-body text-center">
            <p class="card-text">Trio Tahril Rifandi</p>
            <p class="card-text">9882405121111028</p>
            <p class="card-text">Informatika</p>
          </div>
        </div>
        <div class="col card shadow m-3" style="width: 18rem;">
          <img src="../assets/img/banner-search.png" class="card-img-top p-4" alt="Lina Mulia Sari">
          <div class="card-body text-center">
            <p class="card-text">Lina Mulia Sari</p>
            <p class="card-text">Informatika</p>
          </div>
        </div>
        <div class="col card shadow m-3" style="width: 18rem;">
          <img src="../assets/img/banner-search.png" class="card-img-top p-4" alt="Trio Tahril Rifandi">
          <div class="card-body text-center">
            <p class="card-text">Rijaldi</p>
            <p class="card-text">Informatika</p>
          </div>
        </div>
      </div>
    </section>
  </main>


  <?php include('./header-footer/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>