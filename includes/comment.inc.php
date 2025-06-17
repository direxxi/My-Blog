<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'];
    $post_id = (int) $_POST['post_id'];

    try {
        require_once 'dbh.inc.php';
        require_once 'configsesh.inc.php';
        require_once 'comment_model.inc.php';
        require_once 'comment_contr.inc.php';

        // Error handlers
        $errors = [];
        
        if (commentEmpty($comment)) {
            $errors['Empty Inputs'] = 'Fill before Posting';
        }

        if (count($errors) > 0) {
            $_SESSION['error_comment'] = $errors;
            header('Location: ../landing.php?post_id=' . $post_id);
            exit();
        }

        if (!isset($_SESSION['user_id'])) {
            die("Error: User not logged in!");
        }

        $user_id = $_SESSION['user_id'];
        
        postComments($pdo, $comment, $user_id, $post_id);
        
        // Redirect back to the same post
        header('Location: ../landing.php?post_id=' . $post_id);
        exit();
        
    } catch (PDOException $e) {
        die('Query Failed: ' . $e->getMessage());
    }
} else {
    header("Location: ../landing.php");
    exit();
}