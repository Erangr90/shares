
<?php require APP_ROOT.'/views/includes/header.php';?>


<div class="row">
    <div class="col-md-10">
        <h1>Posts</h1>
        <?php flash('Add_post');  ?>
        <?php flash('remove_post');  ?>
    </div>
    <div class="col-md-2" >
        <a href="<?php echo URL_ROOT;?>/posts/add" class="btn btn-primary pull-right m-3">
            <i class="fa fa-pencil"></i> Add post
        </a>
    </div>
</div>

<?php foreach($data['posts'] as $post): ?>
    <div class="card card-body mb-3">
        <h4><?php echo $post->title;?></h4>
        <h6><?php echo $post->name.' '.$post->postTime;?></h6>
        <p class="card-text"><?php echo $post->body;?></p>
        <a href="<?php echo URL_ROOT;?>/posts/show/<?php echo $post->postId?>" class="btn btn-dark">Read more...</a>
    </div>
<?php endforeach; ?>


<?php require APP_ROOT.'/views/includes/footer.php'; ?>