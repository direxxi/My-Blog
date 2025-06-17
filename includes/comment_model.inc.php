<?php
declare(strict_types=1);
require_once 'configsesh.inc.php';

function getPost(object $pdo, int $user_id){
    $query = 'SELECT id FROM posts WHERE users_id = :user_id;';
    $prpd_stmt = $pdo->prepare($query);
    $prpd_stmt -> bindParam(':user_id',$user_id);
    $prpd_stmt->execute();
    $result = $prpd_stmt->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
}

function postComments(object $pdo, string $comment, int $user_id, int $post_id){
    $query = 'INSERT INTO comments(comment_text,user_id,post_id) VALUES(:comment,:user_id,:post_id);';
    $prpd_stmt = $pdo -> prepare($query);
    $prpd_stmt -> bindParam(':comment',$comment);
    $prpd_stmt -> bindParam(':user_id',$user_id);
    $prpd_stmt -> bindParam(':post_id', $post_id);
    
    $prpd_stmt -> execute();
}

function viewAllComments(object $pdo, int $post_id) {
    $query = 'SELECT comments.comment_text, comments.created_at, users.username 
              FROM comments 
              JOIN users ON comments.user_id = users.id 
              WHERE comments.post_id = :post_id 
              ORDER BY comments.created_at DESC;';
              
    $prpd_stmt = $pdo->prepare($query);
    $prpd_stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $prpd_stmt->execute();

    return $prpd_stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getCommentCount(object $pdo,$post_id): int {
    $query = 'SELECT COUNT(*) AS total_comments
     FROM comments
     WHERE comments.post_id =:post_id';
    $prpd_stmt = $pdo->prepare($query);
    $prpd_stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $prpd_stmt->execute();
    
    $result = $prpd_stmt->fetch(PDO::FETCH_ASSOC);
    return (int) $result['total_comments'];
}