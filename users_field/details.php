<?php
    include "../functions/functions.php";
    include '../vendor/connect.php';
    session_start();
    checkSession();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php?language='.$_GET['language'].'');
        exit;
    }
    searchForm($_SESSION['user_id'],$_SESSION['gym_id']);
    if($_SESSION['status']=='reject'){
        header('location:./payment.php?language='.$_GET['language'].'');
    }
    $query="{CALL selectInformationOfClient(?)}";
    $stmt1=sqlsrv_prepare($conn,$query,array($_GET['client_id']));
    $outcome=sqlsrv_execute($stmt1);
    $row=sqlsrv_fetch_array($stmt1);
    if(isset($_POST['change'])){
        $phoneNumber=$_POST['phone_number'];
        $profile_image=$_FILES['image'];
        $path='../images/'.$profile_image['name'];
        if($profile_image['size']==0){
            $path=$row['client_image'];
        }
        move_uploaded_file($profile_image['tmp_name'], $path);
        $query="{CALL updateClient(?,?,?)}";
        $stmt2=sqlsrv_prepare($conn,$query,array($path,$phoneNumber,$_GET['client_id']));
        $result=sqlsrv_execute($stmt2);
        header("Location: ./details.php?client_id=" . $_GET['client_id'] . "&language=" . $_GET['language']);
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
<?php   
        echo '<p class="language hidden">'.$_GET['language'].'</p>';
    ?>
    <div class="min-h-[100vh] flex gap-1">
        <!-- sidebar -->
        <?php 
            sidebar($conn,$_SESSION['user_id'],$_SESSION['gym_id']);
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
                معلومات المستخدم</p>';
                ?>
                <div class="w-full mt-2 text-[10px] md:text-[15px]">
                    <form class="xl:flex xl:flex-row flex flex-col items-center  xl:p-5 p-0 " action="" method="post" enctype="multipart/form-data">
                        <?php informationClient($conn,$_SESSION['gym_id'],$row);?> 
                    </form>                         
                </div>
                <?php displayDetailsClients($conn,$_SESSION['gym_id'],$_SESSION['user_id'],$_GET['client_id']) ?>
            </div>
        </div>
            <?php
                if($_GET['language']=="en"){
                    echo '<p class="text-center text-black font-black xl:text-2xl text-xl mt-5 p-10">Earning from this client:<span class="text-green ml-3 total-price"></span><span class="text-green">DH</span></p>';
                }
                else{
                    echo '<p class="text-center text-black font-black xl:text-2xl text-xl mt-5 p-10"><span class="text-green"></span>ربحت من هذا المتدرب:<span class="text-green mt-5 mr-3 total-price"></span><span class="text-green"> درهم  </span></p>';
                }
            ?>
        </div> 
    </div>
    <!-- javascript -->
    <script type="module" src="../js/details.js"></script>
</body>
</html>