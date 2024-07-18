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
        userPay($conn,$_POST['client_id'],$_POST['kind']);
    }
    $query="{CALL selectInformationEachUser(?)}";
    $outcome=sqlsrv_query($conn,$query,array($_GET['client_id']));
    $row=sqlsrv_fetch_array($outcome);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
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
<?php   
        echo '<p class="language hidden">'.$_GET['language'].'</p>';
    ?>
    <div class="min-h-[100vh] flex gap-1">
        <!-- sidebar -->
        <?php 
            sidebarUser();
        ?>
        <!-- content -->
        <div class="md:basis-[82%] basis-[100%]" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
        <!-- second part-->
        <div class="px-1">
        <div class="flex-col justify-between w-full  gap-2 mt-3 relative xl:p-10 p-5 shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                <?php
                    if($_GET['language']=="en")
                        echo '  <p class="text-center text-4xl text-green font-bold">Client Information</p>';
                    else
                        echo '<p class="text-center text-4xl text-green font-bold">
            معلومات العميل</p>';
                ?>
                <div class="w-full mt-2 text-[10px] md:text-[15px]">
                    <form class="xl:flex xl:flex-row flex flex-col items-center  xl:p-5 p-0 " action="" method="post" enctype="multipart/form-data">
                        <?php informationEachUser($conn,$row);?> 
                    </form>                         
                </div>
                <?php //displayDetailsClients($conn,$_SESSION['gym_id'],$_SESSION['user_id'],$_GET['client_id']) ?>
            </div>
        </div>
        </div> 
    </div>
    <!-- javascript -->
</body>
</html>
