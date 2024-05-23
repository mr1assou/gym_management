<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <div class="absolute bg-green right-0 top-0 w-[70%]  z-0 h-full" style="clip-path: polygon(74% 0, 100% 0, 100% 100%, 22% 100%);"></div>
    <div class="w-full h-screen bg-black px-[3%] py-[2%]">
        <!-- nav bar -->
        <nav class="text-white flex justify-between items-center">
            <div class="flex items-center z-10">
                <img src="./images/logo.png"  class="block w-[65px] h-[65px]">
                <p class="ml-3 text-1xl font-black ">Gym Manager</p>
            </div>
            <div class="flex items-center mb-2 z-10">
                <a href="./users_field/sign_up.php" class="block mr-5 font-bold bg-black px-6 py-[9px]  transition duration-300 ease-in-out transform  hover:shadow-black hover:shadow-2xl rounded-md">Sign up</a>
                <a href="./users_field/login.php" class="block text-black bg-white font-bold px-6 py-[9px]  transition duration-300 ease-in-out transform hover:shadow-white hover:shadow-2xl rounded-md">Login</a>
            </div>
        </nav>
        <!-- <div class="absolute to h-[100%] w-[50%] bg-green top-0 left-0 -z-50    "></div> -->
        <div class=" h-[92%] w-full mt-2 flex pt-7">
            <div class="basis-[40%] w-full flex-column items-start z-10">
                <h1 class="text-white text-4xl font-black mt-10 leading-snug">Welcome to Gym Manager your all-in-one solution for effortlessly managing your fitness center.</h1>
                <small class="text-grey block mt-10">With Gym Manager, focus less on administrative tasks and more on what matters providing exceptional fitness experiences.</small>
            </div>
            <div class="basis-[60%] z-10 w-full flex items-center justify-end" style="clip-path: polygon(43% 0, 100% 0, 100% 100%, 0% 100%);">
                <img src="./images/home-img.png" alt="image" class="h-[100%] w-[70%] object-top mr-5">
            </div>
        </div>
    </div>
</body>
</html>
<!-- end -->