<?php

declare(strict_types=1);


function user_present(object $pdo, string $username){
    $query = 'SELECT * FROM users WHERE username = :username;';
    $prpd_stmt = $pdo -> prepare($query);
    $prpd_stmt -> bindParam(':username', $username);
    $prpd_stmt -> execute();

    $results = $prpd_stmt -> fetch(PDO::FETCH_ASSOC);
    return $results;
}

