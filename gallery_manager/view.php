<?php
$the_title = "SC | Gallery";
$pathcor = "../";
require_once '../view/header.php';
?>
<main>
<header class="masthead" id="gallery_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Gallery</h1>
            <span class="subheading">View the memories and excitement.</span>
          </div>
        </div>
      </div>
    </div>
  </header>
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-10 mx-auto"> 
<form action="." method="post">
<input type="hidden" name="action" value="post">
<input type="submit" name="submit" value="Upload!"> 
</form>
<section>
    <table>
        <tr>
            <th>Image</th>
            <th>Comment</th>
            <th>UploaderID</th>
            <th></th>
        </tr>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <td><img src="<?php echo htmlspecialchars($post->getImage()); ?>" alt="Gallery Image" width='640' height='480'></td>
                <td><?php echo htmlspecialchars($post->getComment()); ?></td>
                <td><?php echo htmlspecialchars($post->getUserID()); ?></td>
                <td>
                    <form action="." method="post">
                    <input type="hidden" name="action"
                       value="delete">
                    <input type="hidden" name="post_id"
                       value="<?php echo htmlspecialchars($post->getID()); ?>">
                    <input type="submit" name="submit" value="Delete"> 
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
</div>
</div>
</div>
<?php require_once '../view/footer.php'; ?> 
