<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once 'configsesh.inc.php';
require_once 'dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {

    if (!isset($_FILES['profile_pic']) || $_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK) {
        echo "No file uploaded or there was an error.";
        exit;
    }

    $file = $_FILES['profile_pic'];

    $filename = $file['name'];
    $fileTmpname = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = ['jpg', 'jpeg', 'png', 'pdf'];

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) { // 10MB
                $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
                $uploadDir = 'uploads/';
                $filePlacer = $uploadDir . $fileNameNew;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); // create if not exists
                }

                if (move_uploaded_file($fileTmpname, $filePlacer)) {
                    echo "File uploaded successfully!<br>";

                    // Save to DB
                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                        $stmt = $pdo->prepare("UPDATE users SET profile_pic = :pic WHERE id = :id");
                        $stmt->execute([
                            ':pic' => $fileNameNew,
                            ':id' => $user_id
                        ]);
                        echo "Profile picture updated!";
                        header("Location: ../profile.php");
                        exit;
                    } else {
                        echo "User session not found.";
                    }
                } else {
                    echo "❌ File failed to move.";
                }
            } else {
                echo "❌ File is too large.";
            }
        } else {
            echo "❌ Upload error.";
        }
    } else {
        echo "❌ You cannot upload files of this type.";
    }
}
