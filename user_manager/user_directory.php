<!-- set per page -->
<?php
$the_title = "DBC | User Directory ";
$pathcor = "../";
require_once '../view/header.php';
?>
  <header class="masthead" id="directory_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>User Directory</h1>
            <span class="subheading">Directory of our Users</span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <table>
            <tr>
                <th>Name</th>
                <th>UserID</th>
                <th>Email</th>                
                <th>Wins</th>
                <th>Total</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($user->getFullName()); ?></td>
                    <td><?php echo htmlspecialchars($user->getUserID()); ?></td>
                    <td><?php echo htmlspecialchars($user->getEmail()); ?></td>
                    <td><?php echo htmlspecialchars($user->getWin()); ?></td>
                    <td><?php echo htmlspecialchars($user->getTotal()); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
  <hr>
  <?php require_once '../view/footer.php'; ?> 
</body>
</html>