
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
    <div class="min-h-[100vh] flex">
        <!-- sidebar -->
        <div class="basis-[18%] bg-green  h-screen rounded-lg sticky top-0">
            <div class="flex items-center z-10 px-3 bg-black py-5 rounded-bl-full">
                <img src="../images/logo.png"  class="block w-[50px] h-[50px]">
                <p class="ml-3 text-1xl font-bold text-white">Gym Manager</p>
            </div>
            <div class=" text-white  w-[97%]   mt-5  px-6 py-2 hover:bg-white mx-2 rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-table block mr-2"></i>
                        <a class="cursor-pointer">Dashboard</a>
            </div>
            <div class=" text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3 rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-user"></i>
                        <a class="cursor-pointer">Add client</a>
            </div>
            <div class=" text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-calendar-day"></i>
                        <a class="cursor-pointer">Historical Data</a>
            </div>
            <div class=" text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-eye-slash"></i>
                        <a class="cursor-pointer">Expired Members</a>
            </div>
            <div class=" text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-user-check"></i>
                        <a class="cursor-pointer">Active Members</a>
            </div>
            <div class=" text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-gear"></i>
                        <a class="cursor-pointer">Settings</a>
            </div>
            <div class=" text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <a class="cursor-pointer">Log out</a>
            </div>
        </div>

        <!-- content -->
        <div class="basis-[82%]  bg-grey " style="padding-left:10px;">
            <div class="w-full bg-white p-4 flex justify-between items-center">
                <i class="fa-solid fa-bars text-black hidden" style="font-size:20px;"></i>
                <form class="flex items-center max-w-sm mx-auto">   
                    
                    <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                </svg>
            </div>
            <input type="text" id="simple-search" class="border text-sm rounded-lg  block w-full ps-10 p-2.5   dark:border-green dark:placeholder-gray-4" placeholder="Search name..." required />
        </div>
        <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-green rounded-lg border border-blue-700 hover:bg-green focus:ring-4 focus:outline-none  dark:bg-blue-600  dark:focus:ring-blue-800">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>
        <div>
            Welcome Marwane Assou   
        </div>
        </div>
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
</body>
</html>