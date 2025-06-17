<?php

if(isset($_POST['post-btn'])){
    $file = $_FILES['fileToUpload'];


    $filename = $_FILES['fileToUpload']['name'];
    $fileTmpname = $_FILES['fileToUpload']['tmp_name'];
    $fileSize = $_FILES['fileToUpload']['size'];
    $fileError = $_FILES['fileToUpload']['error'];
    $fileType = $_FILES['fileToUpload']['type'];

    $fileExt = explode('.',$filename);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = ['jpg','jpeg','png','pdf'];

        if (in_array($fileActualExt, $allowed)){
             if($fileError === 0){
                if($fileSize < 10000000){
                     $fileNameNew = uniqid('',true). '.' . $fileActualExt;
                     $fileDestination = 'Uploads/' .$fileNameNew;
                     if (file_exists($fileTmpname)) {
                        echo "Temp file exists: $fileTmpname <br>";
                    } else {
                        echo "Temp file does NOT exist! <br>";
                    }
                    
                    if (!is_dir('Uploads')) {
                        echo "Uploads folder does NOT exist! <br>";
                    }
                    
                    if (move_uploaded_file($fileTmpname, $fileDestination)) {
                        echo "File moved successfully!";
                    } else {
                        echo "Failed to move file!";
                    }
                     $fileDestination = 'Uploads/' .$fileNameNew;
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