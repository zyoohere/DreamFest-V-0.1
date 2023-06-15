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
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,200&display=swap");

  * {
    font-family: "Poppins", sans-serif;
  }

  button[type="input"] {
    background-color: #19376d;

  }

  a:hover {
    padding-top: 2px;
    margin: 2px;
    text-decoration: underline solid 2px;
  }

  .bi {
    font-size: 1.8rem;
    cursor: pointer;
    color: black;

  }


  .header .header-2.active {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
  }

  header .header-2 .flex {
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
  }

  .bi-bag-fill:hover {
    color: #19376d;
  }
</style>
<header class="header">
  <div class="header-2">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3  rounded" style="background-color: blue;">

      <div class="container">
        <a class="navbar-brand" href="admin-home.php">Admin Panel</a>
        <button class="navbar-toggler justify-content-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-center " id="navbarSupportedContent">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
            <li class="nav-item px-2">
              <a class="nav-link active" aria-current="page" href="admin-home.php">Home</a>
            </li>
            <li class="nav-item px-2">
              <a class="nav-link active" aria-current="page" href="admin-event.php">Event</a>
            </li>
            <li class="nav-item px-2">
              <a class="nav-link active" aria-current="page" href="admin-transaksi.php">Transaksi</a>
            </li>
            <li class="nav-item px-2">
              <a class="nav-link active" aria-current="page" href="admin-user.php">User</a>
            </li>
            <li class="nav-item px-2">
              <a class="nav-link active" aria-current="page" href="admin-message.php">Message</a>
            </li>
          </ul>


          <p>
            <a class="btn btn-primary rounded-circle" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              <i class="bi bi-person-circle"></i>

            </a>
          </p>
          <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <p>Nama : <span><?php echo $_SESSION['admin_name']; ?></span></p>
              <p>Email : <span><?php echo $_SESSION['email_admin']; ?></span></p>

              <a href="../../auth/logout.php" class="delete-btn">
                <i class="bi bi-box-arrow-right"></i>
              </a>
            </div>
          </div>

        </div>

      </div>
  </div>
  </nav>
  </div>
</header>