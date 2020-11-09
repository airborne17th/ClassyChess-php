
<?php
class MatchDB {
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
                    $row['player1_name'], $row['player1_ID'], $row['player1_opening'],
                    $row['player2_name'], $row['player2_ID'], $row['player2_opening'],
                    $row['winner_ID'], $row['recorderID']
                );
            $i->setMatchID($row['matchID']);
            $matches[] = $i;
        }
        return $matches;
    }

    public static function getPlayers() {
        $db = Database::getDB();
        $query = 'SELECT user_id, lastName FROM users
                  ORDER BY user_id';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        $players = array();
        foreach($rows as $row) {
            $i = new MatchPlayer(
              $row['lastName']);
            $i->setID($row['user_id']);
            $players[] = $i;
        }
        return $players;
    }
    
    public static function addMatch($i) {
      $db = Database::getDB();
      
      $query = 'INSERT INTO matches
                   (player1_name, player1_ID, player1_opening, player2_name, player2_ID, player2_opening, winner_ID, recorderID)
                VALUES
                   (:player1_name, :player1_ID, :player1_opening, :player2_name, :player2_ID, :player2_opening, :winner_ID, :recorderID)';
      $statement = $db->prepare($query);
      $statement->bindValue(':player1_name', $i->getPlayer1_Name());
      $statement->bindValue(':player1_ID', $i->getPlayer1_ID());
      $statement->bindValue(':player1_opening', $i->getPlayer1_Opening());
      $statement->bindValue(':player2_name', $i->getPlayer2_Name());
      $statement->bindValue(':player2_ID', $i->getPlayer2_ID());
      $statement->bindValue(':player2_opening', $i->getPlayer2_Opening());
      $statement->bindValue(':winner_ID', $i->getWinner_ID());
      $statement->bindValue(':recorderID', $i->getRecorderID());
      $statement->execute();
      $statement->closeCursor();
  }

    public static function set_PlayerWin($entry) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET win = win + 1,
                        total = total + 1
                  WHERE user_id = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function set_PlayerGame($entry) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET total = total + 1
                  WHERE user_id = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }


    public static function authenticationPlayer($entry) {
        $db = Database::getDB();
        $query = 'SELECT user_id FROM users WHERE user_id = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $valid_player = $statement->fetch();
        $statement->closeCursor();
        return $valid_player;
    }

    public static function getRecorderID($entry) {
        $db = Database::getDB();
        $query = 'SELECT user_id FROM users WHERE user_id = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $record_ID = $statement->fetch();
        $statement->closeCursor();
        return $record_ID;
    }

    public static function getPlayerName($entry) {
        $db = Database::getDB();
        $query = 'SELECT lastName FROM users WHERE user_id = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $player_name = $statement->fetch();
        $statement->closeCursor();
        return $player_name;
    }

    public static function getPlayerID($entry) {
        $db = Database::getDB();
        $query = 'SELECT user_id FROM users WHERE email = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $player_ID = $statement->fetch();
        $statement->closeCursor();
        return $player_ID;
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

    public static function find_player2_from_match($entry) {
        $db = Database::getDB();
        $query = 'SELECT player1_ID FROM matches WHERE matchID = :entry';
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
        $query = 'UPDATE users
                    SET win = win - 1,
                        total = total - 1
                  WHERE playerID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function reset_PlayerGame($entry) {
        $db = Database::getDB();
        $query = 'UPDATE players
                    SET total = total - 1
                  WHERE playerID = :entry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }
}
?>