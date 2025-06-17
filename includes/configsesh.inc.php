<?php

ini_set('session.use_only_cookies',1);
ini_set('session.use_strict_mode',1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

function regenerator_logged_in(){
    $user_id = $_SESSION['user_id'];
    session_regenerate_id(true);
    $newsessionid = session_create_id();
    $sessionid = $newsessionid .'_'. $user_id;
    if (session_status() === PHP_SESSION_NONE) {
        session_id($sessionid);
    }
}


function regenerator(){
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}


if(isset($_SESSION['user_id'])){
    regenerator_logged_in();
}else{
    if(!isset($_SESSION['last_regeneration'])){
        regenerator();
    }else{
        $interval = 60 * 30;
        if(time()- $_SESSION['last_regeneration'] >= $interval){
            regenerator();
        }
    }
}



