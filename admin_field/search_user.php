<?php
    include "../functions/functions.php";
    include '../vendor/connect.php';
    session_start();
    checkSessionAdmin();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php?language='.$_GET['language'].'');
        exit;
    }
    $clientName=$_GET['client_name'];
    searchFormUser();
    if(isset($_POST['pay'])){
        userPay($conn,$_POST['client_id'],$_POST['kind']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
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
    <!-- start pop up -->
    <?php   
        echo '<p class="language hidden">'.$_GET['language'].'</p>';
    ?>
    <div class="fixed bg-black w-full h-full z-50 opacity-100 flex items-center justify-center pop-up hidden">
        <div class="bg-white flex-col rounded-lg items-center py-5 px-10 w-full xl:w-[35%] 
        xl:h-[70%] h-[70%]">
            <?php
                if($_GET['language']=="en"){ 
                echo '<p class="title hidden">Dashboard</p>';
                    echo ' <p class="font-bold text-green name">Marwane Assou</p>
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
                    </div>';}
                else{
                    echo '<p class="title hidden">لوحة التحكم</p>';
                    echo ' <p class="font-bold text-green name text-end">Marwane Assou</p>
                    <p class="font-bold text-[11px] text-green mt-10 text-end">:أخر عملية</p>
                    <div class="flex mt-2">
                    <div class=" basis-[55%] flex text-[11px] justify-end">
                        <p class="textx-center text-black ml-1 end font-bold mr-1">14-08-2024</p>
                        <p class="text-green font-black">:النهاية</p>
                    </div>
                    <div class=" basis-[55%] flex text-[11px] justify-end">
                        <p class="textx-center text-black ml-1 start font-bold mr-1">14-07-2024</p>
                          <p class="text-green font-black">:البداية</p>
                    </div>
                    </div>';
                }
            ?>
                    
            <form action="" method="post" class="flex-col mt-5">
            <input type="text" name="client_id" value="0" class="client-id hidden"/>
            <div class="relative h-11 w-full min-w-[200px] mt-5"> 
            <div class="flex items-center justify-center mt-2 py-2">    
            <?php
                if($_GET['language']=="ar")
                    echo '<div class="flex items-center mt-3">
                    <input name="kind" type="radio" value="yearly"  class="w-4 h-4 text-green bg-green role " required>
                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">سنوي</label>
                </div>
                <div class="flex items-center mt-3 ml-10">
                    <input name="kind" type="radio" value="monthly"  class=" role w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required>
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">شهري</label>
                </div>';
                else
                    echo '<div class="flex items-center mt-3">
                        <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 mr-2">yearly</label>
                        <input name="kind" type="radio" value="yearly"  class="w-4 h-4 text-green bg-green role" required>
                        
                    </div>
                    <div class="flex items-center mt-3 ml-10">
                         <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 mr-2">monthly</label>
                        <input name="kind" type="radio" value="monthly"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 role" required>
                    
                    </div>';
            ?>     
                
            </div>
                <?php
                if($_GET['language']=='ar'){
                    echo '<label
                        class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                :نوع الدفع
                </label>';
                }
                    else{
                        echo '<label
                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                kind of payment:
                </label>';
                    }
                ?>
            </div>
            <div class="price-field">

            </div>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <?php
                    if($_GET['language']=="en")
                        echo '<label
                        class="mt-2 pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 text-[11px]">
                baginning date:
                     </label>';
                    else
                    echo '<label
                    class="mt-2 justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 text-[11px]">
            :تاريخ البداية
            </label>';
                ?>
                    
                <div class=" absolute left-0 top-[70%] flex w-full items-center justify-between">
                <?php
                        if($_GET['language']=="ar")
                            echo ' <input type="text" name="beginning_date" class="bg-green input-date px-2 text-white" pattern="\d{1,2}-\d{1,2}-\d{4}" required />';
                        else
                            echo ' <input type="text" name="beginning_date" class="bg-green input-date px-2 text-white" pattern="\d{4}-\d{1,2}-\d{1,2}" required />';
                    ?>
                    <i class="fa-solid fa-calendar text-green fa-2x cursor-pointer transition duration-200 hover:scale-125  toggle-calendar block toggle-calendar"></i>  
                </div>
                <div class="absolute w-full flex items-center justify-between flex-col bg- z-10 bg-grey text-black border-orange rounded-xl p-3 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] calendar xl:right-[-400px] xl:top-[-260px] top-[-300px]    hidden">
                <p class="text-red font-bold text-1xl message"></p>
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
                <?php
                    if($_GET['language']=="en")
                        echo '<input type="submit" value="pay" name="pay" class="block cursor-pointer bg-green-dark  text-white  transition duration-100 ease-in-out hover:scale-110 px-5 py-2 rounded-md"><button href="" class="block text-black bg-grey  transition duration-100 ease-in-out hover:scale-110 ml-5 px-5 py-2 rounded-md no">no</button>';
                    else
                        echo '<input type="submit" value="تأكيد" name="pay" class="block cursor-pointer bg-green-dark  text-white  transition duration-100 ease-in-out hover:scale-110 px-5 py-2 rounded-md"><button href="" class="block text-black bg-grey  transition duration-100 ease-in-out hover:scale-110 ml-5 px-5 py-2 rounded-md no">إلغاء</button>';
                ?>
                
                
            </div>
        </form>
    </div>
    </div>
    <!-- end pop up -->
    <div class="min-h-[100vh] flex gap-1">
        <!-- sidebar -->
        <?php 
            sidebarUser();
        ?>
        <!-- content -->
        <div class="md:basis-[82%] basis-[100%]" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
        <!-- second part-->
     <div class="flex-col justify-between w-full  gap-2 mt-5 relative p-2 ">
            <!-- information -->
            <?php
                if($_GET['language']=="en")
                    echo ' <p class="text-center text-4xl text-green font-bold">Search Client</p>';
                else
                echo ' <p class="text-center text-4xl text-green font-bold">البحث عن عميل</p>';
            ?>
             
        <div class="w-full bg-white p-3 mt-5 rounded-md shadow-[0_3px_10px_rgb(0,0,0,0.2)] content">
                <?php
                    searchUser($conn,$clientName);
                ?>
                </div>
            </div>
        </div> 
    </div>
    <!-- javascript -->
    
</body>
</html>