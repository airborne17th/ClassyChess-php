<?php
$the_title = "SC | Match Confirmed";
$pathcor = "../";
require_once '../view/header.php';
?>
  <header class="masthead" id="about_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Match Confirmation</h1>
            <span class="subheading">Your match record was succesfully recorded!</span>
          </div>
        </div>
      </div>
    </div>
  </header>
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-10 mx-auto">
<h1>Here are the details</h1>
<p>Player 1: <?php echo $player1_name[0]; ?> ID: <?php echo $player1_ID; ?></p>
<p>White Opening: <?php echo $player1_opening; ?></p>
<p>Player 2: <?php echo $player2_name[0]; ?> ID: <?php echo $player2_ID; ?></p>
<p>Black Opening: <?php echo $player2_opening; ?></p>
<p>Winner: <?php echo $winner_name[0]; ?></p></p>
</div>
</div>
</div>
<?php require_once '../view/footer.php'; ?> 
