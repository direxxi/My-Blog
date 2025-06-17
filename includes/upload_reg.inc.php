<?php

if(isset($_POST['login-btn'])){
    $file = $_FILES['profilepic'];


    $filename = $_FILES['profilepic']['name'];
    $fileTmpname = $_FILES['profilepic']['tmp_name'];
    $fileSize = $_FILES['profilepic']['size'];
    $fileError = $_FILES['profilepic']['error'];
    $fileType = $_FILES['profilepic']['type'];

    $fileExt = explode('.',$filename);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = ['jpg','jpeg','png','pdf'];

        if (in_array($fileActualExt, $allowed)){
             if($fileError === 0){
                if($fileSize < 100000000){
                     $fileNameNew = uniqid('',true). '.' . $fileActualExt;
                     $fileDestinations = 'Uploads/' .$fileNameNew;
                     if (file_exists($fileTmpname)) {
                        echo "Temp file exists: $fileTmpname <br>";
                    } else {
                        echo "Temp file does NOT exist! <br>";
                    }
                    
                    if (!is_dir('Uploads')) {
                        echo "Uploads folder does NOT exist! <br>";
                    }
                    
                    if (move_uploaded_file($fileTmpname, $fileDestinations)) {
                        echo "File moved successfully!";
                    } else {
                        echo "Failed to move file!";
                    }
                     $fileDestinations = 'Uploads/' .$fileNameNew;
                    //  move_uploaded_file($fileTmpname,$fileDestination );
                }else{
                    echo 'Your File is too Big';
                }
             }else{
                echo 'There was an error somewhere!'; 
             }
        }else{
            echo 'You can not upload Files of this type';
        }
}