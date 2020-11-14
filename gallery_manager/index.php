<?php
require('../model/database.php');
require('../model/user.php');
require('../model/user_db.php');
require('../model/gallerypost.php');
require('../model/gallery_db.php');
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'view';
    }
}
switch ($action) {
    case 'view':
        $posts = GalleryDB::getPosts();
        include('view.php');
        break;
    case 'post':
        $error = '';
        include('post.php');
        break;
    case 'upload':
    $uploads_dir = '../img/gallery_uploads/';
    $isValid = true;
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $temp = $_FILES['image']['name'];
        $temp = explode('.', $temp);
        $temp = end($temp);
        $file_ext = strtolower($temp);
        $extensions = array("jpeg", "jpg", "png", "gif");
        // Check if it's a proper file extension
        if (in_array($file_ext, $extensions) === false) {
            $error = "file extension not in whitelist: " . join(',', $extensions);
            $isValid = false;
        }
        // Check file size             
        if ($_FILES['image']['size'] > 1000000) {
            $error = "File upload is too large.";
            $isValid = false;
        }

        if ($isValid == true) {
            $comment = filter_input(INPUT_POST, 'gallery_text');
            if(isset($_SESSION["user_id"])){
                $user = $_SESSION["user_id"];
            } else {
                $user = "0000";
            }
            if(empty($comment)){
                $comment = "No Comment";
            } 
            $uni = uniqid(); 
            $file_name = $uni . $file_name;
            $upload_name = $uploads_dir . $file_name;
            $i = new GalleryPost($upload_name, $comment, $user);
            GalleryDB::addPost($i);
            move_uploaded_file($file_tmp, "$uploads_dir/$file_name");
            $error = "Success!";
            include('post.php');
        } else {
            include('../errors/error.php');
        }
    }
    break;
    case 'delete':
        $user = $_SESSION["user_id"];
        $userTest = UserDB::authenticationUserType($user);
        $posts = GalleryDB::getPosts();
        if($userTest[0] === '3'){
            $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
            GalleryDB::deletePost($post_id);
            include('view.php');
        } else{
            $pass_message = '';
            $user_message = 'Sorry, admins only.';
            // $user_message = $userTest[0];
            $email_message = '';
            include('user_profile.php');
        }
    break;
}
?>