<?php
    include '../vendor/connect.php'; 
    $count=0;
    if(isset($_POST['submit'])){
        $email=htmlspecialchars($_POST['email']);
        $query="{CALL Login(?)}";
        $stmt=sqlsrv_prepare($conn,$query,Array($email),array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
        $result=sqlsrv_execute($stmt);
        $numRows=sqlsrv_num_rows($stmt);
        if($numRows==0) 
            $count++;
        else
            header('location:./send_another_code.php?email='.$email.'&status=change_password&language='.$_GET['language'].'');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>email</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../output.css">
</head>

<body>
    <div class="absolute bg-green right-0 top-0 w-[70%]  z-0 h-[100%]" style="clip-path: polygon(74% 0, 100% 0, 100% 100%, 22% 100%);"></div>
    <div class="w-full min-h-screen  bg-black px-[3%] pt-[2%]">
    <nav class="text-white flex justify-between items-start py-2 md:py-0">
            <div class="flex items-center z-10">
                <img src="../images/logo.png"  class="block md:w-[65px] md:h-[65px] w-[30px] h-[30px]">
                <p class="ml-3 md:text-1xl text-xs font-black ">Gym Manager</p>
            </div>
            <div class="justify-end items-center mb-2 z-10">
                <div class=" flex flex-col-reverse items-end md:flex-row md:items-center  md:mt-0 ">
                    <select class="md:mr-2 md:mt-0 mt-1 md:w-[40px] w-[27%] select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-1 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    > 
                        <?php 
                            if(!isset($_GET['language'])){
                                echo '<option value="" selected disabled hidden>language</option>
                                    <option value="./email.php?language=en">EN</option>
                                    <option value="./email.php.php?language=ar">AR</option>';
                            }
                            else if($_GET['language']=='en'){
                                echo '
                                    <option value="./email.php?language=en">EN</option>
                                    <option value="./email.php?language=ar">AR</option>';
                            }
                            else if($_GET['language']=='ar')
                                echo '
                                    <option value="./email.php?language=ar" >AR</option>
                                    <option value="./email.php?language=en">EN</option>';
                        ?>
                        
                    </select>
                    <div class="flex  md:py-0">
                        <?php
                             if(isset($_GET['language']) && $_GET['language']=='ar'){
                                    echo '<a href="./login.php?language=ar" class="block mr-1 md:mr-5 font-bold  px-6 py-[9px]  transition duration-300 ease-in-out transform  hover:shadow-black hover:shadow-2xl rounded-md md:text-1xl text-xs   bg-white text-black">الدخول</a>';
                                    echo '<a href="../index.php?language=ar" class="block bg-black text-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs">الصفحة الرئيسية </a>';
                                }
                            else if(!isset($_GET['language']) || $_GET['language']=='en'){
                                echo '<a href="./login.php" class="block mr-2 md:mr-5 font-bold  px-6 py-[9px]  transition duration-300 ease-in-out transform  hover:shadow-black hover:shadow-2xl rounded-md md:text-1xl text-xs   bg-white text-black">Log in</a>';
                                echo '<a href="../index.php" class="block bg-black text-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs">Home</a>';
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </nav>
                <?php
                    if(isset($_GET['language']) && $_GET['language']=='ar'){
                        echo '<p class="text-green text-4xl text-center md:mt-2 mt-10">بريدك الالكتروني</p>';
                    }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<p class="text-green text-4xl text-center md:mt-2 mt-10">Your Email</p>';
                    }
            ?>
        <div class=" h-[100%] w-full  flex pt-3 px-2 items-center justify-center">
            <form class="z-10 bg-white rounded-md mt-5 w-[100%] px-5 py-5 md:w-[40%] md:px-[2%] md:py-[1%]"   action="" method="post" >
            <?php
                if($count!=0)
                    if(isset($_GET['language']) && $_GET['language']=='ar'){
                        echo '<p class="font-bold text-red">هذا البريد الإلكتروني غير موجود</p>';
                    }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<p class="font-bold text-red">email doesn\'t exist</p>';
                    }
            ?>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <input  type="email" name="email" pattern=".+@gmail\.com" required
                placeholder="xxxxxx@gmail.com"
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                    class="justify-end  pointer-events-none absolute right-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                    :بريد إلكتروني
                    </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                class="  pointer-events-none absolute right-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                email:
                </label>';
                    }
                ?>
            </div>
            
            <div class="flex justify-end mt-5">
                
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<input  type="submit" value="التالي" name="submit" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110">';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<input  type="submit" value="next" name="submit" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110">';
                    }
                ?>
            </div>
    </form>
    <script src="../js/index.js"></script>
</div>
</body>
</html>