<?php
ini_set('display_errors', 0);
include_once 'vendor/autoload.php';

use Pages\Header;
use Pages\Dashboard;
use Pages\Login;
use App\Auth;
use App\Helpers\Label;

$get_table = isset($_GET['table']) ? $_GET['table'] : '';
$get_action = isset($_GET['action']) ? $_GET['action'] : '';
$get_id = isset($_GET['id']) ? $_GET['id'] : '';

if (!Auth::isAuthenticated()) {
    include('login.php');
    exit;
}
if (isset($_POST['destroyed'])) {
    session_start();
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}


switch ($get_table) {
    case '':
        $menu_item = Header::getHeader($get_table);
        include('header.php');
        include('dashboard.php');
        break;
    default:
        $menu_item = Header::getHeader($get_table);
        include('header.php');
        include('pages/crud.php');
        break;
}