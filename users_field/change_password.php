<?php
    include '../vendor/connect.php'; 
    $countCompatibility=0;
    $countSuccess=0;
    if(isset($_POST['change_password'])){
        $newPassword=htmlspecialchars($_POST['new_password']);
        $repeatNewPassword=htmlspecialchars($_POST['repeat_new_password']);
        if($newPassword!=$repeatNewPassword){
            $countCompatibility++;
        }
        else{
            $query="{CALL changePsw(?,?,?)}";
            $result=sqlsrv_query($conn,$query,array($_GET['email'],$_GET['code'],password_hash( $newPassword,PASSWORD_DEFAULT)));
            header('location:./login.php');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../output.css">
</head>
<body>
    <div class="absolute bg-green right-0 top-0 w-[70%]  z-0 h-full" style="clip-path: polygon(74% 0, 100% 0, 100% 100%, 22% 100%);"></div>
    <div class="w-full h-screen bg-black px-[3%] py-[2%]">
        <!-- nav bar -->
        <nav class="text-white flex justify-between items-center">
        <div class="flex items-center z-10">
                <img src="../images/logo.png"  class="block md:w-[65px] md:h-[65px] w-[30px] h-[30px]">
                <p class="ml-3 md:text-1xl text-xs font-black ">Gym Manager</p>
            </div>
            <div class="flex items-center mb-2 z-10">
            <a href="./login.php" class="block text-black bg-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs mr-2 md:mr-5">Login</a>
            <a href="../index.php" class="block bg-black text-white font-bold px-6 py-[9px] transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs">Home</a>
            </div>
        </nav>
        <!--  -->
        <p class="text-green  md:text-4xl md:text-center text-start text-2xl md:mt-1 mt-10 ">Change your password</p>
        <div class=" w-full mt-2 flex pt-7">
        <div class="  w-full  flex  items-start justify-center ">
            <form class="z-10 bg-white rounded-md mt-2 p-5 w-full md:w-[40%] md:px-[2%] md:py-[1%]" action="" method="post">
            <?php
                if($countCompatibility!=0)
                    echo '<p class="font-bold text-red">please repeat the same code twice</p>';
            ?>
                <div class="flex  gap-2 mt-10 items-center basis-[50%]">
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">New password:</p>
                        <input type="text" name="new_password"  class="text-black font-bold basis-[60%] text-start bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value=""/>
                </div>
                <div class="flex  gap-2 mt-10 items-center basis-[50%]">
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Repeat new password:</p>
                        <input type="text" name="repeat_new_password"  class="text-black font-bold basis-[60%] text-start bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value=""/>
                </div>
            <div class="flex justify-end mt-5 items-center">  
                <input  type="submit" value="Change" name="change_password" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110">
            </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<!-- end -->