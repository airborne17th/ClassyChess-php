<?php
$the_title = "SC | Match Records";
$pathcor = "../";
require_once '../view/header.php';
?>
<main>

<section>
    <table>
        <tr>
            <th>Player 1 Name</th>
            <th>Player 1 ID</th>
            <th>Character 1 Name</th>
            <th>&nbsp; &nbsp; &nbsp;</th>
            <th>Player 2 Name</th>
            <th>Player 2 ID</th>
            <th>Character 2 Name</th>
            <th>&nbsp; &nbsp; &nbsp;</th>
            <th>Winner ID</th>
            <th>Loss ID</th>
            <th>Recorder ID</th>
        </tr>
        <?php foreach ($matches as $match) : ?>
            <tr>
                <td><?php echo htmlspecialchars($match->getPlayer1_Name()); ?></td>
                <td><?php echo htmlspecialchars($match->getPlayer1_ID()); ?></td>
                <td><?php echo htmlspecialchars($match->getChar1_Name()); ?></td>
                <td>&nbsp;</td>
                <td><?php echo htmlspecialchars($match->getPlayer2_Name()); ?></td>
                <td><?php echo htmlspecialchars($match->getPlayer2_ID()); ?></td>
                <td><?php echo htmlspecialchars($match->getChar2_Name()); ?></td>
                <td>&nbsp;</td>
                <td><?php echo htmlspecialchars($match->getWinner_ID()); ?></td>
                <td><?php echo htmlspecialchars($match->getLoss_ID()); ?></td>
                <td><?php echo htmlspecialchars($match->getRecorderID()); ?></td>
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
<?php require_once '../view/footer.php'; ?> 
