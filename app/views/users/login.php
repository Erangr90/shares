<?php require APP_ROOT.'/views/includes/header.php';?>


<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Login</h2>
            <?php flash('Sing up');  ?>
            <p>Please enter your details</p>
            <form action="<?php echo URL_ROOT;?>/users/login" method="POST">
            <div class="form-group py-3">
                <label for='email' >Email address:<sup style="color: red;">*</sup></label>
                <input style="width: 100%;" placeholder="Enter your email" type="email" name="email" class='from-control form-control-md <?php echo !empty($data['email_error']) ? 'is-invalid' : '';?>'
                value="<?php echo $data['email']; ?>"/>
                <span class='invalid-feedback'><?php echo $data['email_error']; ?></span>
            </div>
            <div class="form-group py-3">
                <label for='password' >Password:<sup style="color: red;">*</sup></label>
                <input style="width: 100%;" placeholder="Enter your password" type="password" name="password" class='from-control form-control-md <?php echo !empty($data['password_error']) ? 'is-invalid' : '';?>'
                value="<?php echo $data['password']; ?>"/>
                <span class='invalid-feedback'><?php echo $data['password_error']; ?></span>
            </div>
        
            <div class="row">
                <div class="col">
                    <input type="submit" value="Login" class='btn btn-success btn-block'>
                </div>
                <div class="col">
                    <a href="<?php echo URL_ROOT; ?>/users/register" class="btn btn-block btn-light"> Don't have an account? Sing Up</a>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>


<?php require APP_ROOT.'/views/includes/footer.php'; ?>