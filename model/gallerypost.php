<?php 
class GalleryPost {
            private $id, $image, $comment, $userID;
        
            public function __construct($image, $comment, $userID) {
                $this->image = $image;
                $this->comment = $comment;
                $this->userID = $userID;
            }
        
            public function getID() {
                return $this->id;
            }
            public function setID($value) {
                $this->id = $value;
            }

            public function getImage() {
                return $this->image;
            }
            public function setImage($value) {
                $this->image = $value;
            }

            public function getComment() {
                return $this->comment;
            }
            public function setComment($value) {
                $this->comment = $value;
            }

            public function getUserID() {
                return $this->userID;
            }
            public function setUserID($value) {
                $this->userID = $value;
            }
    }
?>