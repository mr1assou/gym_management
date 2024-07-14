<?php
    include "../functions/functions.php";
    include '../vendor/connect.php';
    session_start();
    checkSession();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php?language='.$_GET['language'].'');
        exit;
    }
    if(isset($_POST['submit'])){
        $description=htmlspecialchars($_POST['description']);
        $amount=htmlspecialchars($_POST['amount']);
        $query="{CALL addFee(?,?,?)}";
        $result=sqlsrv_query($conn,$query,array($description,$amount,$_SESSION['gym_id']));
    }
    searchForm($_SESSION['user_id'],$_SESSION['gym_id']);
    if($_SESSION['status']=='reject'){
        header('location:./payment.php?language='.$_GET['language'].'');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Fee</title>
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
    <!-- start pop up -->
    <?php   
        echo '<p class="language hidden">'.$_GET['language'].'</p>';
    ?>
    <div class="fixed bg-black w-full h-full z-20 opacity-100 flex items-center justify-center pop-up hidden">
        <div class="bg-white flex-col rounded-lg items-center py-5 px-10 w-[35%] h-[50%]">
            <p class="font-bold text-green name">Marwane Assou</p>
            <p class="font-bold text-[11px] text-green mt-10">Last Operation:</p>
            <div class="flex mt-2">
                <div class=" basis-[55%] flex text-[11px]">
                    <p class="text-green font-black">start:</p>
                    <p class="textx-center text-black ml-1 start font-bold">14-07-2024</p>
                </div>
                <div class=" basis-[55%] flex text-[11px]">
                    <p class="text-green font-black">end:</p>
                    <p class="textx-center text-black ml-1 end font-bold">14-08-2024</p>
                </div>
            </div>            
            <form action="" method="post" class="flex-col mt-5 ">
            <input type="text" name="client_id" value="0" class="client-id hidden"/>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <label
                        class="mt-2 after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 text-[11px]">
                baginning date:
                </label>
                <div class=" absolute left-0 top-[70%] flex w-full items-center justify-between">
                    <input type="text" name="beginning_date" class="bg-green input-date px-2 text-white" pattern="\d{4}-\d{1,2}-\d{1,2}" required />
                    <i class="fa-solid fa-calendar text-green fa-2x cursor-pointer transition duration-200 hover:scale-125  toggle-calendar block toggle-calendar"></i>  
                </div>
                <div class="absolute w-full flex items-center justify-between flex-col bg- z-10 bg-grey text-black border-orange rounded-xl p-3 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] calendar right-[-400px] top-[-260px] hidden">
                                <div class="w-full flex justify-between items-center mt-1">
                                <p class="text-xl font-bold text-orange text-left w-full current-date text-green"></p>
                                <div class="flex text-orange">
                                    <button class="text-lg bg-white mr-2 rounded-full p-2 hover:bg-orange text-green   cursor-pointer prev hover:bg-green hover:text-white font-black"><</p>
                                    <button class="text-lg bg-white rounded-full p-2 hover:bg-orange text-green   cursor-pointer next hover:bg-green hover:text-white font-black">></button>
                                </div>
                                </div>
                                <div class="grid grid-cols-7 gap-3 w-full mt-2">
                                    <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center">Mon</p>
                                    <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">Thu</p>
                                    <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">wed</p>
                                    <p class=" text-brown font-bold w-[2rem]  col-span-1 text-center flex items-center justify-center text-xs">Thu</p>
                                    <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">Fri</p>
                                    <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">Sat</p>
                                    <p class=" text-brown font-bold  w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">Sun</p>
                                </div>           
                                <div class="grid grid-cols-7 gap-4 w-full justify-between items-center mt-2 days">
                                </div>           
                            </div>
                            <!-- end calendar -->
            </div>
            <div class="flex justify-end mt-20">
                <input type="submit" value="pay" name="pay" class="block cursor-pointer bg-green-dark  text-white  transition duration-100 ease-in-out hover:scale-110 px-5 py-2 rounded-md">
                <button href="" class="block text-black bg-grey  transition duration-100 ease-in-out hover:scale-110 ml-5 px-5 py-2 rounded-md no">no</button>
            </div>
        </form>
    </div>
    </div>
    <div class="absolute bg-black w-full h-full z-20 opacity-100 flex items-center justify-center pop-up hidden">
        <div class="bg-white flex-col p-10 rounded-lg">
            <p class="text-black font-bold">Are you Sure The client pay new month?</p>
            <div class="flex mt-5">
                <a href="" class="block bg-green-dark  text-white  transition duration-100 ease-in-out hover:scale-110 px-5 py-2 rounded-md yes">yes</a>
                <button href="" class="block text-black bg-grey  transition duration-100 ease-in-out hover:scale-110 ml-5 px-5 py-2 rounded-md no">no</button>
            </div>
        </div>
    </div>
    <div class="min-h-[100vh] flex gap-1">
        <!-- sidebar -->
        <?php 
            sidebar($_SESSION['user_id'],$_SESSION['gym_id']);
        ?>
        <!-- content -->
        <div class="md:basis-[82%] basis-[100%]" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
        <!-- second part-->
         <?php
            if($_GET['language']=="en"){
                echo '<p class="text-center text-2xl text-green font-bold mt-3 title">Add Fees</p>';
            }
            else{
                echo '<p class="text-center text-2xl text-green font-bold mt-3 title">إضافة مصاريف</p>';
            }
         ?>
        
     <div class="flex-col justify-between w-full  gap-2 mt-3 relative p-2 ">
            <!-- information -->
        <div class="w-full bg-white p-3 mt-3 rounded-md shadow-[0_3px_10px_rgb(0,0,0,0.2)]">                                          
            <form class="w-full xl:flex xl:flex-row xl:items-center flex flex-col" action="" method="post">
            <div class="basis-[70%] xl:flex xl:flex-row xl:items-center xl:justify-evenly">
                <div class="mb-5 ">
                    <?php
                        if($_GET['language']=="en")
                            echo ' <label for="email" class="block mb-2 text-sm font-mediumdark:text-white text-gray-500 ">Your description:</label>';
                        else
                            echo ' <label for="email" class="block mb-2 text-sm font-medium dark:text-white text-gray-500 text-end">:الحدث</label>';
                    ?>
                    <textarea name="description" class="text-sm rounded-lg  block w-full p-2.5  focus:border-green "   placeholder="description"></textarea>
                </div>
                <div class="mb-5">
                    <?php
                        if($_GET['language']=="en")
                            echo '<label for="password" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">amount:</label>';
                        else
                            echo '<label for="password" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white text-end">:المبلغ</label>';
                    ?>
                    <input type="number" name="amount"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
            </div>
                <div class="basis-[30%] items-center flex justify-center">
                <?php
                        if($_GET['language']=="en")
                            echo '<input type="submit" name="submit" value="Add" class="px-10 py-2 block text-white rounded-md  bg-green scale-110 cursor-pointer hover:bg-white border border-solid hover:text-green font-bold"/>';
                        else
                            echo '<input type="submit" name="submit" value="إضافة" class="px-10 py-2 block text-white rounded-md  bg-green scale-110 cursor-pointer hover:bg-white border border-solid hover:text-green font-bold"/>';
                    ?>  
                </div>
            </form>
                </div>
                <!-- display fees of this month-->
                <?php
                    if($_GET['language']=="en")
                        echo '<p class="text-green text-center text-2xl font-black mt-10">Fees Of This Month</p>';
                    else
                        echo '<p class="text-green text-center text-2xl font-black mt-10">
                مصاريف هذا الشهر</p>'
                ?>
                <?php displayFee($conn,$_SESSION['gym_id'],date('m'),date('Y')); ?>
                <!-- end -->
            </div>
        </div> 
    </div>
    <!-- javascript -->
    <script src="../js/add_fee.js" type="module"></script>
</body>
</html>