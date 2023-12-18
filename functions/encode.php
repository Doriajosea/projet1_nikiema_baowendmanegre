<?php

function encodePwd(string $pwd){

    $salt = 'UnPeuDeSel123@';
    $encodedPwd = hash('sha1', $pwd.$salt);

    return $encodedPwd;
}

?>