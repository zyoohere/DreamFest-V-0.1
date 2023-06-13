<?php

include 'koneksi.php';

if (isset($_POST['submit'])) {

  $nama = mysqli_real_escape_string($con, $_POST['nama']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $pass = mysqli_real_escape_string($con, md5($_POST['password']));
  $cpass = mysqli_real_escape_string($con, md5($_POST['cpassword']));
  $no_tlpn = mysqli_real_escape_string($con, $_POST['no_tlpn']);
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $user_type = $_POST['user_type'];

  $select_user = mysqli_query($con, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');

  if (mysqli_num_rows($select_user) > 0) {
    $message[] = 'Akun sudah ada';
  } else {
    if ($pass != $cpass) {
      $message[] = 'Password kurang pas!';
    } else {
      mysqli_query($con, "INSERT INTO `user`(nama, email, password, no_tlpn, user_type, jenis_kelamin) VALUES('$nama', '$email', '$cpass','$no_tlpn', '$user_type', '$jenis_kelamin')") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:login.php');
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | DreamFest</title>
  <!--CDN-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!--CSS-->
  <link rel="stylesheet" href="../Assets/style.css">
</head>
<style>
  ::-webkit-scrollbar {
    display: none;
  }

  body {
    background-color: #19376d;

  }

  input[type="submit"] {
    background-color: #19376d;

  }

  input[type="submit"]:hover {
    background-color: #205295;

  }

  a {
    color: #19376d;
  }

  a:hover {
    color: #205295;
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
  <div class="container-fluid">

    <div class="container d-flex p-4 justify-content-center align-items-center" style="min-height: 20vh;">
      <form class="border shadow p-3 rounded m-2" action="" method="post" style="width: 500px; background:white; ">
        <h1 class="text-center">DAFTAR</h1>

        <div class="col-mb-2">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="nama" class="form-control" id="nama" name="nama">
        </div>
        <div class="col-mb-2">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="col-mb-2">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
          <label for="password" class="form-label">Re-Password</label>
          <input type="password" class="form-control" id="cpassword" name="cpassword">
          <div class="col-auto">
            <span id="passwordHelpInline" class="form-text">
              Harus 8-20 karakter.
            </span>
          </div>
        </div>
        <div class="col-mb-1">
          <label for="inputtelp" class="form-label">Nomor Telepon</label>
          <input type="number" name="no_tlpn" class="form-control" id="inputtelp">
        </div>
        <div class="col-mb-2">
          <label for="inputState" class="form-label">Jenis Kelamin</label>
          <select name="jenis_kelamin" class="form-select" aria-label="Default select example">
            <option selected>Pilihlah ...</option>
            <option value="1">Laki - laki</option>
            <option value="2">Perempuan</option>
          </select>
        </div>

        <div class="col-mb-2">
          <label for="inputState" class="form-label">Jenis person</label>
          <select name="user_type" class="form-select" aria-label="Default select example">
            <option selected>Pilihlah ...</option>
            <option value="costumer">Costumer</option>
            <option value="admin">Admin</option>
          </select>
        </div>

        <div class="col-mb-2">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
              Apakah sudah lengkap?
            </label>
          </div>
        </div>

        <div class="d-grid gap-2">
          <input class="btn btn-primary" name="submit" type="submit" value="Daftar">
        </div>


        <div class="text-center">
          <p>Sudah punya akun? <a href="login.php" class="text-decoration-none">Silahkan Login</a></p>
        </div>
      </form>
    </div>
  </div>
</body>

</html>