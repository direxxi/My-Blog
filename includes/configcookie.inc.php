<?php

require_once 'login_model.inc.php';


ini_set('session.use_only_cookies',1);


if($remember){
    $token = hex2bin(random_bytes(32));
  setcookie('remember',$token,time() + 2592000,'/','localhost',true,true);
}
