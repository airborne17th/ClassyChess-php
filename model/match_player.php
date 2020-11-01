<?php 
class MatchPlayer {
            private $id, $player_name;
        
            public function __construct($player_name) {
                $this->player_name = $player_name;
            }
        
            public function getID() {
                return $this->id;
            }
            public function setID($value) {
                $this->id = $value;
            }

            public function getPlayerName() {
                return $this->player_name;
            }
            public function setPlayerName($value) {
                $this->player_name = $value;
            }
    }
    ?>