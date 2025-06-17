<?php
declare(strict_types=1);


require_once 'dbh.inc.php';
require_once 'configsesh.inc.php';

function getDisplay(object $pdo){
    $query = 'SELECT posts.id AS postId, posts.title, posts.content, posts.images, posts.created_at,users.username, users.profile_pic FROM posts
    JOIN users ON posts.users_id = users.id
     LIMIT 3;';

    $prpd_stmt = $pdo -> prepare($query);
    $prpd_stmt -> execute();

    $display = $prpd_stmt -> fetchAll(PDO::FETCH_ASSOC);
    return $display ? $display : null;
}

$totalquery = 'SELECT COUNT(*) FROM posts';
$total_prpdtsmt = $pdo->prepare($totalquery);
$total_prpdtsmt->execute();  // Execute the query
$totalpost = $total_prpdtsmt->fetchColumn();  // Get the total number of posts

$postperpage = 5;
$totalpage = ceil($totalpost / $postperpage); // Round up to avoid incomplete pages




