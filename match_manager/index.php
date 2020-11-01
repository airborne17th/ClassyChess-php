<?php
require('../model/database.php');
require('../model/player.php');
require('../model/player_db.php');
require('../model/match.php');
require('../model/match_char.php');
require('../model/match_player.php');
require('../model/match_db.php');
require('../model/char.php');
require('../model/char_db.php');
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
        if(isset($_SESSION["player_name"])){

        } else {
            // This can never be set by a player naturally with the regex.
            $_SESSION["player_name"] = "!";
        }

        $player = $_SESSION["player_name"];

        if (is_null($player)){
            $error_message = "Sorry, only members can record matches!";;
            include('registration.php');
        } 

        if ($player === "!")
        {
            $error_message = "Sorry, only members can record matches!";
            include('../player_manager/registration.php');
        } else {
            $player_display = $_SESSION["player_name"];
            $matchplayers = MatchDB::getPlayers();
            $matchchars = MatchDB::getChars();
            include('record.php');
        }
        break;
    
    case 'add_match':
        $player_display = $_SESSION["player_name"];
        $matchplayers = MatchDB::getPlayers();
        $matchchars = MatchDB::getChars();

        // Fetch the data from the match
        $player1_ID = filter_input(INPUT_POST, 'player1_ID');
        $char1_ID = filter_input(INPUT_POST, 'char1_ID');
        $player2_ID = filter_input(INPUT_POST, 'player2_ID');
        $char2_ID = filter_input(INPUT_POST, "char2_ID");
        $winner_ID = filter_input(INPUT_POST, "winner_ID");
        $record_name = $_SESSION["player_name"];

        // Initialize variables for later
        $loser_ID;
        $loser_charID;
        $winner_charID;
        $winner_name;
        $error_message = ''; 
        $isValid = true;

        // Validating the input
        if (empty($player1_ID) || empty($char1_ID) || empty($player2_ID) || empty($char2_ID) ||
        empty($winner_ID) )  {
            $error_message = "Invalid match data! Make sure all fields are filled.";
            $isValid = false;
        } else {
            $isValid = true;
        }

        if (is_numeric($player1_ID) || is_numeric($char1_ID) || is_numeric($player2_ID) || is_numeric($char2_ID) ||
        is_numeric($winner_ID) )  {
            $isValid = true;
        } else {
            $error_message = "Invalid match data! Make sure all fields are numbers.";
            $isValid = false;
        }

        if ($winner_ID === $player1_ID || $winner_ID === $player2_ID) {

        } else {
            $error_message = "Winner must be from the two players!";
            $isValid = false;
        }
        
        if ($player1_ID === $player2_ID){
            $error_message = "Cannot have the player play against the same player!";
            $isValid = false;
        }

        if ($winner_ID === $player1_ID){
            $loser_ID = $player2_ID;
            $loser_charID = $char2_ID;
            $winner_charID = $char1_ID;
        } else {
            $loser_ID = $player1_ID;
            $loser_charID = $char1_ID;
            $winner_charID = $char2_ID;
        }


        if($isValid == true) {
            //Method calls to fetch the remaining data based on what was passed down.
            $record_ID = MatchDB::getRecorderID($record_name);
            $player1_name = MatchDB::getPlayerName($player1_ID);
            $char1_name = MatchDB::getCharName($char1_ID);
            $player2_name = MatchDB::getPlayerName($player2_ID);
            $char2_name = MatchDB::getCharName($char2_ID);
            $winner_name = MatchDB::getPlayerName($winner_ID);
            // This is the call to input all the data created
            $i = new Match($player1_name[0], $player1_ID, $char1_name[0], $player2_name[0], $player2_ID, $char2_name[0], $winner_ID, $loser_ID, $record_ID[0]);
            MatchDB::addMatch($i);
            MatchDB::set_PlayerWin($winner_ID);
            MatchDB::set_PlayerLoss($loser_ID);
            MatchDB::set_CharWin($winner_charID);
            MatchDB::set_CharLoss($loser_charID);
            include('confirmation.php');
        } else{
            include('record.php');
        }
        break;  
    case 'delete_match':
        $match_id = filter_input(INPUT_POST, 'match_id', FILTER_VALIDATE_INT);
        $char1_name = MatchDB::find_char1_from_match($match_id);
        $char2_name = MatchDB::find_char2_from_match($match_id);
        $player1 = MatchDB::find_player1_from_match($match_id);
        $player2 = MatchDB::find_player2_from_match($match_id);
        $char1_ID = MatchDB::getCharID($char1_name[0]);
        $char2_ID = MatchDB::getCharID($char2_name[0]);
        $winner = MatchDB::find_winner_from_match($match_id);
        $loser = MatchDB::find_loss_from_match($match_id);
        $recorder = MatchDB::find_recorder_from_match($match_id);
        // Check to see if the ID of the recorder is the same as the ID of the person trying to delete.
        $deleter_name = $_SESSION["player_name"];
        $deleter_ID = MatchDB::getPlayerID($deleter_name);
        if($deleter_ID[0] === $recorder[0]){
            if ($player1[0] === $winner[0]){
                MatchDB::reset_PlayerWin($player1[0]);
                MatchDB::reset_PlayerLoss($player2[0]);
                MatchDB::reset_CharWin($char1_ID[0]);
                MatchDB::reset_CharLoss($char2_ID[0]);
                MatchDB::deleteMatch($match_id);
            } else {
                MatchDB::reset_PlayerWin($player2[0]);
                MatchDB::reset_PlayerLoss($player1[0]);
                MatchDB::reset_CharWin($char2_ID[0]);
                MatchDB::reset_CharLoss($char1_ID[0]);
                MatchDB::deleteMatch($match_id);
            }
            include('delete_confirmation.php');
        } else {
            $error = 'Only the recorder can delete the match. If there is a dispute on results talk to an admin about manually overriding the results.';
            include('../errors/error.php');
        }

        break;
}
?>