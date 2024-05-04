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

    // $query = "{CALL addSupervisorAndGym(?, ?, ?, ?, ?,?,?)}";
    // $params = array('rz', 'w', '0635103092', 'r@gmail.com', '000','ox','500');
    // $result= sqlsrv_query($conn, $query);
    // $result = sqlsrv_query($conn, $query, $params);
    // if($result){
    //     echo "good";
    // }   
    
?>
