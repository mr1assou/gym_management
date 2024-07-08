<?php
    include "../functions/functions.php";
    include '../vendor/connect.php';
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php?language='.$_POST['language'].'');
        exit;
    }
    searchForm($_SESSION['user_id'],$_SESSION['gym_id']);
    if($_SESSION['status']=='reject'){
        header('location:./payment.php');
    }
    $query="{CALL selectInformationOfUser(?)}";
    $outcome=sqlsrv_query($conn,$query,array($_SESSION['user_id']));
    $row=sqlsrv_fetch_array($outcome);
    if(isset($_POST['change'])){
        $profile_image=$_FILES['image'];
        $path='../images/'.$profile_image['name'];
        if($profile_image['size']==0){
            $path=$row['user_image'];
        }
        move_uploaded_file($profile_image['tmp_name'], $path);
        $query="{CALL updateUser(?,?)}";
        $result=sqlsrv_query($conn,$query,array($_SESSION['user_id'],$path));
        header('Location:./settings.php?language='.$_POST['language'].'');
    }
    $countActualPassword=0;
    $countCompatibility=0;
    $countSuccess=0;
    if(isset($_POST['change_password'])){
        $actualPassword=htmlspecialchars($_POST['actual_password']);
        $newPassword=htmlspecialchars($_POST['new_password']);
        $repeatNewPassword=htmlspecialchars($_POST['repeat_new_password']);
        $query="{CALL checkActualPassword(?)}";
        $result=sqlsrv_query($conn,$query,array($_SESSION['user_id']));
        $password=sqlsrv_fetch_array($result);
        if(!password_verify($actualPassword,$password['password'])){
            $countActualPassword++;
        }
        else if($newPassword!=$repeatNewPassword){
            $countCompatibility++;
        }
        else{
            $query="{CALL changePassword(?,?)}";
            $result=sqlsrv_query($conn,$query,array($_SESSION['user_id'],password_hash( $newPassword,PASSWORD_DEFAULT)));
            $countSuccess++;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
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
        <div class="flex-col  justify-between w-full  gap-2 mt-3 relative p-10 shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                <p class="text-center text-4xl text-green font-bold">Account Information</p>
                <div class="w-full mt-2 text-[7px] md:text-[15px]">
                    <form class="md:flex flex-row p-5" action="" method="post" enctype="multipart/form-data">
                        <?php informationUser($conn,$_SESSION['gym_id'],$row);?> 
                    </form>                         
                </div>
                <?php
                    if($_GET['language']=="en")
                        echo ' <p class="text-center text-4xl text-green font-bold mt-5">Change Password</p>';
                    else
                        echo '<p class="text-center text-4xl text-green font-bold mt-5">
                    تغيير كلمة المرور</p>';
                ?>
               
                <div class="flex justify-center">
                <form class="  z-10  rounded-md  md:w-[40%] md:px-[2%] w-[100%] px-5 py-2 " action="" method="post">
                <?php
                if($countActualPassword!=0)
                    echo '<p class="font-bold text-red">your actual password is incorrect</p>';
                else if($countCompatibility!=0){
                    echo '<p class="font-bold text-red">please repeat your new password twice</p>';
                }
                else if($countSuccess!=0){
                    echo '<p class="text-green-dark mt-2 font-bold text-2xl alert hidden">you change your password succefully</p>';
                     echo '<script>const alert=document.querySelector(".alert");
                        function alertDanger(aler){
                            alert.classList.remove("hidden");
                            alert.classList.add("block");
                            setTimeout(()=>{
                                alert.classList.remove("block");
                                alert.classList.add("hidden");
                            },5000)
                        }
                       alertDanger(alert);
                    </script>';
                }
                ?>
                            <div class="flex  gap-2 mt-10 items-center basis-[50%]">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Actual Password:</p>
                                <input type="text" name="actual_password"  class="text-black font-bold basis-[60%] text-start bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value=""/>
                            </div>
                            <div class="flex  gap-2 mt-10 items-center basis-[50%]">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">New password:</p>
                                <input type="text" name="new_password"  class="text-black font-bold basis-[60%] text-start bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value=""/>
                            </div>
                            <div class="flex  gap-2 mt-10 items-center basis-[50%]">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Repeat new password:</p>
                                <input type="text" name="repeat_new_password"  class="text-black font-bold basis-[60%] text-start bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value=""/>
                            </div>
                            <div class="flex justify-end gap-2 mt-5 items-center basis-[50%]">
                                <input type="submit" name="change_password" value="Change password" class="mt-5 px-5 py-2 block text-white rounded-md  bg-green scale-110 cursor-pointer hover:bg-white border border-solid hover:text-green font-bold"/>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div> 
    </div>
    <!-- javascript -->
    <script type="module" src="../js/settings.js"></script>
</body>
</html>