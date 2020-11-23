<?php
$the_title = "SC | Record Match";
$pathcor = "../";
require_once '../view/header.php';
?>
  <header class="masthead" id="admin_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Record</h1>
            <span class="subheading">Record match results.</span>
          </div>
        </div>
      </div>
    </div>
  </header>
<div class="container" style="margin-top:30px">
<div class="row">
<div class="col-sm-6">
<h1>Hello! <?php echo $player_display ?></h1>
<p>Here you can record the results of matches.<p>
<div class='record_form'>
<form action="." method="post">
        <h2>Match Record Form</h2>
        <p>If their is an unknown opening play, leave N/A.</p>
        <input type="hidden" name="action" value="add_match">
        <span class="error"><?php echo $error_message ?></span><br><br>
        <label>Player1 ID:  </label><br>
        <input type="text" name="player1_ID" placeholder="Enter in player ID"><br>
        <label for="white_opening">White Opening:  </label><br>
        <select name="white_opening" id="white_opening" required>
        <option value="NA">N/A</option> <option value="NF3">NF3</option> <option value="NH3">NH3</option> <option value="NA3">NA3</option> <option value="NC3">NC3</option> 
        <option value="A3">A3</option> <option value="B3">B3</option> <option value="C3">C3</option> <option value="D3">D3</option>
        <option value="E3">E3</option> <option value="F3">F3</option> <option value="G3">G3</option> <option value="H3">H3</option>
        <option value="A4">A4</option> <option value="B4">B4</option> <option value="C4">C4</option> <option value="D4">D4</option> 
        <option value="E4">E4</option> <option value="F4">F4</option> <option value="G4">G4</option> <option value="H4">H4</option>
        </select>
        <br>
        <label>Player2 ID:  </label><br>
        <input type="text" name="player2_ID" placeholder="Enter in player ID"><br>
        <label for="black_opening">Black Opening:  </label><br>
        <select name="black_opening" id="black_opening" required>
        <option value="NA">N/A</option> <option value="NF6">NF6</option> <option value="NH6">NH6</option> <option value="NA6">NA6</option> <option value="NC6">NC6</option> 
        <option value="A6">A6</option> <option value="B6">B6</option> <option value="C6">C6</option> <option value="D6">D6</option>
        <option value="E6">E6</option> <option value="F6">F6</option> <option value="G6">G6</option> <option value="H6">H6</option>
        <option value="A5">A5</option> <option value="B5">B5</option> <option value="C5">C5</option> <option value="D5">D5</option> 
        <option value="E5">E5</option> <option value="F5">F5</option> <option value="G5">G5</option> <option value="H5">H5</option>
        </select>
        <br>
        <label>Winner ID:  </label><br>
        <input type="text" name="winner_ID" id="winner_id" placeholder="Enter in winner ID"><br>
        <label>Draw?</label><br>
        <input type="checkbox" name="draw" id="draw" value="yes" onclick="toggle()" /><br><br> 
        <input type="submit" value="Submit"><br><br>
    </form>
</div>
</div>

<div class="col-sm-3">
<h2>For reference: </h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>ELO</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($user->getUserID()); ?></td>
                    <td><?php echo htmlspecialchars($user->getFullName()); ?></td>
                    <td><?php echo htmlspecialchars($user->getELO()); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
<br><br>
</div>
</div>
</div>
<script src="record_script.js"></script>
<?php require_once '../view/footer.php'; ?> 
