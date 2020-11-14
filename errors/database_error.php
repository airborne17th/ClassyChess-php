<?php include '../view/header.php'; ?>
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
<main>
    <h1>Database Error</h1>
    <p>Error message: <?php echo htmlspecialchars($error_message); ?></p>
</main>
<?php include '../view/footer.php'; ?>