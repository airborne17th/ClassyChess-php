<?php
require('../model/database.php');
require('../model/user.php');
require('../model/user_db.php');
require('../model/match.php');
require('../model/match_player.php');
require('../model/match_db.php');
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_matches';
    }
}
switch ($action) {
    case 'list_matches':
        $matches = MatchDB::getMatches();
        include('match_records.php');
        break;
    case 'record_match':
        $error_message = '';
        if(isset($_SESSION["user_id"])){

        } else {
            // This can never be set by a player naturally with the regex.
            $_SESSION["user_id"] = "!";
        }

        $player = $_SESSION["user_id"];

        if ($player === "!" || is_null($player)) 
        {
            $error_message = "Sorry, only members can record matches!";
            include('../user_manager/registration.php');
        } else {
            $player_display = $_SESSION["user_id"];
            $matchplayers = MatchDB::getPlayers();
            include('record.php');
        }
        break;
    
    case 'add_match':
        $player_display = $_SESSION["user_id"];
        $matchplayers = MatchDB::getPlayers();

        // Fetch the data from the match
        $player1_ID = filter_input(INPUT_POST, 'player1_ID');
        $player1_opening = filter_input(INPUT_POST, 'player1_opening');
        $player2_ID = filter_input(INPUT_POST, 'player2_ID');
        $player2_opening = filter_input(INPUT_POST, 'player2_opening');
        $winner_ID = filter_input(INPUT_POST, 'winner_ID');
        $record_name = $_SESSION["user_id"];
        $valid_white_openings = [''];
        $valid_black_openings = [''];
        // Initialize variables for later
        $winner_name;
        $error_message = ''; 
        $isValid = true;
        $draw = false;

        // Validating the input
        if (empty($player1_ID) || empty($player1_opening) || empty($player2_ID) || empty($player2_opening) ||
        empty($winner_ID) )  {
            $error_message = "Invalid match data! Make sure all fields are filled.";
            $isValid = false;
        } else {
            $isValid = true;
        }

        if (is_numeric($player1_ID) is_numeric($player2_ID))  {
            $isValid = true;
        } else {
            $error_message = "Invalid match data! Make sure all fields are numbers.";
            $isValid = false;
        }

        // if ($winner_ID === $player1_ID || $winner_ID === $player2_ID) {

        // } else {
        //     $error_message = "Winner must be from the two players!";
        //     $isValid = false;
        // }
        
        if ($player1_ID === $player2_ID){
            $error_message = "Cannot have the player play against the same player!";
            $isValid = false;
        }

        if(isset($_POST['draw']) && 
        $_POST['draw'] === 'yes') 
    {
    $draw = true;
    }
    else
    {
    $draw = false;
    }	 

    if ($winner_ID === $player1_ID){
        $loser_ID = $player2_ID;
    } else {
        $loser_ID = $player1_ID;
    }


        if($isValid === true) {
            if($draw === false){
            //Method calls to fetch the remaining data based on what was passed down.
            $record_ID = MatchDB::getRecorderID($record_name);
            $player1_name = MatchDB::getPlayerName($player1_ID);
            $player2_name = MatchDB::getPlayerName($player2_ID);
            $winner_name = MatchDB::getPlayerName($winner_ID);
            // This is the call to input all the data created
            $i = new Match($player1_name[0], $player1_ID, $player1_opening, $player2_name[0], $player2_ID, $player2_opening, $winner_ID, $record_ID[0]);
            MatchDB::addMatch($i);
            MatchDB::set_PlayerWin($winner_ID);
            MatchDB::set_PlayerGame($loser_ID);
            include('confirmation.php');
            } else {
                $winner_ID = 0; 
                $i = new Match($player1_name[0], $player1_ID, $player1_opening, $player2_name[0], $player2_ID, $player2_opening, $winner_ID, $record_ID[0]);
                MatchDB::addMatch($i);
                MatchDB::set_PlayerGame($player1_ID);
                MatchDB::set_PlayerGame($player2_ID);
            }
        } else {
            include('record.php');
       } 
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
            if($winner[0] === 0){
                MatchDB::reset_PlayerGame($player1[0]);
                MatchDB::reset_PlayerGame($player2[0]);
                MatchDB::deleteMatch($match_id);
                include('delete_confirmation.php');
            } else{
                if($winner[0] === $player1[0]){
                    MatchDB::reset_PlayerWin($player1[0]);
                    MatchDB::reset_PlayerGame($player2[0]);
                    MatchDB::deleteMatch($match_id);
                    include('delete_confirmation.php');
                } else {
                    MatchDB::reset_PlayerWin($player2[0]);
                    MatchDB::reset_PlayerGame($player1[0]);
                    MatchDB::deleteMatch($match_id);
                    include('delete_confirmation.php');
                }
            }
        } else{
            $user_message = 'Sorry, only admins can delete matches.';
            include('record.php');
        }
        // $recorder = MatchDB::find_recorder_from_match($match_id);
        // Check to see if the ID of the recorder is the same as the ID of the person trying to delete.
        break;
}
?>