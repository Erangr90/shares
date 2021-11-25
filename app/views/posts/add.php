<?php require APP_ROOT.'/views/includes/header.php';?>

    <a href="<?php echo URL_ROOT;?>/posts" class="btn btn-warning mt-3">
        <i class="fa fa-backward"></i> Go back
    </a>

        <div class="card card-body bg-light mt-5">
            <h2>Add post</h2>
            <p>Create a post</p>
            <form action="<?php echo URL_ROOT;?>/posts/add" method="POST">
            <div class="form-group py-3">
                <label for='title' >Title:<sup style="color: red;">*</sup></label>
                <input style="width: 100%;" placeholder="Enter title" type="text" name="title" class='from-control form-control-md <?php echo !empty($data['title_error']) ? 'is-invalid' : '';?>'
                value="<?php echo $data['title']; ?>"/>
                <span class='invalid-feedback'><?php echo $data['title_error']; ?></span>
            </div>
            <div class="form-group py-3">
                <label for='body' >Content:<sup style="color: red;">*</sup></label>
                <textarea style="width: 100%;" rows="7" cols="50" placeholder="Enter your post" name="body" class='from-control form-control-md <?php echo !empty($data['body_error']) ? 'is-invalid' : '';?>'
                value="<?php echo $data['body']; ?>"></textarea>
                <span class='invalid-feedback'><?php echo $data['body_error']; ?></span>
            </div>

            <input type="submit" class="btn btn-success" value="Submit"/>

            </form>
        </div>




<?php require APP_ROOT.'/views/includes/footer.php'; ?>