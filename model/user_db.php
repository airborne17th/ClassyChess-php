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
            $row['password'], $row['win'], $row['total'], $row['newsletter']);
          $i->setID($row['id']);
          $users[] = $i;
      }
      return $users;
  }

  public static function addUser($i) {
    $db = Database::getDB();
    
    $query = 'INSERT INTO users
                 (firstName, lastName, user_id, usertype, email, password, win, total, newsletter)
              VALUES
                 (:first_name, :last_name, :user_id, :usertype, :email, :password, :win, :total, :newsletter)';
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
    
    public static function changeNewletter($newEntry, $oldEntry) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET newsletter = :newEntry
                  WHERE newsletter = :oldEntry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':newEntry', $newEntry);
        $statement->bindValue(':oldEntry', $oldEntry);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function changeUserType($newEntry, $oldEntry) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET usertype = :newEntry
                  WHERE usertype = :oldEntry'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':newEntry', $newEntry);
        $statement->bindValue(':oldEntry', $oldEntry);
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
}
?>

