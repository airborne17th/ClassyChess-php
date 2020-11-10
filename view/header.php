<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $the_title ?></title>
  <link href="<?php echo $pathcor; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $pathcor; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href="<?php echo $pathcor; ?>css/site.css" rel="stylesheet">
  <link rel="icon" type="image/ico" href="<?php echo $pathcor; ?>img/favicon.ico" />
</head>

  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="<?php echo $pathcor; ?>index.php">Dream Bean Club</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="<?php echo $pathcor; ?>index.php">Home</a></li>
        <li class="nav-item"><a href="<?php echo $pathcor; ?>home_manager?action=about">About</a></li>
        <li class="nav-item"><a href="<?php echo $pathcor; ?>home_manager?action=contact">Contact</a></li>
        <li class="nav-item"><a href="<?php echo $pathcor; ?>gallery_manager?action=initial">Gallery</a></li>
        <li class="nav-item"><a href="<?php echo $pathcor; ?>user_manager?action=list_user">Directory</a></li>
        <li class="nav-item"><a href="<?php echo $pathcor; ?>match_manager?action=list_matches">Matches</a></li>
        <?php
                    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] !== "!") {
                        // Logged User
                        echo'<li class="nav-item active"><a href="'. $pathcor . 'match_manager?action=record">Record</a></li>';
                        echo'<li class="nav-item active"><a href="'. $pathcor . 'user_manager?action=admin">Admin</a></li>';
                        echo'<li class="nav-item active"><a href="'. $pathcor . 'user_manager?action=profile">Profile</a></li>';
                        echo'<li class="nav-item active"><a href="'. $pathcor . 'user_manager?action=logoff">Logoff</a></li>';
                    }else{
                      // No User
                    echo'<li class="nav-item active"><a href="'. $pathcor . 'user_manager?action=registration">Register</a></li>';
                    echo'<li class="nav-item active"><a href="'. $pathcor . 'user_manager?action=login_initial">Login</a></li>';
                    }
            ?>           
        </ul>
      </div>
    </div>
  </nav>
 
</div>