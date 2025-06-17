<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_POST['title'];
    $category_name = $_POST['category_name'];
    $content = $_POST['content'];

try {
require_once 'dbh.inc.php';  
require_once 'configsesh.inc.php';
require_once 'post_model.inc.php';
require_once 'post_contr.inc.php';
    // ERROR HANDLERS
$error = [];
if(is_InputEmpty($title,$category_name,$content)){
    $error['Empty Inputs'] = 'Fill all Fields';
}
if(is_ContentLong($content)){
    $error['Content Long'] = 'Reduce Content';
}

if(count($error) > 0){
    $_SESSION['error_post'] = $error;
    header('Location:../posts.php');
    die();
}

require_once 'upload.inc.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in!");
}

$user_id = $_SESSION['user_id'];



createPost($pdo, $title, $category_name, $content, $fileDestination, $user_id);

header('Location:../index.php');
 $pdo = null;
$prpd_stmt = null;





} catch (PDOException $e) {
    die('Query Failed:' . $e -> getMessage());
}


}else{
    header('Location:../landing.php');
    die();
}

