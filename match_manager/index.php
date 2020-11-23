<?php
require('../model/database.php');
require('../model/user.php');
require('../model/user_db.php');
require('../model/match.php');
require('../model/match_db.php');
require('elo.php');
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
        include('list_matches.php');
        break;
    case 'record':
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
            $users = UserDB::getUsers();
            include('record.php');
        }
        break;
    case 'add_match':
        $player_display = $_SESSION["user_id"];
        // Fetch the data from the match
        $player1_ID = filter_input(INPUT_POST, 'player1_ID');
        $player1_opening = filter_input(INPUT_POST, 'white_opening');
        $player2_ID = filter_input(INPUT_POST, 'player2_ID');
        $player2_opening = filter_input(INPUT_POST, 'black_opening');
        $winner_ID = filter_input(INPUT_POST, 'winner_ID');
        $record_name = $_SESSION["user_id"];
        $valid_white_openings = ['NF3', 'NH3', 'NA3', 'NC3', 'A1', 'B1', 'C1', 'D1', 'E1', 'F1', 'G1', 'H1', 'A2', 'B2', 'C2', 'D2', 'E2', 'F2', 'G2', 'H2'];
        $valid_black_openings = ['NF6', 'NH6', 'NA6', 'NC6', 'A1', 'B1', 'C1', 'D1', 'E1', 'F1', 'G1', 'H1', 'A2', 'B2', 'C2', 'D2', 'E2', 'F2', 'G2', 'H2'];
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

        if (is_numeric($player1_ID) || is_numeric($player2_ID))  {
            $isValid = true;
        } else {
            $error_message = "Invalid match data! Make sure all fields are numbers.";
            $isValid = false;
        }
        
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

    if($draw === false){
        if ($winner_ID === $player1_ID || $winner_ID === $player2_ID) {
            if ($winner_ID === $player1_ID){
                $loser_ID = $player2_ID;

            //     $winner_elo = MatchDB::find_player_elo($winner_ID);
            //     $loser_elo = MatchDB::find_player_elo($loser_ID);

            //     $elo = new Elo;

            //     $player_a->rating = $winner_elo[0];
            //     $player_b->rating = $loser_elo[0];
            
            //     // 0 for a lose, 1 for a win
            //     $player_a->score = 1;
            //     $player_b->score = 0;
            
            // list(
            //     $player_a->new_rating, 
            //     $player_b->new_rating
            // ) = $elo->new_rating(
            //     $player_a->rating, $player_b->rating, 
            //     $player_a->score, $player_b->score
            // );

            } else {
                $loser_ID = $player1_ID;
            //     $winner_elo = MatchDB::find_player_elo($winner_ID);
            //     $loser_elo = MatchDB::find_player_elo($loser_ID);

            //     $elo = new Elo;

            //     $player_a->rating = $winner_elo;
            //     $player_b->rating = $loser_elo;
            
            //     // 0 for a lose, 1 for a win
            //     $player_a->score = 1;
            //     $player_b->score = 0;
            
            // list(
            //     $player_a->new_rating, 
            //     $player_b->new_rating
            // ) = $elo->new_rating(
            //     $player_a->rating, $player_b->rating, 
            //     $player_a->score, $player_b->score
            // );

            }
        } else {
             $error_message = "Winner must be from the two players!";
             $isValid = false;
        }
    }

        if($isValid === true) {

            if($draw === false){
            //Method calls to fetch the remaining data based on what was passed down.
            $record_ID = $player_display;
            $player1_name = MatchDB::getPlayerName($player1_ID);
            $player2_name = MatchDB::getPlayerName($player2_ID);
            $winner_name = MatchDB::getPlayerName($winner_ID);
            // This is the call to input all the data created
            $i = new Match($player1_name[0], $player1_ID, $player1_opening, $player2_name[0], $player2_ID, $player2_opening, $winner_ID, $record_ID);
            MatchDB::addMatch($i);
            MatchDB::set_PlayerWin($winner_ID);
            MatchDB::set_PlayerGame($loser_ID);
            include('confirmation.php');
            } else {
                $record_ID = $player_display;
                $player1_name = MatchDB::getPlayerName($player1_ID);
                $player2_name = MatchDB::getPlayerName($player2_ID);
                $winner_ID = NULL; 
                $winner_name[0] = 'None';
                $i = new Match($player1_name[0], $player1_ID, $player1_opening, $player2_name[0], $player2_ID, $player2_opening, $winner_ID, $record_ID);
                MatchDB::addMatch($i);
                MatchDB::set_PlayerGame($player1_ID);
                MatchDB::set_PlayerGame($player2_ID);
                include('confirmation.php');
            }
        } else {
            $users = UserDB::getUsers();
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
            include('delete_confirmation.php');
        } else{
            $user_message = 'Sorry, only admins can delete matches.';
            include('record.php');
        }
        break;
}
?>