<?php
    include '../vendor/connect.php';
    include '../functions/functions.php';
    $userId=$_GET['user_id'];
    $gymId=$_GET['gym_id'];
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php');
        exit;
    }
    if(isset($_POST['submit'])){
        $clientFirstName=$_POST['client_first_name'];
        $clientLastName=$_POST['client_last_name'];
        $clientPhoneNumber=$_POST['phone_number'];
        $numberOfTrialDays=$_POST['number_of_trial_days'];
        $query="{CALL addClientWithTrialPeriod(?,?,?,?,?)}";
        $result=sqlsrv_query($clientFirstName,$clientLastName,$clientPhoneNumber,$numberOfTrialDays,$gymId);
        if($result){
            echo "good";
        }
        else{
            echo "not good";
        }
    }
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
    <div class="min-h-[100vh] flex gap-1">
        <!-- sidebar -->
        <?php 
             sidebar($userId,$gymId);
        ?>
        <!-- content -->
        <div class="basis-[82%]  p-4" style="padding-left:10px;">
             <form class="z-10 bg-white rounded-md shadow-[0_3px_10px_rgb(0,0,0,0.2)]"style="width:40%;padding:1% 2%;margin-left:30%;" action="" method="post">
                <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <input required type="text" pattern="^(?:[a-z]+|[A-Z]+|[a-zA-Z]+)$"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="client_first_name"/>
                    <label
                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Client First Name:
                </label>
            </div>
                <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <input required type="text" pattern="^(?:[a-z]+|[A-Z]+|[a-zA-Z]+)$"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="client_last_name"/>
                    <label
                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Client Last Name:
                </label>
            </div>
                
                <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <input  pattern="0[0-9]{9}" name="phone_number"  required
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"/>
                    <label
                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Client Phone Number:(0123456789)
                </label>
            </div>
                <div class="relative h-11 w-full min-w-[200px] mt-5">
                    <input  type="number" value="0" min="0" name="number_of_trial_days" required
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"/>
                    <label
                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Number Of Trial Days:
                </label>
            </div>
             <div class="flex justify-end mt-5">
                <input  type="submit" value="Add Client" name="submit" class="text-white bg-green px-4 py-2 cursor-pointer rounded-md transform transition-transform duration-300 hover:scale-110 ">
            </div>
        </form>
    </div>
    <!-- javascript -->
    <script src="../js/dashboard.js"></script>
</body>
</html>