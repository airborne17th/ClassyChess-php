<?php

$the_title = "SC | Login";
$pathcor = "../";

require_once '../view/header.php'; ?>
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
    <body class="loginbody">
        <div class="box">	
            <form action="." method="post">
            <input type="hidden" name="action" value="login">
            <div class='login_form'>
            <h2>Login</h2>
        <p>Enjoy playing an awesome game with awesome friends! Please use the boxes below to sign into your account.</p> 
            </div>  
                <span class="error"><?php echo $loginerror_message ?></span>
                <br><br>
                <i class="far fa-address-card fa-2x"></i>
                <input type="text" placeholder="Email" name="user_entry" value="">
                <i class="fas fa-key fa-2x"></i>
                <input type="text" placeholder="Password" name="password_entry" value="">
                <input type="submit" name="submit" value="Sign in!"><br>
                <p>Not a member? <a href="registration.php">Sign Up Here!</a></p>
            </form>
       
        </div>
   <?php require_once '../view/footer.php'; ?> 