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
        <div class="basis-[82%] " style="padding-left:10px;">
            <?php include '../includes/header.php'?>
        <!-- second part-->
     <div class="flex-col justify-between w-full  gap-2 mt-3 relative p-2 ">
                    <div class="w-full shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                        <div class="w-full p-5  flex items-center justify-between px-2 py-7 bg-white rounded-xl">
                            <div class="basis-[30%]  flex flex-col justify-between items-center">
                                <div class="flex items-center">
                                    <i class="fa-regular fa-user text-orange fa-4x text-green"></i>
                                    <p class="ml-3 font-black">New Clients This month:</p>
                                </div>
                                <p class="mt-5 font-bold text-s">20<span></span></p>
                            </div>
                            <div class="basis-[30%] flex flex-col justify-between items-center">
                                <div class="flex items-center">
                                      <i class="fa-solid fa-user-check text-green fa-4x"></i>
                                    <p class="ml-3 font-black">Active Members:</p>
                                </div>
                                <p class="mt-4 font-bold text-sm "><?php echo activeMembers($conn,$gymId)?><span>
                                </span></p>
                            </div>
                            <div class="basis-[30%] flex flex-col justify-between items-center">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-money-bill-1-wave fa-4x text-orange text-green"></i>
                                    <p class="ml-3 font-black">Earning of this month:</p>
                                </div>
                                <p class="mt-3 font-bold text-s"><span>1000</span> DH</p>
                            </div>
                        </div>
            </div>
            <!-- information -->
        <div class="w-full bg-white p-3 mt-3 rounded-md shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                <?php
                    selectClientsDashboard($conn,$gymId,$userId);
                ?>
                </div>
            </div>
        </div> 
    </div>
    <!-- javascript -->
    <script src="../js/dashboard.js"></script>
</body>
</html>