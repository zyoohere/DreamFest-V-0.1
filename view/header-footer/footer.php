<style>
   .footer {
      margin: 30px;
      background-color: var(--light-bg);
      justify-content: center;
      align-items: center;
      text-align: center;
      min-height: 10vh;
   }

   .footer .credit {
      text-align: center;
      border-top: black solid 2px;
      
   }

   .footer .credit span {
      color: black;
   }
</style>

<section class="footer">

   <div class="row row-cols-2 row-cols-lg-2 g-3 g-lg-3 justify-content-center align-item-center">

      <div class="col-6 ">
         <h3 class="text-uppercase fs-3">quick links</h3>
         <a href="./home.php" class="text-decoration-none">home</a>
         <a href="./typo.php" class="text-decoration-none">about</a>
         <a href="./events.php" class="text-decoration-none">events</a>
         <a href="./contact.php" class="text-decoration-none">contact</a>
      </div>

      <div class="box col-3">
         <h3 class="text-uppercase fs-3">extra links</h3>
         <a href="../../auth/login.php" class="text-decoration-none">login</a>
         <a href="../../auth/register.php" class="text-decoration-none">register</a>
         <a href="./cart.php" class="text-decoration-none">cart</a>
         <a href="./events.php" class="text-decoration-none">Pemesanan</a>
      </div>

      <div class="col-6">
         <h3>CONTACT INFORMATIOM</h3>
         <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
         <p> <i class="fas fa-phone"></i> +62 8234 332</p>
         <p> <i class="fas fa-envelope"></i> Dreamfest@gmail.com </p>
         <p> <i class="fas fa-map-marker-alt"></i> Bandung, Jawa Barat - Indonesia </p>
      </div>

      <div class="col-6">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

   <p class="credit"> &copy; copyright <?php echo date('Y'); ?> by <span>DreamFest</span> </p>

</section>