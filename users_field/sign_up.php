<?php
    include '../vendor/connect.php'; 
    include '../functions/functions.php';
    require __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable('../vendor');
    $dotenv->load();
    use PHPMailer\PHPMailer\PHPMailer;
    //login sign up
    $countPassword=0;
    $countCredentails=0;
    $firstName ="";
    $lastName ="";
    $phoneNumber="";
    $email ="";
    $password="";
    $repeatPassword="";
    $gymName="";
    $verificationCode="";
    if(isset($_POST["submit"])){
        $firstName = htmlspecialchars($_POST['first_name']);
        $lastName = htmlspecialchars($_POST['last_name']);
        $phoneNumber = htmlspecialchars($_POST['phone_number']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $repeatPassword = htmlspecialchars($_POST['repeat_password']);
        $gymName = htmlspecialchars($_POST['gym_name']);
        $city=$_POST['city'];
        $verificationCode=rand(100000, 999999);
        $profile_image=$_FILES['profile_image'];
        $path='../images/'.$profile_image['name'];
        move_uploaded_file($profile_image['tmp_name'], $path);
        if($profile_image['size']==0){
            $path='../images/body_builder.jpg';
        }
        if($password==$repeatPassword){
            $password=password_hash($password,PASSWORD_DEFAULT);
            $query="{CALL addSupervisorAndGym (?,?,?,?,?,?,?,?,?)}";
            $stmt=sqlsrv_prepare($conn,$query,array($firstName,$lastName,$phoneNumber,$email,$password,$gymName,$verificationCode,$path,$city));
            $result=sqlsrv_execute($stmt);
            if($result){
                header('location:./send_another_code.php?email='.$email.'&language='.$_GET['language'].'');
                exit;
            }
            else{
                $countCredentails++;
            }
        }
        else{
            $countPassword++;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../output.css">
</head>

<body>
    
    <div class="w-full min-h-screen bg-black px-[3%] pt-[2%]">
        <!-- nav bar -->
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
                                    <option value="./sign_up.php?language=en">EN</option>
                                    <option value="./sign_up.php?language=ar">AR</option>';
                            }
                            else if($_GET['language']=='en'){
                                echo '
                                    <option value="./sign_up.php?language=en">EN</option>
                                    <option value="./sign_up.php?language=ar">AR</option>';
                            }
                            else if($_GET['language']=='ar')
                                echo '
                                    <option value="./sign_up.php?language=ar" >AR</option>
                                    <option value="./sign_up.php?language=en">EN</option>';
                        ?>
                        
                    </select>
                    <div class="flex  md:py-0">
                        <?php
                             if(isset($_GET['language']) && $_GET['language']=='ar'){
                                    echo ' <a href="./login.php?language=ar" class="block text-black bg-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs mr-2 md:mr-5">الدخول</a>';
                                    echo '<a href="../index.php?language=ar" class="block bg-green text-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs">الصفحة الرئيسية</a>';
                                }
                            else if(!isset($_GET['language']) || $_GET['language']=='en'){
                                echo ' <a href="./login.php?language=en" class="block text-black bg-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs mr-2 md:mr-5">Login</a>';
                                echo '<a href="../index.php?language=en" class="block bg-green text-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md md:text-1xl text-xs">Home</a>';
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </nav>
        <div class=" h-full w-full flex  px-2 items-start justify-center py-5">
            <form class="z-10 bg-white rounded-md md:w-[40%] md:px-[2%] md:py-[1%] w-[100%] px-5 py-2" action="" method="post" enctype="multipart/form-data">

            <?php
                if($countCredentails!=0 && (isset($_GET['language']) && $_GET['language']=='ar')){
                    echo '<small class="text-red font-bold">  البريد الإلكتروني  يستخدمه شخص آخر</small>';
                }
                else if($countCredentails!=0 && (!isset($_GET['language']) || $_GET['language']=='en'))
                    echo '<small class="text-red font-bold">email used by another person</small>';
            ?>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <input required
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="first_name" value="<?php echo $firstName?>"/>
                
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        :الاسم الشخصي                
                
                </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                First Name:
                </label>';
                    }
                ?>
            </div>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <input required  
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="last_name" value="<?php echo $lastName?>"/>
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        :اسم العائلة              
                
                </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Last Name:
                </label>';
                    }
                ?>
            </div>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <input  pattern="0[0-9]{9}" name="phone_number"  required
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" value="<?php echo $phoneNumber?>"/>
                
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                رقم الهاتف :(0123456789)
                </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Phone number:(0123456789)
                </label>';
                    }
                ?>
            </div>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <input  type="email" name="email" pattern=".+@gmail\.com" required
                placeholder="xxxxxx@gmail.com"
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" value="<?php echo $email?>"/>
                
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                :بريد إلكتروني
                </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                email:
                </label>';
                    }
                ?>
            </div>
            <div class="relative min-h-11 w-full min-w-[200px] mt-5 py-3">
                    <input  type="file" name="profile_image"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent  font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 py-2"/>
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                        class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        :صورة الحساب                   
                    </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                image:
                </label>';
                    }
                ?>
            </div>
            <?php 
                if($countPassword!=0  && (isset($_GET['language']) && $_GET['language']=='ar')){
                    echo '<p class="text-red font-bold">كلمة المرور غير متوافقة</p>';
                }
                else if($countPassword!=0 && (!isset($_GET['language']) || $_GET['language']=='en')){ 
                    echo '<p class="text-red font-bold">password incompatible</p>';
                }
            ?>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <input  required
                 title="Password must contain at least one number, one uppercase and one lowercase letter, and be at least 8 characters long" 
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" type="password" name="password" value="<?php echo ""?>"
                />
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                    class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent    peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        :كلمة المرور   
                    </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Password:
                </label>';
                    }
                ?>
            </div>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <input required
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" type="password"  name="repeat_password" value="<?php echo ""?>"/>
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                    class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent    peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        :اعد كلمة السر  
                    </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                repeat password:
                </label>';
                    }
                ?>
            </div>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <input  required
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" type="text" name="gym_name" value="<?php echo $gymName?>"/>
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                    class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent    peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        :اسم الصالة الرياضية    
                    </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Gym Name
                </label>';
                    }
                ?>
            </div>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
                <input  required
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" type="text" name="city"/>
                <?php
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<label
                    class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent    peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        :المدينة   
                    </label>';
                }
                    else if(!isset($_GET['language']) || $_GET['language']=='en'){
                        echo '<label
                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        city:
                </label>';
                    }
                ?>
            </div>
            <div class="flex justify-end mt-5">
               
                <?php 
                if(isset($_GET['language']) && $_GET['language']=='ar'){
                    echo '<input  type="submit" value="التسجيل" name="submit" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110 ">';
                }
                else if(!isset($_GET['language']) || $_GET['language']=='en'){ 
                    echo ' <input  type="submit" value="sign up" name="submit" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110 ">';
                }
            ?>
            </div>
    </form>
    </div>
    <script src="../js/index.js"></script>
</body>
</html>