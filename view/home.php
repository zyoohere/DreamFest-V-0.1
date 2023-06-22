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
  <title>Dreamfest</title>
  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


</head>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,200&display=swap");

  * {
    font-family: "Poppins", sans-serif;
  }

  .content {
    min-height: 80vh;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: url(../assets/img/banner-home.jpg) no-repeat;
    background-size: cover;
    background-position: center;


  }

  .content-3 {
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: center;
    text-align: center;
  }


  .cntn {
    min-width: 15vh;
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


  .dream-cart.box-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, 30rem);
    align-items: flex-start;
    gap: 1.5rem;
    justify-content: center;
  }

  .dream-cart .box-container .box {
    border-radius: .5rem;
    background-color: var(--white);
    box-shadow: var(--box-shadow);
    padding: 2rem;
    text-align: center;
    border-radius: solid 3px;
    position: relative;
  }

  .dream-cart .box-container .box .image {
    height: 30rem;
  }

  .dream-cart .box-container .box .name {
    padding: 1rem 0;
    font-size: 2rem;
    color: black;
  }

  .dream-cart .box-container .box .qty {
    width: 100%;
    padding: 1.2rem 1.4rem;
    border-radius: .5rem;
    border-radius: solid 3px;

    margin: 1rem 0;
    font-size: 2rem;
  }

  .dream-cart.box-container .box .price {
    position: absolute;
    top: 1rem;
    left: 1rem;
    border-radius: .5rem;
    padding: 1rem;
    font-size: 2.5rem;
    color: #19376d;
    background-color: red;
  }

  .content-3 {
    min-height: 40vh;
    background-color: #333;

  }
</style>


<body>
  <?php include('./header-footer/header.php') ?>

  <section class="home">

    <div class="content bg-body-tertiary shadow p-3  rounded">
      <h3 class="text-uppercase fw-bold fs-2 text-white">Hallo Musikers</h3>
      <p class="text-white">Selamat Datang di Dream Fest</p>
      <div class="cntn rounded">
        <a href="about.php" class=" text-decoration-none ">Story Lengkap</a>
      </div>
    </div>

  </section>


  <section class="dream-cart">
    <div class="main">
      <h2 class="text-uppercase fw-bold fs-2 text-center m-3">Beli Tiket segera!!</h2>
    </div>


    <div class="box-container">
      <?php
      $select_events = mysqli_query($con, "SELECT * FROM `events` LIMIT 6") or die('query failed');
      if (mysqli_num_rows($select_events) > 0) {
        while ($fetch_event = mysqli_fetch_assoc($select_events)) {
      ?>
          <form action="" method="post" class="box">
            <img src="uploaded_img/<?php echo $fetch_event['image']; ?>" alt="" class="image">
            <div class="nama"><?php echo $fetch_event['nama_events']; ?></div>
            <div class="price"> Rp <?php echo $fetch_event['harga_events']; ?> /-</div>
            <input type="number" class="border border-2" style="width: 40px;" name="jumlah_events" min="1" value="1">
            <input type="hidden" name="nama_events" value="<?php echo $fetch_event['nama_events']; ?>">
            <input type="hidden" name="harga_events" value="<?php echo $fetch_event['harga_events']; ?>">
            <input type="hidden" name="image" value="<?php echo $fetch_event['image']; ?>">
            <input type="submit" value="add to cart" name="add_cart" class="btn">
          </form>
      <?php
        }
      } else {
        echo '<p class="empty">no products added yet!</p>';
      }
      ?>

    </div>

  </section>


  <section class="home">
    <div class="content-3 shadow p-3 mt-5 rounded ">
      <h3 class="text-uppercase text-center fs-2 fw-bold text-white">Punya Pertanyaan?</h3>
      <p class="text-white text-center">Apabila ingin menanyakan sesuatu, silahkan tulis pesan kamu</p>
      <div class="cntn rounded m-4">
        <a href="message.php" class="text-decoration-none ">Disini...</a>
      </div>
    </div>

  </section>

  <?php include('./header-footer/footer.php') ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>