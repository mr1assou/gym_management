<?php
    require dirname(__DIR__) ."/vendor/autoload.php";
    $dotenv=Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $serverName =$_ENV["HOSTNAME"]; 
    $database =$_ENV["DATABASE_NAME"];
    $connectionInfo = array(
        "Database" => $database,
        "uid"=>$_ENV["USERNAME"],
        "pwd"=>$_ENV["PASSWORD"]
    );
    $conn =sqlsrv_connect($serverName, $connectionInfo);
?>
