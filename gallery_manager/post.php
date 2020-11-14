<?php
$the_title = "SC | Gallery Upload";
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
            <h1>Gallery Posting</h1>
            <span class="subheading">Submit to the gallery!</span>
          </div>
        </div>
      </div>
    </div>
  </header>
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-10 mx-auto"> 
<section>
<span class="error"><?php echo $error; ?></span>    
<form action="." method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="upload" />
<input type="file" name="image" />
<h3>Post a comment</h3>
<label>Type comment here (Max 1000 Char)</label>
<input type="text" name="gallery_text">
<input type="submit" name="submit" value="Submit"> 
</form>
<br><br>
</section>
</div>
</div>
</div>
<?php require_once '../view/footer.php'; ?> 

        
