<?php
class UserDB {
    
    public static function getUsers() {
      $db = Database::getDB();
      $query = 'SELECT * FROM users
                ORDER BY lastName';
      $statement = $db->prepare($query);
      $statement->execute();
      $rows = $statement->fetchAll();
      $statement->closeCursor();
      $users = array();
      foreach($rows as $row) {
          $i = new User(
            $row['firstName'], $row['lastName'], $row['user_id'], $row['usertype'], $row['email'],
            $row['password'], $row['win'], $row['total'], $row['newsletter'], $row['elo']);
          $i->setID($row['id']);
          $users[] = $i;
      }
      return $users;
  }

  public static function addUser($i) {
    $db = Database::getDB();
    
    $query = 'INSERT INTO users
                 (firstName, lastName, user_id, usertype, email, password, win, total, newsletter, elo)
              VALUES
                 (:first_name, :last_name, :user_id, :usertype, :email, :password, :win, :total, :newsletter, :elo)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $i->getFirstName());
    $statement->bindValue(':last_name', $i->getLastName());
    $statement->bindValue(':user_id', $i->getUserID());
    $statement->bindValue(':usertype', $i->getUserType());
    $statement->bindValue(':email', $i->getEmail());
    $statement->bindValue(':password', $i->getPassword());
    $statement->bindValue(':win', $i->getWin());
    $statement->bindValue(':total', $i->getTotal());
    $statement->bindValue(':newsletter', $i->getNewsletter());
    $statement->bindValue(':elo', $i->getELO());
    $statement->execute();
    $statement->closeCursor();
}
   
    public static function authenticationUser($userEntry) {
        $db = Database::getDB();
        $query = 'SELECT password FROM users WHERE user_id = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $userEntry);
        $statement->execute();
        $hashed_password = $statement->fetch();
        $statement->closeCursor();
        return $hashed_password;
    }
    
    public static function authenticationUserWithEmail($entry) {
        $db = Database::getDB();
        $query = 'SELECT password FROM users WHERE email = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $hashed_password = $statement->fetch();
        $statement->closeCursor();
        return $hashed_password;
    }
    
    public static function changeNewletter($newEntry, $user) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET newsletter = :newEntry
                    WHERE user_id = :user'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':newEntry', $newEntry);
        $statement->bindValue(':user', $user);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function changeUserType($newEntry, $user) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET usertype = :usertype
                    WHERE user_id = :user'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':usertype', $newEntry);
        $statement->bindValue(':user', $user);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function changePassword($hash, $user) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET password = :newPass
                  WHERE user_id = :user'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':newPass', $hash);
        $statement->bindValue(':user', $user);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function changeEmail($newEmail, $user) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET email = :newEmail
                    WHERE user_id = :user'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':newEmail', $newEmail);
        $statement->bindValue(':user', $user);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function duplicateUserID($entry) {
        $db = Database::getDB();
        $query = 'SELECT user_id FROM users
                  WHERE user_id = :userResult'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':userResult', $entry);
        $statement->execute();
        $userResult = $statement->fetch();
        $statement->closeCursor();
        
        return $userResult;
    }

    public static function duplicateEmail($email) {
        $db = Database::getDB();
        $query = 'SELECT email FROM users
                  WHERE email = :emailTest'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':emailTest', $email);
        $statement->execute();
        $emailResult = $statement->fetch();
        $statement->closeCursor();
        
        return $emailResult;
    }

    public static function authenticationUserType($entry) {
        $db = Database::getDB();
        $query = 'SELECT usertype FROM users WHERE user_id = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $usertype = $statement->fetch();
        $statement->closeCursor();
        return $usertype;
    }

    public static function deletePassword($entry) {
        $db = Database::getDB();
        $query = 'DELETE password FROM users WHERE user_id = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function getUserID($entry) {
        $db = Database::getDB();
        $query = 'SELECT user_id FROM users WHERE email = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $userID = $statement->fetch();
        $statement->closeCursor();
        return $userID;
    }

    public static function getUsersByNewsletter() {
        $db = Database::getDB();
        $query = 'SELECT * FROM users WHERE newsletter = 1';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $userEntry);
        $statement->execute();
        $results = $statement->fetch();
        $statement->closeCursor();
        return $results;
    }

    public static function deleteUser($entry) {
        $db = Database::getDB();

        $query = 'DELETE FROM users
                 WHERE id = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function getUsersTop() {
        $db = Database::getDB();
        $query = 'SELECT * FROM users ORDER BY win DESC LIMIT 3';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        $users = array();
        foreach($rows as $row) {
            $i = new User(
              $row['firstName'], $row['lastName'], $row['user_id'], $row['usertype'], $row['email'],
              $row['password'], $row['win'], $row['total'], $row['newsletter'], $row['elo']);
            $i->setID($row['id']);
            $users[] = $i;
        }
        return $users;
    }
}
?>

