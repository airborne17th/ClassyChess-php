
<?php
class GalleryDB {
    public static function getMatches() {
        $db = Database::getDB();
  
        $query = 'SELECT * FROM matches
                  ORDER BY matchID';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        
        $matches = array();
        foreach($rows as $row) {
            $i = new Match(
                    $row['player1_name'], $row['player1_ID'], $row['char1_name'],
                    $row['player2_name'], $row['player2_ID'], $row['char2_name'],
                    $row['winner_ID'], $row['loss_ID'], $row['recorderID']
                );
            $i->setMatchID($row['matchID']);
            $matches[] = $i;
        }
        return $matches;
    }

    public static function getPlayers() {
        $db = Database::getDB();

        $query = 'SELECT playerID, playerName FROM players
                  ORDER BY playerID';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        
        $players = array();
        foreach($rows as $row) {
            $i = new MatchPlayer(
              $row['playerName']);
            $i->setID($row['playerID']);
            $matchplayers[] = $i;
        }
        return $matchplayers;
    }


    public static function getChars() {
        $db = Database::getDB();

        $query = 'SELECT charID, charName FROM characters
                  ORDER BY charID';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        
        $chars = array();
        foreach($rows as $row) {
            $i = new MatchChar(
                    $row['charName']);
            $i->setID($row['charID']);
            $matchchars[] = $i;
        }
        return $matchchars;
    }
    
    public static function addMatch($i) {
      $db = Database::getDB();
      
      $query = 'INSERT INTO matches
                   (player1_name, player1_ID, char1_name, player2_name, player2_ID, char2_name, winner_ID, loss_ID, recorderID)
                VALUES
                   (:player1_name, :player1_ID, :char1_name, :player2_name, :player2_ID, :char2_name, :winner_ID, :loss_ID, :recorderID)';
      $statement = $db->prepare($query);
      $statement->bindValue(':player1_name', $i->getPlayer1_Name());
      $statement->bindValue(':player1_ID', $i->getPlayer1_ID());
      $statement->bindValue(':char1_name', $i->getChar1_Name());
      $statement->bindValue(':player2_name', $i->getPlayer2_Name());
      $statement->bindValue(':player2_ID', $i->getPlayer2_ID());
      $statement->bindValue(':char2_name', $i->getChar2_Name());
      $statement->bindValue(':winner_ID', $i->getWinner_ID());
      $statement->bindValue(':loss_ID', $i->getLoss_ID());
      $statement->bindValue(':recorderID', $i->getRecorderID());
      $statement->execute();
      $statement->closeCursor();
  }

    public static function set_PlayerWin($entry) {
        $db = Database::getDB();
        $query = 'UPDATE players
                    SET win = win + 1,
                        total = total + 1
                  WHERE playerID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function set_PlayerLoss($entry) {
        $db = Database::getDB();
        $query = 'UPDATE players
                    SET loss = loss + 1,
                        total = total + 1
                  WHERE playerID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function set_CharWin($entry) {
        $db = Database::getDB();
        $query = 'UPDATE characters
                    SET win = win + 1,
                        total = total + 1
                  WHERE charID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function set_CharLoss($entry) {
        $db = Database::getDB();
        $query = 'UPDATE characters
                    SET loss = loss + 1,
                        total = total + 1
                  WHERE charID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function authenticationChar($charEntry) {
        $db = Database::getDB();
        $query = 'SELECT charID FROM characters WHERE charID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $charEntry);
        $statement->execute();
        $valid_char = $statement->fetch();
        $statement->closeCursor();
        return $valid_char;
    }

    public static function authenticationPlayer($playerEntry) {
        $db = Database::getDB();
        $query = 'SELECT playerID FROM players WHERE playerID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $playerEntry);
        $statement->execute();
        $valid_player = $statement->fetch();
        $statement->closeCursor();
        return $valid_player;
    }

    public static function getRecorderID($entry) {
        $db = Database::getDB();
        $query = 'SELECT playerID FROM players WHERE playerName = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $record_ID = $statement->fetch();
        $statement->closeCursor();
        return $record_ID;
    }

    public static function getPlayerName($entry) {
        $db = Database::getDB();
        $query = 'SELECT playerName FROM players WHERE playerID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $player_name = $statement->fetch();
        $statement->closeCursor();
        return $player_name;
    }

    public static function getCharName($entry) {
        $db = Database::getDB();
        $query = 'SELECT charName FROM characters WHERE charID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $char_name = $statement->fetch();
        $statement->closeCursor();
        return $char_name;
    }

    public static function getPlayerID($entry) {
        $db = Database::getDB();
        $query = 'SELECT playerID FROM players WHERE playerName = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $player_ID = $statement->fetch();
        $statement->closeCursor();
        return $player_ID;
    }

    public static function getCharID($entry) {
        $db = Database::getDB();
        $query = 'SELECT charID FROM characters WHERE charName = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $char_ID = $statement->fetch();
        $statement->closeCursor();
        return $char_ID;
    }

    public static function find_char1_from_match($entry) {
        $db = Database::getDB();
        $query = 'SELECT char1_name FROM matches WHERE matchID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $char = $statement->fetch();
        $statement->closeCursor();
        return $char;
    }

    public static function find_player1_from_match($entry) {
        $db = Database::getDB();
        $query = 'SELECT player1_ID FROM matches WHERE matchID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $player = $statement->fetch();
        $statement->closeCursor();
        return $player;
    }

    public static function find_char2_from_match($entry) {
        $db = Database::getDB();
        $query = 'SELECT char2_name FROM matches WHERE matchID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $char = $statement->fetch();
        $statement->closeCursor();
        return $char;
    }

    public static function find_player2_from_match($entry) {
        $db = Database::getDB();
        $query = 'SELECT player2_ID FROM matches WHERE matchID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $player = $statement->fetch();
        $statement->closeCursor();
        return $player;
    }

    public static function find_winner_from_match($entry) {
        $db = Database::getDB();
        $query = 'SELECT winner_ID FROM matches WHERE matchID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $winner = $statement->fetch();
        $statement->closeCursor();
        return $winner;
    }

    public static function find_loss_from_match($entry) {
        $db = Database::getDB();
        $query = 'SELECT loss_ID FROM matches WHERE matchID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $loss = $statement->fetch();
        $statement->closeCursor();
        return $loss;
    }

    public static function find_recorder_from_match($entry) {
        $db = Database::getDB();
        $query = 'SELECT recorderID FROM matches WHERE matchID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $recorder = $statement->fetch();
        $statement->closeCursor();
        return $recorder;
    }

    public static function deleteMatch($entry) {
        $db = Database::getDB();

        $query = 'DELETE FROM matches
                 WHERE matchID = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function reset_PlayerWin($entry) {
        $db = Database::getDB();
        $query = 'UPDATE players
                    SET win = win - 1,
                        total = total - 1
                  WHERE playerID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function reset_PlayerLoss($entry) {
        $db = Database::getDB();
        $query = 'UPDATE players
                    SET loss = loss - 1,
                        total = total - 1
                  WHERE playerID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function reset_CharWin($entry) {
        $db = Database::getDB();
        $query = 'UPDATE characters
                    SET win = win - 1,
                        total = total - 1
                  WHERE charID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function reset_CharLoss($entry) {
        $db = Database::getDB();
        $query = 'UPDATE characters
                    SET loss = loss - 1,
                        total = total - 1
                  WHERE charID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }
}
?>