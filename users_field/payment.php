<?php
    include '../vendor/connect.php';
    include '../functions/functions.php';
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php');
        exit;
    }
    searchForm($_SESSION['user_id'],$_SESSION['gym_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
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
        <div class="md:basis-[82%] basis-[100%] z-0" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
            <div class="flex justify-center w-full px-3 py-10">
             <form class=" mr-0 md:mr-20 z-10 bg-white rounded-md shadow-[0_3px_10px_rgb(0,0,0,0.2)] md:w-[40%] md:px-[2%] md:py-[1%] w-[100%] px-5 py-2" action="" method="post"  enctype="multipart/form-data">
         <p class="text-center text-4xl text-green font-bold">Add Client</p>
                
        </form> 
                </div>         
    </div>
    </div>
    <!-- javascript -->
    <script src="../js/add_client.js" type="module"></script>
</body>
</html>





