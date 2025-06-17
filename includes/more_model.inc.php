<?php
declare(strict_types=1);

require_once 'dbh.inc.php';
require_once 'configsesh.inc.php';

function getMore(object $pdo){

    $query = 'SELECT posts.id, posts.title, posts.content, posts.images, posts.created_at, users.username 
          FROM posts 
          JOIN users ON posts.users_id = users.id 
          WHERE posts.category_id = 6 
          ORDER BY posts.created_at DESC 
          LIMIT 3;';

    $prpd_stmt = $pdo -> prepare($query);
    $prpd_stmt -> execute();

    $display_view = $prpd_stmt -> fetchAll(PDO::FETCH_ASSOC);
    return $display_view ? $display_view : null;
}
