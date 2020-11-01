<?php
$the_title = "DBC | Confirmation";
$pathcor = "../";
require_once '../view/header.php';
?>
  <header class="masthead" id="profile_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Registration</h1>
            <span class="subheading">Join our wonderful story.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

    <body>
        <main>
            <h1>Thanks for Signing Up!</h1>
            <p>Here is the information we have registered.</p>
            <p>First Name: <?php echo $first_name; ?></p>
            <p>Last Name: <?php echo $last_name; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>UserID: <?php echo $userID; ?></p>
            <p>Password: <?php echo $passTest; ?></p>
     </main>
    </body>
<?php require_once '../view/footer.php'; ?> 

