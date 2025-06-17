<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once 'includes/dbh.inc.php';
require_once 'includes/configsesh.inc.php';
require_once 'includes/uploader_model.inc.php';
require_once 'includes/register_model.inc.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <button class="close-button" onclick="window.history.back()">×</button>
        
        <section class="profile-section">
            <h2>Profile picture</h2>
            <div class="profile-picture-container">
            <?php

if (isset($_SESSION['user_id'])) {
    $profile_data = get_ProfilePic($pdo, $_SESSION['user_id']);
    $profile_pic = isset($profile_data['profile_pic']) ? htmlspecialchars($profile_data['profile_pic']) : 'default.jpg';
    echo '<img class="profile_pic" id="profileImg" src="includes/' . $profile_pic . '" alt="Profile Picture">';

    
          echo '<div class="picture-buttons">
              <button type="button" class="change-picture">Upload Picture</button>
              <form action="delete_picture.php" method="POST" style="display:inline;">
                  <input type="hidden" name="delete_picture" value="1">
                  <button type="submit" class="delete-picture">Delete Picture</button>
              </form>
          </div>
          <form id="uploadForm" action="includes/profile.inc.php" method="POST" enctype="multipart/form-data" style="display:none;">
              <input type="file" id="fileInput" name="profile_pic" accept="image/*">
              <input type="submit" name="upload" value="Save Picture">
          </form>';
}
?>

            </div>
        </section>
     
        <section class="profile-section">
            <h2>Username</h2>
            <div class="username-input-container">
                <span class="at-symbol">@</span>
                <input type="text" value="kevinunhuy" class="profile-input username-input">
            </div>
            <p class="availability-text">Available change in 25/04/2024</p>
        </section>

        <section class="profile-section">
            <h2>Status recently</h2>
            <input type="text" value="On duty" class="profile-input">
        </section>

        <section class="profile-section">
            <h2>About me</h2>
            <textarea class="profile-input about-me"></textarea>
        </section>

        <button class="save-changes">Save changes</button>
    </div>

    <script>
    document.querySelector('.change-picture').addEventListener('click', function () {
        document.getElementById('fileInput').click();
    });

    document.getElementById('fileInput').addEventListener('change', function () {
        document.getElementById('uploadForm').submit();
    });
</script>
</body>
</html>