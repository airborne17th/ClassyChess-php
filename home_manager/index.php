<?php
require('../model/database.php');
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'home_index';
    }
}
switch ($action) {
    case 'about':
        include('about.php');
        break;
    case 'contact':
        include('contact.php');
        break;
    case 'home_index':
        include('../index.php');
    break;
 
}
?>