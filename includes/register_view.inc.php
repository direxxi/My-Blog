<?php
declare(strict_types=1);
require_once 'configsesh.inc.php';

function error_avail(){
    if(isset($_SESSION['error_avail'])){
        $errors = $_SESSION['error_avail'];

        echo "<div class='error-messages' style='color: red;'>";

        foreach($errors as $err){
            echo "<p>$err</p>";
        }

        echo "</div>";

        unset($_SESSION['error_avail']);
    }
};

