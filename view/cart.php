<?php
include '../auth/koneksi.php';
session_start();

if (isset($_POST['update_cart'])) {
  $id_cart = $_POST['id_cart'];
  $cart_jumlah = $_POST['jumlah_events'];
  mysqli_query($con, "UPDATE `cart` SET jumlah_events = '$cart_jumlah' WHERE id_cart = '$id_cart'") or die('query gagal');
  $message[] = 'Jumlah Terupdate!';
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($con, "DELETE FROM `cart` WHERE id_cart = '$delete_id'") or die('query gagal');
  header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
  mysqli_query($con, "DELETE FROM `cart` WHERE id_user = '$id_user'") or die('query gagal');
  header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Biru | DreamFest</title>

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
    <h1 class="text-white fs-1 fw-bolder text-uppercase">Dream Fest Cart</h1>
    <div class="pags rounded" aria-label="breadcrumb">
      <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="home.php" class="text-decoration-none fs-bold fs-5">Home</a></li>
        <li class="breadcrumb-item active text-decoration-none fs-bold fs-5" aria-current="page">Cart</li>
      </ol>
    </div>
  </div>

  <section class="shopping-cart">

    <h1 class="title">products added</h1>

    <div class="box-container">
      <?php
      $grand_total = 0;
      $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE id_user = '$id_user'") or die('query gagal');
      if (mysqli_num_rows($select_cart) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
      ?>
          <div class="box">
            <a href="cart.php?delete=<?php echo $fetch_cart['id_cart']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
            <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_cart['nama']; ?></div>
            <div class="price">Rp <?php echo $fetch_cart['harga_events']; ?>/-</div>
            <form action="" method="post">
              <input type="hidden" name="id_cart" value="<?php echo $fetch_cart['id_cart']; ?>">
              <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['jumlah_events']; ?>">
              <input type="submit" name="update_cart" value="update" class="option-btn">
            </form>
            <div class="sub-total"> sub total : <span>Rp <?php echo $sub_total = ($fetch_cart['jumlah_events'] * $fetch_cart['harga_events']); ?>/-</span> </div>
          </div>
      <?php
          $grand_total += $sub_total;
        }
      } else {
        echo '<p class="empty">your cart is empty</p>';
      }
      ?>
    </div>

    <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
    </div>

    <div class="cart-total">
      <p>Total Pembelian : <span>Rp <?php echo $grand_total; ?>/-</span></p>
      <div class="flex">
        <a href="shop-event.php" class="option-btn">continue shopping</a>
        <a href="checkout.php" class="btn btn-secondary text-decoration-none<?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>
      </div>
    </div>

  </section>

  <?php include('./header-footer/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>