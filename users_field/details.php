<?php
    include "../functions/functions.php";
    include '../vendor/connect.php';
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php');
        exit;
    }
    $userId=$_GET['user_id'];
    $gymId=$_GET['gym_id'];
    searchForm($userId,$gymId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../output.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../output.css">
    <!-- cdn font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body>
    <div class="min-h-[100vh] flex gap-1">
        <!-- sidebar -->
        <?php 
            sidebar($userId,$gymId);
        ?>
        <!-- content -->
        <div class="md:basis-[82%] basis-[100%]" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
        <!-- second part-->
        <div class="px-1">
        <div class="flex-col justify-between w-full  gap-2 mt-3 relative p-10 shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                <p class="text-center text-4xl text-green font-bold">Client Information</p>
                <div class="w-full mt-2 text-[7px] md:text-[15px]">
                    <div class="md:flex flex-row p-5">
                        <?php informationClient($conn,$_GET['client_id']);?>
                    </div>                         
                </div>
                <?php displayDetailsClients($conn,$gymId,$userId,$_GET['client_id']) ?>
            </div>
        </div>
            <p class="text-center text-black font-black text-2xl mt-5 px-2">Earning from this client:<span class="text-green ml-3 total-price">400</span><span class="text-green">DH</span></p>
        </div> 
    </div>
    <!-- javascript -->
    <script type="module" src="../js/details.js"></script>
</body>
</html>