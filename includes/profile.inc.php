<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    require_once 'dbh.inc.php';
    require_once 'uploader_model.inc.php';
    require_once 'uploader.inc.php';
    require_once 'configsesh.inc.php';

    // Make sure the user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("User is not logged in.");
    }

    $user_id = $_SESSION['user_id'];

    // Check if a file was uploaded
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        // You can process and move the uploaded file here
        $filePlacer = $_FILES['profile_pic']; // This will be passed to your upload function
        uploadProfile_pic($pdo, $filePlacer, $user_id);
        header('Location: ../profile.php');
        exit();
    } else {
        throw new Exception("No file uploaded or file upload error.");
    }

} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage();
}
