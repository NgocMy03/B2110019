<?php
    $user = 'scott';
    $pass = '';
    $link = oci_connect($user,$pass,'ORCL');//ham dung ket noi Oracle database
    if(!$link){
        $error = oci_error();
        echo $error['message'];
        exit();
    }
?>