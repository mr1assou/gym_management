<?php
    include '../vendor/connect.php'; 
    $query="{CALL confirmClientTrialPriod(?)}";
    $result=sqlsrv_query($conn,$query,array($_GET['client_id']));
    $referrer = isset($_SERVER['HTTP_REFERER']) ?  : 'Unknown';
    header("Location: " . $_SERVER['HTTP_REFERER']);