<?php
declare(strict_types=1);

require_once 'post_model.inc.php';
require_once 'upload.inc.php';


function is_InputEmpty(string $title, string $category_name, string $content){
    if(empty($title) || empty($category_name) ||empty($content)){
        return true;
    }else{
        return false;
    }
}
function is_ContentLong(string $content){
    $max_length = 65535;
    if(strlen($content) > $max_length){
        return true;
    }else{
        return false;
    }
}


