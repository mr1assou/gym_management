<?php
    include "../functions/functions.php";
    include '../vendor/connect.php';
    session_start();
    checkSessionAdmin();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php?language='.$_GET['language'].'');
        exit;
    }
    searchFormUser();
    if(isset($_POST['pay'])){
        $paymentDate=$_POST['beginning_date'];
        if($_GET['language']!="en")
            $paymentDate=implode("-",array_reverse(explode("-",$paymentDate)));
        pay($conn,$_SESSION['gym_id'],$_POST['client_id'],$paymentDate,$_POST['kind'],$_POST['price']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
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
            sidebarUser();
        ?>
        <!-- content -->
        <div class="xl:basis-[82%] basis-[100%]" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
        <!-- second part-->
     <div class="flex-col justify-between w-full  gap-2 mt-3 relative p-2">
                    <div class="w-full shadow-[0_3px_10px_rgb(0,0,0,0.2)] p-2">
                        <div class="w-full p-5 md:flex flex-row items-center justify-center px-2 py-7 bg-white rounded-xl">
                       
                        <?php
                            if($_GET['language']=='en'){
                                echo '<div class="md:basis-[30%] basis-[100%]  flex md:flex-col justify-between items-center mt-1"> 
                                <div class="flex items-center">
                                    <i class="fa-regular fa-user text-orange fa-6x lg:fa-4x text-green"></i>
                                    <p class="md:ml-3 ml-10 font-black md:text-[15px] text-[10px] ">New Clients This month:</p>
                                </div>
                                <p class="md:mt-5 font-bold text-xs">'.newUsersOfThisMonth($conn).'<span></span></p></div>';
                            }
                            else{
                                echo '  <div class="md:basis-[30%] basis-[100%]  flex flex-row-reverse md:flex-col justify-between items-center mt-1 ">
                                    <div class="flex items-center">
                                        <p class="md:mr-3 mr-10 font-black md:text-[15px] text-[10px] ">  :المتدربين الجدد هذا الشهر</p>
                                        <i class="fa-regular fa-user text-orange fa-6x lg:fa-4x     text-green"></i>
                                    </div>
                                    <p class="md:mt-5 font-bold text-xs">'.newUsersOfThisMonth($conn).'<span></span></p>
                                 </div>';
                            }
                        ?>
                            </div>                    
                        </div>
            </div>
            <!-- information -->
                <?php
                    selectUsersDashboard($conn);
                ?>
            </div>
        </div> 
    </div>
    <script src="../js/responsive_admin.js"></script>
    <script src="../js/user_status_color.js"></script>
    <!-- javascript -->
</body>
</html>