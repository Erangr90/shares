<header class="p-3 bg-dark text-white md-3">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <h4 class="text-start p-1">Shares</h4>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 p-1">
          <li><a href="<?php echo URL_ROOT; ?>" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="<?php echo URL_ROOT;?>/pages/about" class="nav-link px-2 text-white">About</a></li>
          <?php if(isset($_SESSION['user_id'])): ?>

            <li><a href="<?php echo URL_ROOT;?>/users/logout" class="nav-link px-2 text-white">Logout</a></li>

          <?php endif; ?>
          
        </ul>

        <?php if(isset($_SESSION['user_id'])): ?>

          <div class="text-end"><h6>Hello <?php echo $_SESSION['user_name'];?></h6></div>

          

          <?php else: ?>

          <div>
          <a href="<?php echo URL_ROOT ; ?>/users/login"><button type="button" class="btn btn-outline-light me-2">Login</button></a>  
          <a href="<?php echo URL_ROOT ; ?>/users/register"> <button type="button" class="btn btn-warning">Sign-up</button> </a>
          </div>

        <?php endif; ?>

      </div>
    </div>
  </header>