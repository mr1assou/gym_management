<?php
    $serverName = "DESKTOP-CM47KIG"; 
    $database = "gym_management";
    $connectionInfo = array(
        "Database" => $database,
        "uid"=>"php",
        "pwd"=>"php1"
    );
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    // if($conn){
    //     echo "connection good";
    // }
    // else{
    //     die( print_r( sqlsrv_errors(), true));
    // }

    $query = "{CALL addSupervisorAndGym(?, ?, ?, ?, ?,?,?)}";
    $params = array('j', 'waller', '0635103092', 'jwaller@gmail.com', '000','ox','500');
    $result= sqlsrv_query($conn, $query);
    $result = sqlsrv_query($conn, $query, $params);
    if($result){
        echo "good";
    }   
    
?>
