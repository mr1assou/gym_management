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
    <!-- start pop up -->
    <div class="absolute bg-black w-full h-full z-20 opacity-100 flex items-center justify-center pop-up hidden">
        <div class="bg-white flex-col p-10 rounded-lg">
            <p class="text-black font-bold">Are you Sure The client pay new month?</p>
            <div class="flex mt-5">
                <a href="" class="block bg-green-dark  text-white  transition duration-100 ease-in-out hover:scale-110 px-5 py-2 rounded-md yes">yes</a>
                <button href="" class="block text-black bg-grey  transition duration-100 ease-in-out hover:scale-110 ml-5 px-5 py-2 rounded-md no">no</button>
            </div>
        </div>
    </div>
    <!-- end pop up -->
    <div class="min-h-[100vh] flex gap-1">
        <!-- sidebar -->
        <?php 
            sidebar($userId,$gymId);
        ?>
        <!-- content -->
        <div class="md:basis-[82%] basis-[100%]" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
        <!-- second part-->
     <div class="flex-col justify-between w-full  gap-2 mt-3 relative p-2">
                    <div class="w-full shadow-[0_3px_10px_rgb(0,0,0,0.2)] p-2">
                        <div class="w-full p-5 md:flex flex-row items-center justify-between px-2 py-7 bg-white rounded-xl">
                            <div class="md:basis-[30%] basis-[100%]  flex md:flex-col justify-between items-center mt-1">
                                <div class="flex items-center">
                                    <i class="fa-regular fa-user text-orange fa-6x lg:fa-4x text-green"></i>
                                    <p class="md:ml-3 ml-10 font-black md:text-[15px] text-[10px]  ">New Clients This month:</p>
                                </div>
                                <p class="md:mt-5 font-bold text-s"><?php echo newClientsOfThisMonth($conn,$gymId)?><span></span></p>
                            </div>
                            <div class="md:basis-[30%] basis-[100%] flex md:flex-col  justify-between items-center md:mt-0 mt-10">
                                <div class="flex items-center">
                                      <i class="fa-solid fa-user-check text-green fa-6x md:fa-4x"></i>
                                    <p class="ml-3 font-black md:text-[15px] text-[10px]">Active Members:</p>
                                </div>
                                <p class="md:mt-4 font-bold text-sm "><?php echo activeMembers($conn,$gymId)?><span>
                                </span></p>
                            </div>
                            <div class="md:basis-[30%] basis-[100%] flex md:flex-col  justify-between items-center md:mt-0 mt-10">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-money-bill-1-wave fa-6x md:fa-4x text-orange text-green"></i>
                                    <p class="md:ml-3 ml-5 font-black md:text-[15px] text-[10px]">Earning of this month:</p>
                                </div>
                                <p class="md:mt-3 font-bold text-sm "><span><?php echo earningThisMonth($conn,$gymId,date('m'));
                                ?></span> DH</p>
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
    <script src="../js/dashboard.js" type="module"></script>
</body>
</html>