<?php
declare(strict_types=1);
require_once 'configsesh.inc.php';

function error_avail(){
    if(isset($_SESSION['login_errors'])){
        $errors = $_SESSION['login_errors'];

        echo "<div class='error-messages' style='color: red;'>";

        foreach($errors as $err){
            echo "<p>$err</p>";
        }

        echo "</div>";

        unset($_SESSION['login_errors']);
    }
};

