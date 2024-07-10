<?php
    include '../vendor/connect.php';
    include '../functions/functions.php';
    session_start();
    checkSession();
    $count=0;
    $clientFirstName="";
    $clientLastName="";
    $clientPhoneNumber="";
    $image="";
    $price="";
    $paymentDate="";
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php?language='.$_GET['language'].'');
        exit;
    }
    if(isset($_POST['submit'])){
        $clientFirstName=htmlspecialchars($_POST['client_first_name']);
        $clientLastName=htmlspecialchars($_POST['client_last_name']);
        $clientPhoneNumber=htmlspecialchars($_POST['phone_number']);
        $price=htmlspecialchars($_POST['price']);
        $paymentDate=htmlspecialchars($_POST['payment_date']);
        if($_GET['language']!="en")
            $paymentDate=implode("-",array_reverse(explode("-",$paymentDate)));
        $profile_image=$_FILES['profile_image'];
        $path='../images/'.$profile_image['name'];
        move_uploaded_file($profile_image['tmp_name'], $path);
        if($profile_image['size']==0){
            $path='../images/empty_profile.png';
        }
        $query="{CALL addClientForGym(?,?,?,?,?,?,?)}";
        $result=sqlsrv_query($conn,$query,array($clientFirstName,$clientLastName,$clientPhoneNumber,$_SESSION['gym_id'],$path,$price,$paymentDate));
        if($result){
            echo "<script>window.open('./add_client.php?status=success&language=" . $_GET['language'] . "','_self');</script>";

        }
        else{
            $count++;
        }
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
    <title>Add Client</title>
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
        <div class="md:basis-[82%] basis-[100%] z-0" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
            <div class="flex justify-center w-full px-3 py-10">
             <form class=" mr-0 md:mr-20 z-10 bg-white rounded-md shadow-[0_3px_10px_rgb(0,0,0,0.2)] md:w-[40%] md:px-[2%] md:py-[1%] w-[100%] px-5 py-2" action="" method="post"  enctype="multipart/form-data">
            <?php
                if($_GET['language']=="en"){
                    echo '<p class="text-center text-4xl text-green font-bold title">Add Client</p>';
                }
                else
                echo '<p class="text-center mb-5 text-4xl text-green font-bold title">إضافة متدرب</p>';
            ?>
            
              <?php
                if($count!=0 && $_GET['language']=="en")
                    echo '<small class="text-red font-bold pt-5 ">Client already exist in your gym</small>';
                else if($count!=0 && $_GET['language']=="ar")
                    echo '<small class="text-red font-bold pt-5 ">العميل موجود بالفعل في صالة الألعاب الرياضية الخاصة بك</small>';
            ?>
              <?php
                if(isset($_GET['status'])){
                    if($_GET['language']=="en")
                        echo '<p class="text-green-dark mt-2 font-bold text-2xl alert hidden">Client Added succefully</p>';
                    else 
                        echo '<p class="text-green-dark mt-2 font-bold text-2xl alert hidden">تمت إضافة المتدرب بنجاح</p>';
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
                   
                <?php
                    if($_GET['language']=="en")
                        echo ' <label
                    class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Client First Name:
                </label>';
                    else
                    echo ' <label
                    class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                : الإسم الشخصي  للمتدرب
                </label>';
                ?>
            </div>
                <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <input required type="text" pattern="^(?:[a-z]+|[A-Z]+|[a-zA-Z]+)$"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="client_last_name" value="<?php echo $clientLastName?>"/>
                <?php
                    if($_GET['language']=="en")
                        echo ' <label
                    class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Client Last Name:
                </label>';
                    else
                    echo ' <label
                    class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                :الإسم العائلي  للمتدرب
                </label>';
                ?>
            </div>
                <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <input  pattern="0[0-9]{9}" name="phone_number"  required value="<?php echo $clientPhoneNumber?>"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"/>
                    
                <?php
                if( $_GET['language']=='ar'){
                    echo '<label
                class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                رقم الهاتف :(0123456789)
                </label>';
                }
                    else {
                        echo '<label
                class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Phone number:(0123456789)
                </label>';
                    }
                ?>
            </div>
                <div class="relative min-h-11 w-full min-w-[200px] mt-5 py-3">
                    <input  type="file" name="profile_image"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent  font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 py-2" value="<?php echo $image?>"/>
                    <?php
                if($_GET['language']=='ar'){
                    echo '<label
                        class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        :صورة المتدرب              
                    </label>';
                }
                    else{
                        echo '<label
                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                image:
                </label>';
                    }
                ?>
            </div>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <input   name="price" type="number" min="0"  required value="<?php ?>"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" value="<?php echo $price?>"/>
                <?php
                if($_GET['language']=='ar'){
                    echo '<label
                        class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                :الواجب الشهري للمتدرب
                </label>';
                }
                    else{
                        echo '<label
                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Price for client:
                </label>';
                    }
                ?>
            </div>
                <div class="relative h-11 w-full min-w-[200px] mt-5">
                    
                <?php
                if($_GET['language']=='ar'){
                    echo '<label
                        class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                   :تاريخ البداية  
                </label>';
                }
                    else{
                        echo '<label
                        class="pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                beginning date:
                </label>';
                    }
                ?>
                <div class=" absolute left-0 top-[60%] flex w-full items-center justify-between">
                    <input type="text" name="payment_date" class="bg-green input-date px-2 text-white" pattern="\d{1,2}-\d{1,2}-\d{4}" required value="<?php echo $paymentDate?>"/>
                    <i class="fa-solid fa-calendar text-green fa-2x cursor-pointer transition duration-200 hover:scale-125  toggle-calendar block toggle-calendar"></i>  
                </div>
                <div class="absolute w-full flex items-center justify-between flex-col bg- z-10 bg-grey text-black border-orange rounded-xl p-3 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] calendar right-[-360px] 
                top-[-310px] hidden">
                <p class="text-red font-bold text-1xl message"></p>
                                <div class="w-full flex justify-between items-center mt-1">                               
                                <p class="text-xl font-bold text-orange text-left w-full current-date text-green"></p>
                                <div class="flex text-orange">
                                    <button class="text-lg bg-white mr-2 rounded-full p-2 hover:bg-orange text-green   cursor-pointer prev hover:bg-green hover:text-white font-black"><</p>
                                    <button class="text-lg bg-white rounded-full p-2 hover:bg-orange text-green   cursor-pointer next hover:bg-green hover:text-white font-black">></button>
                                </div>
                                </div>
                                <div class="grid grid-cols-7 gap-3 w-full mt-2">
                                <?php
                                    if($_GET['language']=="en")
                                        echo '<p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center">Mon</p>
                                    <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">Thu</p>
                                    <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">wed</p>
                                    <p class=" text-brown font-bold w-[2rem]  col-span-1 text-center flex items-center justify-center text-xs">Thu</p>
                                    <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">Fri</p>
                                    <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">Sat</p>
                                    <p class=" text-brown font-bold  w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">Sun</p>';
                                    else
                                        echo '<p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center">الإثنين</p>
                                        <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">الثلاثاء</p>
                                        <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">الأربعاء</p>
                                        <p class=" text-brown font-bold w-[2rem]  col-span-1 text-center flex items-center justify-center text-xs">الخميس</p>
                                        <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">الجمعة</p>
                                        <p class=" text-brown font-bold w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">السبت</p>
                                        <p class=" text-brown font-bold  w-[2rem] text-xs   col-span-1 text-center flex items-center justify-center ">الأحد</p>';

                                ?>
                                    
                                </div>           
                                <div class="grid grid-cols-7 gap-4 w-full justify-between items-center mt-2 days">
                                </div>           
                            </div>
                            <!-- end calendar -->
            </div> 
             <div class="flex justify-end mt-[40px]">
            <?php
                if($_GET['language']=='en')
                    echo '<input  type="submit" value="Add Client" name="submit" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110 ">';
                else
                    echo '<input  type="submit" value="تأكيد" name="submit" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110 ">';
            ?>
                
            </div>
        </form> 
                </div>         
    </div>
    </div>
    <!-- javascript -->
    <script src="../js/add_client.js" type="module"></script>
</body>
</html>





