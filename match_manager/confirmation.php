<?php
$the_title = "SC | Match Confirmed";
$pathcor = "../";
require_once '../view/header.php';
?>
<h1>Your match record was succesfully recorded!</h1>
<h3>Here are the details</h3>
<p>Player 1: <?php echo $player1_name[0]; ?> ID: <?php echo $player1_ID; ?></p>
<p>Character 1: <?php echo $char1_name[0]; ?></p>
<p>Player 2: <?php echo $player2_name[0]; ?> ID: <?php echo $player2_ID; ?></p>
<p>Character 2: <?php echo $char2_name[0]; ?></p>
<p>Winner: <?php echo $winner_name[0]; ?></p></p>

<?php require_once '../view/footer.php'; ?> 
