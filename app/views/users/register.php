<?php require APP_ROOT.'/views/includes/header.php';?>


<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Sing up</h2>
            <p>Please fill up your details</p>
            <form action="<?php echo URL_ROOT;?>/users/register" method="POST">
            <div class="form-group py-3">
                <label for='name' >Full name:<sup style="color: red;">*</sup></label>
                <input style="width: 100%;" placeholder="Enter your name" type="text" name="name" class='from-control form-control-md <?php echo !empty($data['name_error']) ? 'is-invalid' : '';?>'
                value="<?php echo $data['name']; ?>"/>
                <span class='invalid-feedback'><?php echo $data['name_error']; ?></span>
            </div>
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
            <div class="form-group py-3">
                <label for='confirmPassword' >Confirm password:<sup style="color: red;">*</sup></label>
                <input style="width: 100%;" placeholder="Confirm your password" type="password" name="confirmPassword" class='from-control form-control-md <?php echo !empty($data['confirmPassword_error']) ? 'is-invalid' : '';?>'
                value="<?php echo $data['name']; ?>"/>
                <span class='invalid-feedback'><?php echo $data['confirmPassword_error']; ?></span>
            </div>

            <div class="row">
                <div class="col">
                    <input type="submit" value="Register" class='btn btn-success btn-block'>
                </div>
                <div class="col">
                    <a href="<?php echo URL_ROOT; ?>/users/login" class="btn btn-block btn-light">Have an account? Login</a>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>


<?php require APP_ROOT.'/views/includes/footer.php'; ?>