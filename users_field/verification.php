<?php
    include '../vendor/connect.php'; 
    $count=0;
    if(isset($_POST['submit'])){
        $code=$_POST['code'];
        $query="{CALL activateEmail(?,?)}";
        $result=sqlsrv_query($conn,$query,Array($_GET['email'],$code));
        if($result){
            echo "good";
            header('location:./login.php');
        }        
        else{
            $count++;
        }
    }    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <img src="../images/logo.png"  class="block w-[65px] h-[65px]">
                <p class="ml-3 text-1xl font-black ">Gym Manager</p>
            </div>
        </nav>
        <!--  -->
        <p class="text-green text-4xl text-center">Activate your email</p>
        <div class=" w-full mt-2 flex pt-7">
        <div class="  w-full  flex  items-start justify-center ">
            <form class="z-10 bg-white rounded-md mt-2" style="width:40%;padding:1% 2%;" action="" method="post">
            <?php
                if($count!=0)
                    echo '<p class="font-bold text-red">invalid code</p>';
            ?>
            <div class="relative h-11 w-full min-w-[200px] mt-5">
            <input  required
                 title="Password must contain at least one number, one uppercase and one lowercase letter, and be at least 8 characters long" placeholder="0 0 0 0 0 0" 
                class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" type="password" name="code" maxlength="6"
                />
                <label
                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Activation Code:
                </label>
            </div>
            <div class="flex justify-between mt-5 items-center">
                <a href="./send_another_code.php?email=<?php echo $_GET['email'];?>" class="block text-green">send another code</a>
                <input  type="submit" value="Activate" name="submit" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110">
            </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<!-- end -->