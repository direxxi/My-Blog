<?php

declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $remember = isset($_POST['remember']);

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';


        // ERROR HANDLERS
        $errors = [];
     
        if (empty_inputs($username, $pwd)) {
            $errors['empty_input'] = 'Please fill all fields';
        };

        $results = user_present($pdo, $username);

        if (!$results) { // Check if user exists
            $errors['wrong_user'] = 'Wrong username';
        } else {
            $hashed_pwd = $results['pwd']; // Fetch password hash from DB

            if (pass_match($pwd, $hashed_pwd) && !user_match($results)) {
                $errors['wrong_login'] = 'Incorrect Login Info';
            }
        };
       


        if (count($errors) > 0) {
            $_SESSION['login_errors'] = $errors;
            header('Location: ../login.php');
            die();
        };

        require_once 'configsesh.inc.php';

        $_SESSION['user_id'] = $results['id'];
        $_SESSION['username'] = htmlspecialchars($results['username']);

        $newsessionid = session_create_id();
        $sessionid = $newsessionid .'_'. $_SESSION['user_id'];
        session_id($sessionid);

        if($remember){
            $remembers = $_POST['remember'];
            setcookie('remember_user', $username,time() + 3600 * 24 * 30,'/', 'localhost',true,true);
            setcookie('remember',$remembers,time() + 3600 * 24 * 30,'/', 'localhost',true,true);
        }else{
            setcookie('remember_user','',time() -3600 , '/');
            setcookie('remember','',time() -3600, '/' );
        }

        header('Location: ../index.php');
        $pdo = null;
        $prpd_stmt =null;
        die();

    } catch (PDOException $e) {
        die('Query Failed: ' . $e->getMessage());
    };
} else {
    header('Location: ../login.php');
    exit();
};
