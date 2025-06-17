<?php
declare(strict_types=1);
require_once 'dbh.inc.php';


function get_username(object $pdo, string $username){
    $query = 'SELECT username FROM users WHERE username = :username;';
    $prpd_stmt = $pdo -> prepare($query);
    $prpd_stmt -> bindParam(':username', $username);
    $prpd_stmt -> execute();

    $results = $prpd_stmt -> fetch(PDO::FETCH_ASSOC);
    return $results;
}

function get_email(object $pdo, string $email){
    $query = 'SELECT email FROM users WHERE email = :email;';
    $prpd_stmt = $pdo -> prepare($query);
    $prpd_stmt -> bindParam(':email', $email);
    $prpd_stmt -> execute();

    $results = $prpd_stmt -> fetch(PDO::FETCH_ASSOC);
    return $results;
}

function create_user(object $pdo, string $username, string $email, string $pwd, string $role, string $fileDestinations){
    $query = 'INSERT INTO users(username,email,pwd,roles,profile_pic) VALUES(:username,:email,:hashed_pwd,:roles,:profile_pic);';
    $prpd_stmt = $pdo -> prepare($query);
    $options = [
        'cost' => 12
    ];

    $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT,$options);
    
    $prpd_stmt -> bindParam(':username',$username);
    $prpd_stmt -> bindParam(':email', $email);
    $prpd_stmt -> bindParam(':hashed_pwd', $hashed_pwd);
    $prpd_stmt -> bindParam(':roles', $role);
    $prpd_stmt -> bindParam(':profile_pic',$fileDestinations);
    $prpd_stmt -> execute();

}
function get_ProfilePic(object $pdo, string $user_id){
    $query = 'SELECT profile_pic FROM users WHERE id = :user_id;';
    $prpd_stmt = $pdo -> prepare($query);
    $prpd_stmt -> bindParam(':user_id', $user_id);
    $prpd_stmt -> execute();

    $get_pic = $prpd_stmt -> fetch(PDO::FETCH_ASSOC);
    return $get_pic;
}