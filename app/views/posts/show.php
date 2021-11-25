
<?php require APP_ROOT.'/views/includes/header.php';?>

<a href="<?php echo URL_ROOT;?>/posts" class="btn btn-warning m-3">
        <i class="fa fa-backward"></i> Go back
</a>

<?php flash('Edit_post');  ?>


<h1> <?php echo $data['post']->title ;?> </h1>
<div class="bg-secondary text-white p-2 mb-3">
    <h4><?php echo $data['user']->name.' '.$data['post']->createdAt;?></h4>
</div>
<p><?php echo $data['post']->body;?></p>

<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
  <hr>
  <a href="<?php echo URL_ROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark m-3">Edit</a>

  <form class="pull-right" style="display: inline;" action="<?php echo URL_ROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
<?php endif; ?>


<?php require APP_ROOT.'/views/includes/footer.php'; ?>