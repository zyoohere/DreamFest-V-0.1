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
  <?php include('./header-footer/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>