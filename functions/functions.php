<?php
    function sidebar($userId,$gymId){
        echo '<div class="basis-[18%] bg-green  h-screen rounded-lg sticky top-0">
            <div class="flex items-center z-10 px-3 bg-black py-5 rounded-bl-full">
                <img src="../images/logo.png"  class="block w-[50px] h-[50px]">
                <p class="ml-3 text-1xl font-bold text-white">Gym Manager</p>
            </div>
            <div class=" text-white  w-[97%]   mt-5  px-6 py-2 hover:bg-white mx-2 rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-table block mr-2"></i>
                        <a href="dashboard.php?user_id='.$userId.'&gym_id='.$gymId.'" class="cursor-pointer">Dashboard</a>
            </div>
            <div class=" text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3 rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-user"></i>
                        <a href="./add_client.php?user_id='.$userId.'&gym_id='.$gymId.'" class="cursor-pointer">Add client</a>
            </div>
            <div class=" text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-calendar-day"></i>
                        <a class="cursor-pointer" href="./historicalData.php?user_id='.$userId.'&gym_id='.$gymId.'&month='.date('m').'&year='.date('Y').'">Historical Data</a>
            </div>
            <div class=" text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-eye-slash"></i>
                        <a href="./expiredMembers.php?user_id='.$userId.'&gym_id='.$gymId.'" class="cursor-pointer">Expired Members</a>
            </div>
            <div class=" text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-user-check"></i>
                        <a class="cursor-pointer" href="./activeMembers.php?user_id='.$userId.'&gym_id='.$gymId.'">Active Members</a>
            </div>
            <div class=" text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page" style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-gear"></i>
                        <a class="cursor-pointer">Settings</a>
            </div>
            <div class=" text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <a href="./logout.php" class="cursor-pointer">Log out</a>
            </div>
        </div>';
    }
    function selectClientsDashboard($conn,$gymId,$userId){
        $query="{CALL selectClients(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-4xl text-center text-black font-bold">You don\'t have any client</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
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
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent">
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_first_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_last_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold beginning-date">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold end-date">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold status">'.$row['operation_status'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">
                                <span class="days mx-0.5">15</span>days:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5">10</span>min:<span class="secondes mx-0.5">30</span>s</td>
                                <td class="px-1 py-2 text-center text-sm  font-bold">
                                    <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                                    &gym_id='.$gymId.'" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>';
                }
                echo '</tbody>';
                echo '</table>';
        }
    }
    function activeMembers($conn,$gymId){
        $query="{CALL searchClientsWhoTheyHaveAccess(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        return $rowCount;
    }
    function newClientsOfThisMonth($conn,$gymId){
        $query="{CALL newClientOfThisMonth(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_fetch_array($result);
        return $rowCount['number'];
    }
    function earningThisMonth($conn,$gymId,$month){
        $query="{CALL earningOfMonth (?,?)}";
        $result=sqlsrv_query($conn,$query,array($gymId,$month));
        $row=sqlsrv_fetch_array($result);
        return $row['amount'];
    }
    function selectExpiredClients($conn,$gymId,$userId){
        $query="{CALL searchClientsMonthExpired(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-4xl text-center text-black font-bold">You don\'t have any expired memebers</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
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
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent">
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_first_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_last_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold beginning-date">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold end-date">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold status">'.$row['operation_status'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">
                                <span class="days mx-0.5">15</span>days:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5">10</span>min:<span class="secondes mx-0.5">30</span>s</td>
                                <td class="px-1 py-2 text-center text-sm  font-bold">
                                    <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                                    &gym_id='.$gymId.'" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>';
                }
                echo '</tbody>';
                echo '</table>';
        }
    }    
    function selectActiveClients($conn,$gymId,$userId){
        $query="{CALL searchClientsWhoTheyHaveAccess(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-4xl text-center text-black font-bold">You don\'t have any expired memebers</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
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
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent">
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_first_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_last_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold beginning-date">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold end-date">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold status">'.$row['operation_status'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">
                                <span class="days mx-0.5">15</span>days:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5">10</span>min:<span class="secondes mx-0.5">30</span>s</td>
                                <td class="px-1 py-2 text-center text-sm  font-bold">
                                    <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                                    &gym_id='.$gymId.'" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>';
                }
                echo '</tbody>';
                echo '</table>';
        }
    }
    function showOperations($conn,$gymId,$userId,$month,$year){
        $query="{CALL calculateTotalOfMonth(?,?,?)}";
        $result=sqlsrv_query($conn,$query,array($gymId,$month,$year),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-4xl text-center text-black font-bold">You don\'t have any expired memebers</div>';
        }
        else{
            echo '<table class="text-sm text-left mt-5 rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
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
                                    price: 
                                </th>
                                 <th class="px-1 py-2 text-sm text-center ">
                                    informations: 
                                </th>
                            </tr>
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent">
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_first_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_last_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold beginning-date">
                                    '.$row['amount'].'
                                </td>
                                <td class="px-1 py-2 text-center text-sm  font-bold">
                                    <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                                    &gym_id='.$gymId.'" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>';
                }
                echo '</tbody>';
                echo '</table>';
        }
    }    

    function newClientsHistoricalData($conn,$gymId,$userId,$month,$year){
        $query="{CALL newClientsHistoricalData(?,?,?)}";
        $result=sqlsrv_query($conn,$query,array($gymId,$month,$year),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-4xl text-center text-black font-bold">You don\'t have any expired memebers</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right mt-5 text-gray-500 dark:text-gray-400  bg-white w-full"
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
                                    Phone number: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    Joinning Date: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    informations: 
                                </th>
                            </tr>
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent">
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_first_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_last_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold beginning-date">
                                    '.$row['client_phone_number'].'
                                </td>
                                <td class="px-1 py-2 text-center text-sm font-bold beginning-date">
                                    '.$row['joinning_date']->format('Y-m-d').'
                                </td>
                                <td class="px-1 py-2 text-center text-sm  font-bold">
                                    <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                                    &gym_id='.$gymId.'" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>';
                }
                echo '</tbody>';
                echo '</table>';
        }
    }    