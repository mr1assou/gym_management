<?php
    include '../vendor/connect.php';
    include '../functions/functions.php';
    session_start();
    $userId=$_GET['user_id'];
    $gymId=$_GET['gym_id'];
    $count=0;
    $clientFirstName="";
    $clientLastName="";
    $clientPhoneNumber="";
    $image="";
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php');
        exit;
    }
    if(isset($_POST['submit'])){
        $clientFirstName=htmlspecialchars($_POST['client_first_name']);
        $clientLastName=htmlspecialchars($_POST['client_last_name']);
        $clientPhoneNumber=htmlspecialchars($_POST['phone_number']);
        $profile_image=$_FILES['profile_image'];
        $path='../images/'.$profile_image['name'];
        move_uploaded_file($profile_image['tmp_name'], $path);
        $query="{CALL addClientForGym(?,?,?,?,?)}";
        $result=sqlsrv_query($conn,$query,array($clientFirstName,$clientLastName,$clientPhoneNumber,$gymId,$path));
        if($result){
            echo "<script>window.open('./add_client.php?status=success&user_id=$userId&gym_id=$gymId','_self');</script>"; 
        }
        else{
            $count++;
        }
    }
    searchForm($userId,$gymId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
             sidebar($userId,$gymId);
        ?>
        <!-- content -->
        <div class="md:basis-[82%] basis-[100%] z-0" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
            <div class="flex justify-center w-full px-3">
             <form class="mt-10 mr-0 md:mr-20 z-10 bg-white rounded-md shadow-[0_3px_10px_rgb(0,0,0,0.2)] md:w-[40%] md:px-[2%] md:py-[1%] w-[100%] px-5 py-2" action="" method="post" post" enctype="multipart/form-data">
         <p class="text-center text-4xl text-green font-bold">Add Client</p>
              <?php
                if($count!=0)
                    echo '<small class="text-red font-bold mt-5">Client already exist in your gym</small>';
            ?>
              <?php
                if(isset($_GET['status'])){
                    echo '<p class="text-green mt-2 font-bold text-2xl alert hidden">Client Added succefully</p>';
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
                <div class="relative h-11 w-full min-w-[200px] mt-10">
                    <input required type="text" pattern="^(?:[a-z]+|[A-Z]+|[a-zA-Z]+)$"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="client_first_name" value="<?php echo $clientFirstName?>"/>
                    <label
                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Client First Name:
                </label>
            </div>
                <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <input required type="text" pattern="^(?:[a-z]+|[A-Z]+|[a-zA-Z]+)$"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="client_last_name" value="<?php echo $clientLastName?>"/>
                    <label
                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Client Last Name:
                </label>
            </div>
                
                <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <input  pattern="0[0-9]{9}" name="phone_number"  required value="<?php echo $clientPhoneNumber?>"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"/>
                    <label
                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Client Phone Number:(0123456789)
                </label>
            </div>
                <div class="relative min-h-11 w-full min-w-[200px] mt-5 py-3">
                    <input  type="file" name="profile_image" required
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent  font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 py-2"/>
                    <label
                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                image:
                </label>
            </div>
                <div class="relative h-11 w-full min-w-[200px] mt-2">
                    <label
                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                payment date:
                </label>
                <div class=" absolute left-0 top-[35%] flex w-full items-center">
                <i class="fa-solid fa-calendar text-green fa-2x cursor-pointer transition duration-200 hover:scale-125  toggle-calendar block basis-[10%] "></i>
                <p class="basis-[80%] ml-5 font-bold  text-green">13-06-2024</p>
            </div>
            </div> 
             <div class="flex justify-end mt-5">
                <input  type="submit" value="Add Client" name="submit" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110 ">
            </div>
        </form> 
        </div>
         <!-- calendar -->
        <div class="absolute w-8/12 flex items-center justify-between flex-col bg- z-80 bg-grey    text-black border-orange rounded-xl p-3 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] calendar">
                                <p class="alert w-full text-center bg-red-500 text-white p-2 m-1 rounded-full text-sm hidden">you can't choose this day</p>
                                <div class="w-full flex justify-between items-center mt-1">
                                
                                <p class="text-xl font-bold text-orange text-left w-full current-date"></p>
                                <div class="flex text-orange">
                                    <button class="text-4xl bg-white mr-2 rounded-full p-2 hover:bg-orange hover:text-white cursor-pointer prev"><</p>
                                    <button class="text-4xl bg-white rounded-full p-2 hover:bg-orange hover:text-white cursor-pointer next">></button>
                                </div>
                                </div>
                                <div class="grid grid-cols-7 gap-3 w-full mt-2">
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Mon</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Thu</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">wed</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Thu</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Fri</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Sat</p>
                                    <p class=" text-brown font-bold  w-[3rem]  col-span-1 text-center flex items-center justify-center ">Sun</p>
                                </div>           
                                <div class="grid grid-cols-7 gap-3 w-full justify-between items-center mt-2 days">
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                <p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3   text-green text-sm">1</p>
                                </div>           
                            </div>

        <!-- end calendar -->   
    </div>
    <!-- javascript -->
    <script src="../js/dashboard.js" type="module"></script>
</body>
</html>