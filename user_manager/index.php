<?php
require('../model/database.php');
require('../model/user.php');
require('../model/user_db.php');
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
        $_POST['newsletter'] === 'Yes') 
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
            // Make the password being tested the final password
            $password = $passTest;
            // Hash it for the server and pass it back to the password
            $hash = password_hash ( $password , PASSWORD_BCRYPT );
            $password = $hash;
            $i = new User($first_name, $last_name, $userID, $user_type, $email, $password, $win, $total, $newsletter);
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
        $player_display = $_SESSION["user_id"];
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
            $user = $_SESSION["user_id"];
            include('user_profile.php');
        break;        
    case 'admin' :
        $user = $_SESSION["user_id"];
        $userTest = UserDB::authenticationUserType($user);
        $user_display = $_SESSION["user_id"];
        if($userTest[0] === '3'){
            include('admin.php');
        } else{
            $pass_message = '';
            // $user_message = 'Sorry, admins only.';
            $user_message = $userTest[0];
            $email_message = '';
            include('user_profile.php');
        }
    break;
}
?>