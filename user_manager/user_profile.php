<?php
$the_title = "DBC | Profile";
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
   <div class="container">
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
      <p>Newsletter</p>
      <form action="index.php" method="POST">
      <input type="submit" value="Subscribe!" />
      <input type="hidden" name="action" value="news_sub"/>
      </form>
      <br>
      <form action="index.php" method="POST">
      <input type="submit" value="Unsubscribe" />
      <input type="hidden" name="action" value="news_unsub"/>
      </form>
      <br>
      <br>
      <form action="index.php" method="POST">
      <input type="submit" value="Log Off!" />
      <input type="hidden" name="action" value="logoff"/>
      </form><br>
      <section>
        <h3>Your Matches</h3>
    <table>
        <tr>
            <th>P1 Name</th>
            <th>P1 ID</th>
            <th>P1 Opening</th>
            <th>&nbsp; &nbsp; &nbsp;</th>
            <th>P2 Name</th>
            <th>P2 ID</th>
            <th>P2 Opening</th>
            <th>&nbsp; &nbsp; &nbsp;</th>
            <th>Winner ID</th>
        </tr>
        <?php foreach ($matches as $match) : ?>
            <tr>
                <td><?php echo htmlspecialchars($match->getPlayer1_Name()); ?></td>
                <td><?php echo htmlspecialchars($match->getPlayer1_ID()); ?></td>
                <td><?php echo htmlspecialchars($match->getPlayer1_Opening()); ?></td>
                <td>&nbsp;</td>
                <td><?php echo htmlspecialchars($match->getPlayer2_Name()); ?></td>
                <td><?php echo htmlspecialchars($match->getPlayer2_ID()); ?></td>
                <td><?php echo htmlspecialchars($match->getPlayer2_Opening()); ?></td>
                <td>&nbsp;</td>
                <td><?php echo htmlspecialchars($match->getWinner_ID()); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
   </div>
   </body>
<?php require_once '../view/footer.php'; ?> 