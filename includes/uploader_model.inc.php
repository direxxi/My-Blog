<?php
declare(strict_types=1);

require_once 'dbh.inc.php';
require_once 'configsesh.inc.php';
require_once 'uploader.inc.php';
function uploadProfile_pic( object $pdo, string $filePlacer, int $user_id){
    $query = "UPDATE users SET profile_pic = :profile_pic WHERE id = :user_id";
    $prpd_stmt = $pdo -> prepare($query);
    $prpd_stmt -> bindParam('profile_pic',$filePlacer);
    $prpd_stmt -> bindParam('user_id', $user_id);
    $prpd_stmt -> execute();
  }
  