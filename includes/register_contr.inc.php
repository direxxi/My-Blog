<?php
declare(strict_types=1);

function empty_inputs(string $username, string $email, string $pwd, string $role){
    if(empty($username) || empty($email) || empty($pwd) || empty($role)){
        return true;
    }else{
        return false;
    }
}

function invalid_email(string $email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}

function password_length(string $pwd){
    if(!strlen($pwd) > 7){
        return true;
    }else{
        return false;
    }
}

function username_taken(object $pdo, string $username){
    if(get_username($pdo,$username)){
        return true;
    }else{
        return false;
    }
}

function email_registered(object $pdo, string $email){
    if(get_email($pdo,$email)){
        return true;
    }else{
        return false;
    }
}

