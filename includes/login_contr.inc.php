<?php
declare(strict_types=1);

function empty_inputs(string $username, string $pwd){
    if(empty($username) || empty($pwd)){
        return true;
    }else{
        return false;
    }
}

function user_match(bool|array $results){
    if(!$results){
        return true;
    }else{
        return false;
    }
}

function pass_match(string $pwd, string $hashed_pwd){
    if(!password_verify($pwd,$hashed_pwd)){
        return true;
    }else{
        return false;
    }
}
// function auto_logged(string $token, string $hashed_token){
//     if(password_verify($token,$hashed_token)){
//         return true;
//     }else{
//         return false;
//     }
// }