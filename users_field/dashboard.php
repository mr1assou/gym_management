<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php');
        exit;
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
        <?php include '../includes/sidebar.php' ?>
        <!-- content -->
        <div class="basis-[82%]  bg-grey " style="padding-left:10px;">
            <?php include '../includes/header.php'?>
        <!-- second part-->
     <div class="flex-col justify-between w-full  gap-2 mt-3 relative p-2">
                    <div class="w-full">
                        <div class="w-full p-5  flex items-center justify-between px-2 py-7 bg-white rounded-xl">
                            <div class="basis-[30%]  flex flex-col justify-between items-center">
                                <div class="flex items-center">
                                    <i class="fa-regular fa-user text-orange fa-4x text-green"></i>
                                    <p class="ml-3 font-black">New Clients This month:</p>
                                </div>
                                <p class="mt-5 font-bold text-s">20<span></span></p>
                            </div>
                            <div class="basis-[30%] flex flex-col justify-between items-center">
                                <div class="flex items-center">
                                      <i class="fa-solid fa-user-check text-green fa-4x"></i>
                                    <p class="ml-3 font-black">Active Members:</p>
                                </div>
                                <p class="mt-4 font-bold text-sm ">100<span>
                                </span></p>
                            </div>
                            <div class="basis-[30%] flex flex-col justify-between items-center">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-money-bill-1-wave fa-4x text-orange text-green"></i>
                                    <p class="ml-3 font-black">Earning of this month:</p>
                                </div>
                                <p class="mt-3 font-bold text-s"><span>1000</span> DH</p>
                            </div>
                        </div>
            </div>
            <!-- information -->
        <div class="w-full bg-white p-3 mt-3 rounded-md">
            <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl bg-white text-green font-black">
                            <tr>
                                <th class="px-1 py-2 text-sm text-center">
                                    First Name: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    Last Name: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    Beginning Period Date: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    End Period Date: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    Status: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center ">
                                    Left Time: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center ">
                                    informations: 
                                </th>
                            </tr>
                </thead>
                <tbody class="dark:bg-gray-700 dark:text-gray-400 ">
                    <tr class=" border-b dark:border-gray-700">
                                <td class="px-1 py-2 text-center text-sm font-bold">Marwane</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">Assou</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">14-07-2003</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">14-07-2003</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">access</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">15jrs:22min:10hrs:30s</td>
                                <td class="px-1 py-2 text-center text-sm  font-bold">
                                    <a href="" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>
                    <tr class=" border-b dark:border-gray-700">
                                <td class="px-1 py-2 text-center text-sm font-bold">Marwane</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">Assou</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">14-07-2003</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">14-07-2003</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">access</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">15jrs:22min:10hrs:30s</td>
                                <td class="px-1 py-2 text-center text-sm  font-bold">
                                    <a href="" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>
                    <tr class=" border-b dark:border-gray-700">
                                <td class="px-1 py-2 text-center text-sm font-bold">Marwane</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">Assou</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">14-07-2003</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">14-07-2003</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">access</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">15jrs:22min:10hrs:30s</td>
                                <td class="px-1 py-2 text-center text-sm  font-bold">
                                    <a href="" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>
                    
                </tbody>
            </table>
                </div>
            </div>
        </div> 
    </div>
    <!-- javascript -->
    <script src="../js/dashboard.js"></script>
</body>
</html>