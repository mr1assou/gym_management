<?php
    include "../functions/functions.php";
    include '../vendor/connect.php';
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php');
        exit;
    }
    searchForm($_SESSION['user_id'],$_SESSION['gym_id']);
    if($_SESSION['status']=='reject'){
        header('location:./payment.php');
    }
    $query="{CALL selectInformationOfClient(?)}";
    $outcome=sqlsrv_query($conn,$query,array($_GET['client_id']));
    $row=sqlsrv_fetch_array($outcome);
    if(isset($_POST['change'])){
        $phoneNumber=$_POST['phone_number'];
        $price=$_POST['price'];
        $profile_image=$_FILES['image'];
        $path='../images/'.$profile_image['name'];
        if($profile_image['size']==0){
            $path=$row['client_image'];
        }
        move_uploaded_file($profile_image['tmp_name'], $path);
        $query="{CALL updateClient(?,?,?,?)}";
        $result=sqlsrv_query($conn,$query,array($path,$phoneNumber,$price,$_GET['client_id']));
        header("Location: ./details.php?client_id=" . $_GET['client_id']);
    }
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
    <div class="min-h-[100vh] flex gap-1">
        <!-- sidebar -->
        <?php 
            sidebar($_SESSION['user_id'],$_SESSION['gym_id']);
        ?>
        <!-- content -->
        <div class="md:basis-[82%] basis-[100%]" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
        <!-- second part-->
        <div class="px-1">
        <div class="flex-col justify-between w-full  gap-2 mt-3 relative p-10 shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                <p class="text-center text-4xl text-green font-bold">Client Information</p>
                <div class="w-full mt-2 text-[7px] md:text-[15px]">
                    <form class="md:flex flex-row p-5" action="" method="post" enctype="multipart/form-data">
                        <?php informationClient($conn,$_SESSION['gym_id'],$row);?> 
                    </form>                         
                </div>
                <?php displayDetailsClients($conn,$_SESSION['gym_id'],$_SESSION['user_id'],$_GET['client_id']) ?>
            </div>
        </div>
            <p class="text-center text-black font-black text-2xl mt-5 p-10">Earning from this client:<span class="text-green ml-3 total-price"></span><span class="text-green">DH</span></p>
        </div> 
    </div>
    <!-- javascript -->
    <script type="module" src="../js/details.js"></script>
</body>
</html>