<?php
require('../model/database.php');
require('../model/user.php');
require('../model/user_db.php');
require('../model/match.php');
require('../model/match_db.php');
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'registration';
    }
}
switch ($action) {
    case 'list_user':
        $users = UserDB::getUsers();
        $top_users = UserDB::getUsersTop();
        include('user_directory.php');
        break;
    case 'registration':
        $fname_message = '';
        $lname_message = '';
        $email_message = '';
        $password_message = '';
        $confirm_message = '';
        include('registration.php');
        break;
    case 'add_user':
        // Fetch the data from the registration attempt
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $passTest = filter_input(INPUT_POST, "newpass");
        $confirmPass = filter_input(INPUT_POST, "confirmpass");
        $newsletter;
        $userID;
        // Values used for validation
        $validationCounter = 0;
        $isValid = true;

        $fname_message = '';
        $lname_message = '';
        $email_message = '';
        $password_message = '';
        $confirm_message = '';

        // Validate the inputs
        if (empty($first_name)) {
            $fname_message = "Invalid name!";
            $isValid = false;
        } 
        
        if (empty($last_name)) {
            $lname_message = "Invalid name!";
            $isValid = false;
        } 

        if ($email === NULL || $email === false) {
            $email_message = "Invalid e-mail!";
            $isValid = false;
        }  
        
        if (preg_match('/^.{8,}$/', $passTest)) {
            } else {
                $password_message = "Invalid password must be at least 12 characters long.";
                $isValid = false;
            } 

        if (preg_match('/(?=.*[a-z])/', $passTest)) {
                $validationCounter = $validationCounter + 1;
            }
            if (preg_match('/(?=.*[A-Z])/', $passTest)) {
                $validationCounter = $validationCounter + 1;
            }
            if (preg_match('/(?=.*\d)/', $passTest)) {
                $validationCounter = $validationCounter + 1;
            }
            if (preg_match('/(?=.*[@#$%^&*()\\[\]{}\-_=~`|:;])/', $passTest)) {
                $validationCounter = $validationCounter + 1;
            }
            if ($validationCounter >= 3) {
            } else {
                $password_message = "Password must have the following, an upper case letter, lower case letter, a digit and a special character.";
                $isValid = false;
            }
        $userID = rand(1,99999);
        // Test for duplicate username
        $userTest = UserDB::duplicateUserID($userID);
        if($userTest > 0){
            while ($userTest > 0) {
                $userID = rand(1,99999);
                $userTest = UserDB::duplicateUser($userID);
            } 
        }

            $emailResult = UserDB::duplicateEmail($email);
            // Test for duplicate e-mail
            if ($emailResult > 0)
                {
                    $email_message = "E-mail in use.";
                    $isValid = false;
                } else {
    
                }
      
                if($passTest !== $confirmPass){
                    $confirm_message = "Passwords must match!";
                }
                        
    if(isset($_POST['newsletter']) && 
        $_POST['newsletter'] === 'yes') 
    {
    $newsletter = 1;
    }
    else
    {
    $newsletter = 0;
    }	 



        // if it valid then insert data into the SQL Database
        if($isValid == true) {
            // Default values for new users
            $user_type = 1;
            $win = 0;
            $total = 0;
            $elo = 1000;
            // Make the password being tested the final password
            $password = $passTest;
            // Hash it for the server and pass it back to the password
            $hash = password_hash ( $password , PASSWORD_BCRYPT );
            $password = $hash;
            $i = new User($first_name, $last_name, $userID, $user_type, $email, $password, $win, $total, $newsletter, $elo);
            UserDB::addUser($i);
            // Create the Session to validate the player is logged in and track user ID and type
            $_SESSION["user_id"] = $userID;
            include('confirmation.php');
        } else {
            include('registration.php');
        }
        break;
    case 'login_initial':
        $loginerror_message = "";
        include('login.php');    
        break;
    case 'login': 
        $isValid = true;
        $hash = "!";
        $loginerror_message = "";
        $user_entry = filter_input(INPUT_POST, 'user_entry');
        $password_entry = filter_input(INPUT_POST, 'password_entry');
        $hashed_password = UserDB::authenticationUserWithEmail($user_entry);
        if (isset($hashed_password[0])) {
            $hash = $hashed_password[0];
            trim($hash); 
        }
           
        if(password_verify($password_entry, $hash)){
            $isValid = true;
        } else {
            $isValid = false;
            $loginerror_message = "Login Failed. Check player name or password.";
        } 

        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] !== "!"){
            $isValid = false;
            $loginerror_message = "Login Failed. Already logged in.";
        }

        if ($isValid == true) {
            $userID = UserDB::getUserID($user_entry);
            $_SESSION["user_id"] = $userID[0];
            $loginerror_message = "Login Success!";
            include('login.php');
        } else {
            include('login.php');
        }
        break; 
    case 'logoff' :
       $_SESSION = array();
       session_destroy();
       $loginerror_message = "";
       include('login.php');
       break;
    case 'profile' :
        $user_message = '';
        $pass_message = '';
        $email_message = '';
        if(isset($_SESSION["user_id"])){

        } else {
            // This can never be set naturally with the regex.
            $_SESSION["user_id"] = "!";
        }

        $user = $_SESSION["user_id"];

        if (is_null($user)){
            $error_message = "Not a member? Sign up here!";;
            include('registration.php');
        } 

        if ($user === "!")
        {
            $error_message = "Not a member? Sign up here!";
            include('registration.php');
        } else {
            $user_display = $_SESSION["user_id"];
            $matches = MatchDB::getMatchesByID($user_display);
            include('user_profile.php');
        }
    break;
    case 'changePassword' :
        $passTest = filter_input(INPUT_POST, "newpass");
        $validationCounter = 0;
        $isValid = true;
        if (preg_match('/^.{12,}$/', $passTest)) {
        } else {
            $pass_message = "Password must be at least 12 characters long.";
            $isValid = false;
        } 

        if (preg_match('/(?=.*[a-z])/', $passTest)) {
            $validationCounter + 1;
        }
        if (preg_match('/(?=.*[A-Z])/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if (preg_match('/(?=.*\d)/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if (preg_match('/(?=.*[@#$%^&*()\\[\]{}\-_=~`|:;])/', $passTest)) {
            $validationCounter = $validationCounter + 1;
        }
        if ($validationCounter >= 3) {
        } else {
            $pass_message = "Password must have the following, an upper case letter, lower case letter, a digit and a special character.";
            $isValid = false;
        }

        if ($isValid == true) {
            $password = $passTest;
            $hash = password_hash ( $password , PASSWORD_BCRYPT );
            $user = $_SESSION["user_id"];
            UserDB::changePassword($hash, $user);
            $pass_message = "Password successfully updated";
        } 
        $user_message = '';
        $email_message = '';
        $user_display = $_SESSION["user_id"];
        include('user_profile.php');
        break;
    case 'changeEmail' :
            $emailTest = filter_input(INPUT_POST, "newemail", FILTER_VALIDATE_EMAIL);
            $emailResult = UserDB::duplicateEmail($emailTest);
            if ($emailResult > 0)
            {
            $email_message = "E-mail in use.";
            } else {
            $newEmail = $emailTest;
            $user = $_SESSION["user_id"];
            $email_message = "E-mail successfully updated.";
            UserDB::changeEmail($newEmail, $player);
            }
            $pass_message = '';
            $user_message = '';
            $email_message = '';
            $user_display = $_SESSION["user_id"];
            include('user_profile.php');
        break;        
    case 'admin' :
        $type_message = '';
        $pass_message = '';
        $user = $_SESSION["user_id"];
        $userTest = UserDB::authenticationUserType($user);
        $user_display = $_SESSION["user_id"];
        if($userTest[0] === '3'){
            $users = UserDB::getUsers();
            $matches = MatchDB::getMatches();
            include('admin.php');
        } else{
            $pass_message = '';
            $user_message = 'Sorry, admins only.';
            // $user_message = $userTest[0];
            $email_message = '';
            include('user_profile.php');
        }
    break;
    case 'changeUserType':
        $userID = filter_input(INPUT_POST, "user");
        $usertype = filter_input(INPUT_POST, "newtype");
        $pass_message = '';
        $user = $_SESSION["user_id"];
        $users = UserDB::getUsers();
        if($user === $userID){
            $type_message = 'You cannot change your user type!';
        } else{
            UserDB::changeUserType($usertype, $userID);
            $type_message = 'User changed successfully.';
        }
        include('admin.php');
    break;
    case 'resetPassword':
        $userID = filter_input(INPUT_POST, "user");
        $type_message = '';
        $password = 'password';
        $users = UserDB::getUsers();
        $hash = password_hash ( $password , PASSWORD_BCRYPT );
        UserDB::changePassword($hash, $userID);
        $pass_message = "Password successfully updated";
        include('admin.php');
    break;
    case 'news_sub' :
        $newsletter = 1;
        $user_display = $_SESSION["user_id"];
        UserDB::changeNewletter($newsletter, $user_display);
        $email_message = '';
        $pass_message = '';
        $user_message = 'Congratuations, you are subscribed!';
        include('user_profile.php');
    break;        
    case 'news_unsub' :
        $newsletter = 0;
        $user_display = $_SESSION["user_id"];
        UserDB::changeNewletter($newsletter, $user_display);
        $email_message = '';
        $pass_message = '';
        $user_message = 'Sorry, to see you go. You are unsubbed.';
        include('user_profile.php');
    break;     
    case 'delete_user':
        $type_message = 'User Deleted!';
        $pass_message = '';
        $users = UserDB::getUsers();
        $matches = MatchDB::getMatches();
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
        UserDB::deleteUser($user_id);
        include('admin.php');
    break;
    case 'delete_match':
        $user = $_SESSION["user_id"];
        $userTest = UserDB::authenticationUserType($user);
        $user_display = $_SESSION["user_id"];
        $match_id = filter_input(INPUT_POST, 'match_id', FILTER_VALIDATE_INT);
        $player1 = MatchDB::find_player1_from_match($match_id);
        $player2 = MatchDB::find_player2_from_match($match_id);
        $winner = MatchDB::find_winner_from_match($match_id);
        if($userTest[0] === '3'){
            if($winner[0] === NULL){
                MatchDB::reset_PlayerGame($player1[0]);
                MatchDB::reset_PlayerGame($player2[0]);
                MatchDB::deleteMatch($match_id);
            } else{
                if($winner[0] === $player1[0]){
                    MatchDB::reset_PlayerWin($player1[0]);
                    MatchDB::reset_PlayerGame($player2[0]);
                    MatchDB::deleteMatch($match_id);
                } else {
                    MatchDB::reset_PlayerWin($player2[0]);
                    MatchDB::reset_PlayerGame($player1[0]);
                    MatchDB::deleteMatch($match_id);
                }
            }
            include('../match_manager/delete_confirmation.php');
        } else{
            $user_message = 'Sorry, only admins can delete matches.';
            $users = UserDB::getUsers();
            $matches = MatchDB::getMatches();
            include('admin.php');
        }
        break;   
        case 'pw_recovery':
        $pw_recovery_message = '';
        $email_address = filter_input(INPUT_POST, 'user_entry', FILTER_VALIDATE_EMAIL);
        // Check for empty fields
        if(empty($email_address) || !filter_var($email_address,FILTER_VALIDATE_EMAIL)) {
            $pw_recovery_message = "No arguments Provided!";
        include('password_recovery.php');
        return false;
        }
        
        // Create the email and send the message
        $to = '$email_address'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "Password Recovery:  $name";
        $email_body = "Your password is password";
        $headers = "From: noreply.classychess@gmail.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        $headers .= "Reply-To: $email_address";   
        // mail($to,$email_subject,$email_body,$headers);
        $$pw_recovery_message = "Message sent!";
        include('password_recovery.php');
        return true;     
}
?>