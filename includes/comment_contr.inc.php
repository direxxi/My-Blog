<?php
declare(strict_types=1);

function commentEmpty(string $comment){
    if(empty($comment)){
        return true;
    }else{
        return false;
    }
}