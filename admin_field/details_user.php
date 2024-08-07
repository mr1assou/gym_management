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
        $query="{CALL resetUser(?)}";
        $stmt1=sqlsrv_prepare($conn,$query,array($_GET['client_id']));
        $result=sqlsrv_execute($stmt1);
    }
    $query="{CALL selectInformationEachUser(?)}";
    $stmt2=sqlsrv_prepare($conn,$query,array($_GET['client_id']));
    $outcome=sqlsrv_execute($stmt2);
    $row=sqlsrv_fetch_array($stmt2);

    $sql = "SELECT dbo.catchGymAccess(?) AS numAccess";
    $stmt3=sqlsrv_prepare($conn,$sql,array($_GET['client_id']));
    $result=sqlsrv_execute($stmt3);
    $result=sqlsrv_fetch_array($stmt3);
    $numAccess=$result['numAccess'];
    
    $sql = "SELECT dbo.catchGymExpired(?) AS numExpired";
    $stmt3=sqlsrv_prepare($conn,$sql,array($_GET['client_id']));
    $result=sqlsrv_execute($stmt3);
    $result=sqlsrv_fetch_array($stmt3);
    $numExpired=$result['numExpired'];
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
    <!-- start pop up -->
    
    <div class="fixed bg-black w-full h-full z-50 opacity-100 flex items-center justify-center pop-up hidden">
        <div class=" flex-col rounded-lg items-center py-5 px-10 w-full xl:w-[35%] 
        xl:h-[40%] h-[50%] bg-white">
            
            <!-- ------------------------------------------------------------ -->
            <form action="" method="post" class="flex-col mt-5">
            <input type="text" name="client_id" value="0" class="client-id invisible"/>
            <p class="text-red font-bold">you want to reset informations of client?</p>
            <div class="flex justify-end mt-20">
                    <input type="submit" value="pay" name="pay" class="block cursor-pointer bg-green-dark  text-white  transition duration-100 ease-in-out hover:scale-110 px-5 py-2 rounded-md"><button href="" class="block text-black bg-grey  transition duration-100 ease-in-out hover:scale-110 ml-5 px-5 py-2 rounded-md no">no</button>
            </div>
        </form>
    </div>
    </div>
    <!-- end pop up -->
<?php   
        echo '<p class="language hidden">'.$_GET['language'].'</p>';
    ?>
    <div class="min-h-[100vh] flex gap-1">
        <!-- sidebar -->
        <?php 
            sidebarUser();
        ?>
        <!-- content -->
         <?php 
            echo '<p class="user_id hidden">'.$_GET['client_id'].'</p>';
         ?>
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
                        <input type="number" class="input hidden">
                        <?php informationEachUser($conn,$row,$numAccess,$numExpired);?> 
                    </form>                         
                </div>
                <?php displayDetailsEachUser($conn,$_GET['client_id']) ?>
            </div>
        </div>
        </div> 
    </div>
    <script src="../js/responsive_admin.js"></script>
    <script src="../js/reset.js"></script>
    <!-- javascript -->
</body>
</html>
