<?php
class Match {
    private $id, $player1_name, $player1_ID, $player1_opening, $player2_name, $player2_ID, $player2_opening, $winner_ID, $recorderID;

    public function __construct($player1_name, $player1_ID, $player1_opening, $player2_name, $player2_ID, $player2_opening, $winner_ID, $recorderID) {
        $this->player1_name = $player1_name;
        $this->player1_ID = $player1_ID;
        $this->player1_opening = $player1_opening;
        $this->player2_name = $player2_name;
        $this->player2_ID = $player2_ID;
        $this->player2_opening = $player2_opening;
        $this->winner_ID = $winner_ID;
        $this->recorderID = $recorderID;
    }

    public function getMatchID() {
        return $this->id;
    }
    public function setMatchID($value) {
        $this->id = $value;
    }

    public function getPlayer1_Name() {
        return $this->player1_name;
    }
    public function setPlayer1_Name($value) {
        $this->player1_name = $value;
    }

    public function getPlayer1_ID() {
        return $this->player1_ID;
    }
    public function setPlayer1_ID($value) {
        $this->player1_ID = $value;
    }

    public function getPlayer1_Opening() {
        return $this->player1_opening;
    }
    public function setPlayer1_Opening($value) {
        $this->player1_opening = $value;
    }

    public function getPlayer2_Name() {
        return $this->player2_name;
    }
    public function setPlayer2_Name($value) {
        $this->player2_name = $value;
    }

    public function getPlayer2_ID() {
        return $this->player2_ID;
    }
    public function setPlayer2_ID($value) {
        $this->player2_ID = $value;
    }

    public function getPlayer2_Opening() {
        return $this->player1_opening;
    }

    public function setPlayer2_Opening($value) {
        $this->player1_opening = $value;
    }

    public function getWinner_ID() {
        return $this->winner_ID;
    }
    public function setWinner_ID($value) {
        $this->winner_ID = $value;
    }
    
    public function getRecorderID() {
        return $this->recorderID;
    }
    public function setRecorderID($value) {
        $this->recorderID = $value;
    }

}
?>