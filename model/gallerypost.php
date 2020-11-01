<?php 
class GalleryPost {
            private $id, $image, $comment, $commenterID;
        
            public function __construct($image, $comment, $recorder_id) {
                $this->image = $image;
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

            public function getRecorderID() {
                return $this->recorder_id;
            }
            public function setRecorderID($value) {
                $this->recorder_id = $value;
            }
    }
?>