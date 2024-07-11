
<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        if((time()-$_SESSION['last_login'])/60>=3)
        {
            header('location:./users_field/logout.php?language='.$_SESSION['language'].'');
             exit;
        }
        else{
            if($_SESSION['language']=="en")
                header('location:./users_field/dashboard.php?language=en');
            else
                header('location:./users_field/dashboard.php?language=ar'); 
            exit;
         }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <div class="absolute bg-green right-0 top-0 w-[70%]  z-0 md:h-full h-screen" style="clip-path: polygon(74% 0, 100% 0, 100% 100%, 22% 100%);"></div>
    <div class="w-full h-screen bg-black px-[3%] py-[2%]">
        <nav class="text-white flex justify-between items-start py-2 md:py-0">
            <div class="flex items-center z-10">
                <img src="./images/logo.png"  class="block md:w-[65px] md:h-[65px] w-[30px] h-[30px]">
                <p class="ml-3 md:text-1xl text-xs font-black ">Gym Manager</p>
            </div>
            <div class="justify-end items-center mb-2 z-10">
                <div class=" flex flex-col-reverse items-end md:flex-row md:items-center  md:mt-0 ">
                    <select class="md:mr-2 md:mt-0 mt-1 md:w-[40px] w-[27%] select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-1 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    > 
                        <?php 
                            if(!isset($_GET['language'])){
                                echo '<option value="" selected disabled hidden>language</option>
                                    <option value="./index.php?language=en">EN</option>
                                    <option value="./index.php?language=ar">AR</option>';
                            }
                            else if($_GET['language']=='en'){
                                echo '
                                    <option value="./index.php?language=en">EN</option>
                                    <option value="./index.php?language=ar">AR</option>';
                            }
                            else if($_GET['language']=='ar')
                                echo '
                                    <option value="./index.php?language=ar" >AR</option>
                                    <option value="./index.php?language=en">EN</option>';
                        ?>
                        
                    </select>
                    <div class="flex  md:py-0">
                        <?php
                             if(isset($_GET['language']) && $_GET['language']=='ar'){
                                    echo ' <a href="./users_field/sign_up.php?language=ar" class="block mr-2 md:mr-5 font-bold  px-6 py-[9px]  transition duration-300 ease-in-out transform  hover:shadow-black hover:shadow-2xl rounded-md md:text-1xl text-xs  md:bg-black bg-green text-white ">التسجيل</a>';
                                    echo '<a href="./users_field/login.php?language=ar" class="block text-black bg-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs">الدخول</a>';
                                }
                            else if(!isset($_GET['language']) || $_GET['language']=='en'){
                                echo ' <a href="./users_field/sign_up.php?language=en" class="block mr-2 md:mr-5 font-bold  px-6 py-[9px]  transition duration-300 ease-in-out transform  hover:shadow-black hover:shadow-2xl rounded-md md:text-1xl text-xs  md:bg-black bg-green text-white ">Sign up</a>';
                                echo ' 
                                    <a href="./users_field/login.php?language=en" class="block text-black bg-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs">Login</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        <div class="h-[92%] w-full mt-2 flex pt-7">
            <div class="md:basis-[40%] basis-[35%] w-full flex-column items-start z-10">
                <?php 
                    if(isset($_GET['language']) && $_GET['language']=='ar'){
                        echo '<h1 class="text-white md:text-4xl text-[10px]  font-black mt-10 md:leading-snug leading-snug mr-2 w-full " dir="rtl" lang="ar">
                            مرحبًا بك في Gym Manager، الحل الشامل لإدارة مركز اللياقة البدنية الخاص بك دون عناء.
                        </h1>';
                    }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo ' <h1 class="text-white md:text-4xl text-[10px]  font-black mt-10 md:leading-snug leading-snug">Welcome to Gym Manager your all-in-one solution for effortlessly managing your fitness center.</h1>';
                    }
                ?>
                <?php 
                    if(isset($_GET['language']) && $_GET['language']=='ar'){
                        echo '  <small class="text-grey block mt-10 text-[7px] md:text-sm mr-2" dir="rtl" lang="ar">مع Gym Manager، ركز بشكل أقل على المهام الإدارية وأكثر على الأمور المهمة التي توفر تجارب لياقة بدنية استثنائية.</small>';
                    }
                    else if( !isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<small class="text-grey block mt-10 text-[10px] md:text-sm">With Gym Manager, focus less on administrative tasks and more on what matters providing exceptional fitness experiences.</small>';
                    }
                ?>
            </div>
            <div class="md:basis-[60%] basis-[65%]  z-10 w-full flex md:items-center items-start justify-end" md:style="clip-path: polygon(43% 0, 100% 0, 100% 100%, 0% 100%);" style="clip-path: polygon(0 0, 100% 0%, 99% 100%, 0% 100%);">
                <img src="./images/home-img.png" alt="image" class="md:h-[100%] h-[60%] md:w-[70%] w-[100%] object-top md:mr-5 md:opacity-0 row">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="./js/index.js"></script>
</body>
</html>
<!-- end -->