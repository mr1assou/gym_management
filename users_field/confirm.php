<?php
    include '../vendor/connect.php'; 
    $query="{CALL confirmClient(?)}";
    $result=sqlsrv_query($conn,$query,array($_GET['client_id']));
    if($result){
        echo "good";
    }
    else{
        echo "not good";
    }