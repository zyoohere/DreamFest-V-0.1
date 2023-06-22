<?php


include 'koneksi.php';
session_start();

if (isset($_POST['submit'])) {

  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, md5($_POST['password']));

  $select_user = mysqli_query($con, "SELECT * FROM  `user` WHERE email = '$email' AND password = '$password'") or die('query failed');
  if (mysqli_num_rows($select_user) > 0) {

    $row = mysqli_fetch_assoc($select_user);

    if ($row['user_type'] == 'admin') {

      $_SESSION['admin_nama'] = $row['nama'];
      $_SESSION['admin_email'] = $row['email'];
      $_SESSION['admin_id'] = $row['id_user'];
      header('location: ../view/adminpages/admin-home.php');
    } elseif ($row['user_type'] == 'costumer') {

      $_SESSION['user_nama'] = $row['nama'];
      $_SESSION['user_email'] = $row['email'];
      $_SESSION['user_id'] = $row['id_user'];
      header('location:../view/home.php');
    }
  } else {
    $message[] = 'Email atau Password salah!';
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <!--CDN-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- custom css file link  -->


</head>
<style>
  ::-webkit-scrollbar {
    display: none;
  }

  body {
    background-color: #19376d;

  }

  .container {
    min-height: 80vh;
    width: 500px;
  }

  .card-body {
    background-color: white;
    height: auto;
  }

  input[type="submit"] {
    background-color: #19376d;

  }

  input[type="submit"]:hover {
    background-color: #205295;

  }
</style>

<body>

  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '
      
      <div class="alert alert-primary" role="alert">
      <span>' . $message . '</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
  </div>
      ';
    }
  }

  ?>

  <div class="container d-flex justify-content-center align-items-center">
    <div class="card-body border shadow p-3 rounded m-2">
      <form action="" method="post">
        <h1 class="text-center pb-4">LOGIN</h1>
        <!-- email -->
        <div class="col-mb-2">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" placeholder="masukan email kamu" required class="form-control">
        </div>

        <!-- pass -->
        <div class="col-mb-2">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" placeholder="masukan password kamu" required class="form-control">
          <div class="col-auto">
            <span id="passwordHelpInline" class="form-text">
              Harus 8-20 karakter.
            </span>
          </div>
        </div>

        <div class="col-mb-2">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
              Apakah sudah lengkap?
            </label>
          </div>
        </div>
        <!-- btn -->
        <div class="d-grid gap-2">
          <input type="submit" name="submit" value="Masuk" class="btn text-white">
          <div class="text-center">
            <p>Belum punya akun? <a href="register.php" class="text-decoration-none">Silahkan Daftar</a></p>
          </div>
        </div>
      </form>

    </div>
  </div>
</body>

</html>