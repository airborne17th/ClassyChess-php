<?php 
$the_title = "SC | Error!";
$pathcor = "../";
require_once '../view/header.php';
?>
<header class="masthead" id="gallery_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Error!</h1>
          </div>
        </div>
      </div>
    </div>
  </header>
    <h1>Error</h1>
    <p><?php echo htmlspecialchars($error); ?></p>
<?php require_once '../view/footer.php'; ?>