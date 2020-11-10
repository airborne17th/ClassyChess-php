<?php
$the_title = "SC | Match Records";
$pathcor = "../";
require_once '../view/header.php';
?>
<main>
<header class="masthead" id="match_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>List of Matches</h1>
            <span class="subheading">View a record of matches completed.</span>
          </div>
        </div>
      </div>
    </div>
  </header>
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-10 mx-auto"> 
<section>
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
                <td>
                    <form action="." method="post">
                    <input type="hidden" name="action"
                       value="delete_match">
                    <input type="hidden" name="match_id"
                       value="<?php echo htmlspecialchars($match->getMatchID()); ?>">
                    <input type="submit" name="submit" value="Delete"> 
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
</div>
</div>
</div>
<?php require_once '../view/footer.php'; ?> 
