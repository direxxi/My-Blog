<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $role = $_POST['roles'];
    $profile_pic = $_POST['fileToUpload'];

    try {
       require_once 'dbh.inc.php';
       require_once 'register_model.inc.php';
       require_once 'register_contr.inc.php';
       require_once 'upload_reg.inc.php';

    //    ERROR HANDLER
    //      EMPTY INPUTS
    $errors =[];
    if(empty_inputs($username,$email,$pwd,$role)){
        $errors['empty_inputs'] = 'Please fill all fields';
    }

    // INVALID EMAIL
    if(invalid_email($email)){
        $errors['invalid_email'] = 'The email is not a valid email';
    }

    // PASSWORD LENGTH
    if(password_length($pwd)){
        $errors['password_length'] = 'Password is less than 7 characters';
    }

    // IS USERNAME TAKEN
    if(username_taken($pdo,$username)){
        $errors['username_taken'] = ' This username has been taken';

    }

    //IS EMAIL ALREADY REGISTERED
    if(email_registered($pdo,$email)){
        $errors['email_registered'] = 'this email is already registered';
     
    }

    require_once 'configsesh.inc.php';
    if(count($errors) > 0){
        $_SESSION['errors_avail'] = $errors;
        header('Location:../register.php');
        die();
    }

    create_user($pdo,$username,$email,$pwd,$role,$fileDestinations);
    header('Location:..//login.php');
    $pdo = null;
    $prpd_stmt = null;

    die();


    } catch (PDOException $e) {
        die('Query Failed:' . $e -> getMessage());
    }
}else{
    header('Location:../register.php');
    die();
}