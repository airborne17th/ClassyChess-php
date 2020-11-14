
<?php
class GalleryDB {
    public static function getPosts() {
        $db = Database::getDB();
        $query = 'SELECT * FROM gallery';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        $posts = array();
        foreach($rows as $row) {
            $i = new GalleryPost(
              $row['image'], $row['comment'], $row['userID']);
            $i->setID($row['id']);
            $posts[] = $i;
        }
        return $posts;
    }
  
    public static function addPost($i) {
      $db = Database::getDB();
      
      $query = 'INSERT INTO gallery
                   (image, comment, userID)
                VALUES
                   (:image, :comment, :userID)';
      $statement = $db->prepare($query);
      $statement->bindValue(':image', $i->getImage());
      $statement->bindValue(':comment', $i->getComment());
      $statement->bindValue(':userID', $i->getUserID());
      $statement->execute();
      $statement->closeCursor();
  }

  public static function deletePost($entry) {
    $db = Database::getDB();

    $query = 'DELETE FROM gallery
             WHERE id = :entry';
    $statement = $db->prepare($query);
    $statement->bindValue(':entry', $entry);
    $statement->execute();
    $statement->closeCursor();
    }
}
?>