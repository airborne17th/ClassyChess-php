<?php
$the_title = "DBC | Profile";
$pathcor = "../";
require_once '../view/header.php';
?>
   <body>
   <h1>Welcome! <?php echo $user_display ?></h1>
   <?php echo $user_message ?>
      <form action="index.php" method="POST">
      <span class="error"><?php echo $pass_message ?></span><br>
         <input type="hidden" name="action" value="changePassword"/>
         <label>Change Password: </label><br>
        <input type="text" name="newpass" placeholder="Change Password"><br>
         <input type="submit" value="Submit"><br>
      </form>
      <form action="index.php" method="POST">
      <span class="error"><?php echo $email_message ?></span><br>
         <input type="hidden" name="action" value="changeEmail"/>
         <label>Change E-mail: </label><br>
        <input type="text" name="newemail" placeholder="Change Email"><br>
         <input type="submit" value="Submit"><br>
      </form>
      <br>
      <br>
      <form action="index.php" method="POST">
      <input type="submit" value="Log Off!" />
      <input type="hidden" name="action" value="logoff"/>
      </form>
   </body>
<?php require_once '../view/footer.php'; ?> 