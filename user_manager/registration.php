<?php
$the_title = "DBC | Registration";
$pathcor = "../";
require_once '../view/header.php';
?>
  <header class="masthead" id="about_masthead">
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

  <main>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1>Registration</h1>
        <h2>Please fill out each box below to create your account.</h2>
    <form style="padding: 20px;" action="." method="post">
        <input type="hidden" name="action" value="add_user">
        
        <label>First Name: </label><br>
        <input type="text" name="first_name" placeholder="Enter your first name"><br>
        <span class="error"><?php echo $fname_message ?></span><br>
        <label>Last Name: </label><br>
        <input type="text" name="last_name" placeholder="Enter your last name"><br>
        <span class="error"><?php echo $lname_message ?></span><br> 
        <label>E-mail: </label><br>
        <input type="text" name="email" placeholder="Enter your e-mail"><br>
        <span class="error"><?php echo $email_message ?></span><br> 
        <label>Password: <span onmouseover="show_passinfo()"> [?]</span>
        <div style = "display:none;" id="passinfo">
        Password must have the following, an upper case letter, lower case letter, a digit and a special character.
        Password must be at least 8 characters long.
        </div>
        </label><br>
        <input type="text" name="newpass" placeholder="Create password"><br>
        <span class="error"><?php echo $password_message ?></span><br> 
        <label>Confirm Password: </label><br>
        <input type="text" name="confirmpass" placeholder="Confirm password"><br> 
        <span class="error"><?php echo $confirm_message ?></span><br>
        <label>Sign Up for our newsletter? </label><br>
        <input type="checkbox" name="newsletter" value="yes"  /><br>
        <input type="submit" value="Submit"><br><br>
    </form>
        <p>Already have an account? <a href="login.php">Login Here</a></p>
     </main>
    <script src="regscript.js"></script>
      </div>
    </div>
  </div>

  <hr>

<?php require_once '../view/footer.php'; ?>  
</body>
</html>
