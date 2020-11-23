<?php

$the_title = "SC | Password Recovery";
$pathcor = "../";
if (!isset($pw_recovery_message)) {
    $pw_recovery_message = "";
  }
require_once '../view/header.php'; ?>
  <header class="masthead" id="profile_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Forgot Password?</h1>
          </div>
        </div>
      </div>
    </div>
  </header>
    <body class="loginbody">
        <div class="box">	
            <form action="." method="post">
            <input type="hidden" name="action" value="pw_recovery">
            <h2>Password Recovery</h2>
            <p>Enter in your e-mail to reset your password.</p>  
                <span class="error"><?php echo $pw_recovery_message; ?></span>
                <br>
                <i class="far fa-address-card fa-2x"></i>
                <input type="text" placeholder="Email" name="user_entry" value="">
                <input type="submit" name="submit" value="Submit"><br>
            </form>
        </div>
   <?php require_once '../view/footer.php'; ?> 