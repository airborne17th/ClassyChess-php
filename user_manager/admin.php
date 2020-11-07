<?php
$the_title = "DBC | Confirmation";
$pathcor = "../";
require_once '../view/header.php';
?>
  <header class="masthead" id="admin_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Admin</h1>
            <span class="subheading">Organize our site.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

    <body>
        <main>
          <div class="container">
        <h2>Admin Powers</h2>
        <form action="index.php" method="POST">
      <span class="error"><?php echo $type_message ?></span><br>
         <input type="hidden" name="action" value="changeUserType"/>
         <label>UserID: </label><br>
        <input type="text" name="user" placeholder="Which UserID"><br>
        <label>Change UserType: </label><br>
        <span>[1: User | 2: Contributor | 3: Admin]</span><br>
        <input type="number" name="newtype" min="1" max="3" placeholder=""><br><br>
         <input type="submit" value="Submit"><br>
      </form>
        <h2>List of Users</h2>
        <table>
        <tr>
                <th>Name</th>
                <th>UserID</th>
                <th>Email</th>                
                <th>Newsletter</th>
                <th>UserType</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($user->getFullName()); ?></td>
                    <td><?php echo htmlspecialchars($user->getUserID()); ?></td>
                    <td><?php echo htmlspecialchars($user->getEmail()); ?></td>
                    <td><?php echo htmlspecialchars($user->getNewsletter()); ?></td>
                    <td><?php echo htmlspecialchars($user->getUserType()); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
            </div>
     </main>
    </body>
<?php require_once '../view/footer.php'; ?> 

