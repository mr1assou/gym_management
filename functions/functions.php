<?php
    function sidebar($userId,$gymId){
        echo '<div class="md:basis-[18%] bg-green  h-screen rounded-lg md:sticky md:top-0
        absolute top-0 left-0 basis-[50%] translate-x-[0%] z-10 md:translate-x-[]">
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
            <div class=" text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-hourglass-end"></i>
                        <a class="cursor-pointer" href="./trialMembers.php?user_id='.$userId.'&gym_id='.$gymId.'">Trial Members</a>
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
            echo '<div class="text-4xl text-center text-green font-bold">You don\'t have any client</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl bg-white text-green font-black w-full">
                            <tr>
                                <th class="px-1 py-2 text-[5px] md:text-sm text-center">
                                    First Name: 
                                </th>
                                <th class="px-1 py-2 text-[5px] md:text-sm text-center">
                                    Last Name: 
                                </th>
                                <th class="px-1 py-2 text-[5px] md:text-sm text-center">
                                    Beginning Period Date: 
                                </th>
                                <th class="px-1 py-2 text-[5px] md:text-sm text-center">
                                    End Period Date: 
                                </th>
                                <th class="px-1 py-2 text-[5px] md:text-sm text-center">
                                    Status: 
                                </th>
                                <th class="px-1 py-2 text-[5px] md:text-sm text-center ">
                                    Left Time: 
                                </th>
                                <th class="px-1 py-2 text-[5px] md:text-sm text-center ">
                                    informations: 
                                </th>
                            </tr>
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent">
                                <td class="px-1 py-2 text-center md:text-sm text-[4px]  font-bold">'.$row['client_first_name'].'</td>
                                <td class="px-1 py-2 text-center md:text-sm text-[4px]  font-bold">'.$row['client_last_name'].'</td>
                                <td class="px-1 py-2 text-center md:text-sm text-[4px]  font-bold beginning-date">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center md:text-sm  text-[4px] font-bold end-date">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center md:text-sm text-[4px] font-bold status">'.$row['operation_status'].'</td>
                                <td class="px-1 py-2 text-center md:text-sm  text-[4px] font-bold">
                                <span class="days mx-0.5">15</span>days:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5">10</span>min:<span class="secondes mx-0.5">30</span>s</td>
                                <td class="px-1 py-2 justify-center md:text-sm text-[4px]   font-bold flex gap-1">
                                    <button  class=" md:px-3 md:py-2 px-2  bg-green-dark text-white transition duration-100 ease-in-out hover:scale-110 hidden confirm">confirm</button>
                                    <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                                    &gym_id='.$gymId.'" class="block  md:px-3 md:py-2 px-2  text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
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
        return $row['amount']?$row['amount']:0;
    }
    function selectExpiredClients($conn,$gymId,$userId){
        $query="{CALL searchClientsMonthExpired(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-4xl text-center text-green font-bold">You don\'t have any expired members</div>';
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
                                <td class="px-1 py-2 justify-center text-sm  font-bold flex gap-1">
                                    <button  class=" px-3 py-2 bg-green-dark text-white transition duration-100 ease-in-out hover:scale-110 hidden confirm">confirm</button>
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
            echo '<div class="text-4xl text-center text-green font-bold">You don\'t have any active members</div>';
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
            echo '<div class="text-4xl mt-5 text-center text-green font-bold">You don\'t have any expired operations</div>';
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
                            </tr>
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent">
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_first_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['client_last_name'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold beginning-date amount">
                                    '.$row['amount'].'
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
            echo '<div class="text-4xl mt-5 text-center text-green  font-bold">You don\'t have any new members</div>';
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
                    echo '<tr class=" border-b dark:border-gray-70 new-clients">
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
    function displaydates($conn,$userId,$gymId,$month,$year){
        $query="{CALL datesHistoricalData(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId));
        echo '<select class="select" class="text-2xl mt-2">';
        echo '<option value="" selected disabled hidden>'.$year.'-'.$month.'</option>';
        while($row=sqlsrv_fetch_array($result)){
            echo "<option value='./historicalData.php?user_id=" . $userId . "&gym_id=" . $gymId . "&month=" . $row['month'] . "&year=" . $row['year'] . "'>
            " . $row['year'] . '-' . $row['month'] ."
            </option>";
        }
        echo '</select>';
    }
    
    function selectTrialClients($conn,$gymId,$userId){
        $query="{CALL searchTrialMembers(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-4xl text-center text-green font-bold">You don\'t have any trial members</div>';
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
                                <td class="px-1 py-2 justify-center text-sm  font-bold flex gap-1">
                                    <button  class=" px-3 py-2 bg-green-dark text-white transition duration-100 ease-in-out hover:scale-110 hidden confirm">confirm</button>
                                    <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                                    &gym_id='.$gymId.'" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>';
                }
                echo '</tbody>';
                echo '</table>';
        }
    }
    function informationClient($conn,$clientId){
        $query="{CALL selectInformationOfClient(?)}";
        $result=sqlsrv_query($conn,$query,array($clientId));
        while($row=sqlsrv_fetch_array($result)){
            echo '<div class="flex items-center ">
                            <p class="text-green text-1xl font-bold">Client First Name:</p>
                            <p class="ml-3 text-black font-bold">'.$row['client_first_name'].'</p>
                        </div>
                        <div class="flex items-center ">
                            <p class="text-green text-1xl font-bold">Client Last Name:</p>
                            <p class="ml-3 text-black font-bold">'.$row['client_last_name'].'</p>
                        </div>
                        <div class="flex items-center ">
                            <p class="text-green text-1xl font-bold">Joinning date:</p>
                            <p class="ml-3 text-black font-bold">'.$row['joinning_date']->format('Y-m-d').'</p>
                        </div>
                        <div class="flex items-center ">                                                     
                            <p class="text-green text-1xl font-bold">Client Phone number:</p>
                            <p class="ml-3 text-black font-bold">'.$row['client_phone_number'].'</p>
                        </div>';
        }
    }
    function displayDetailsClients($conn,$gymId,$userId,$clientId){
        $query="{CALL detailsClient(?)}";
        $result=sqlsrv_query($conn,$query,array($clientId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-4xl text-center text-green font-bold">This Client don\'t have any operations</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl bg-white text-green font-black">
                            <tr>
                                  <th class="px-1 py-2 text-sm text-center">
                                    operation number: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    Beginning period date: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    End period date: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    Operation status: 
                                </th>
                                <th class="px-1 py-2 text-sm text-center">
                                    price: 
                                </th>
                            </tr>
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                $count=1;
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent">
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$count.'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold beginning-date status">'.$row['real_operations_status'].'</td>
                                <td class="px-1 py-2 text-center text-sm font-bold price">'.$row['price_per_month'].'</td>
                    </tr>';
                    $count++;
                }
                echo '</tbody>';
                echo '</table>';
        }
    }
    function searchForm($userId,$gymId){
        if(isset($_POST['search'])){
            $clientName=$_POST['client_name'];
            header("location:./search.php?user_id=$userId&gym_id=$gymId&client_name=$clientName");
        }
    }
    function searchClient($conn,$userId,$gymId,$clientName){
         $query="{CALL search(?,?)}";
        $result=sqlsrv_query($conn,$query,array($gymId,$clientName));
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
                                <td class="px-1 py-2 justify-center text-sm  font-bold flex gap-1">
                                    <button  class=" px-3 py-2 bg-green-dark text-white transition duration-100 ease-in-out hover:scale-110 hidden confirm">confirm</button>
                                    <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                                    &gym_id='.$gymId.'" class="block  px-3 py-2 text-black bg-grey  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                </td>
                    </tr>';
                }
                echo '</tbody>';
                echo '</table>';
    }
    function sendEmailToUser($recipientEmail,$recipientFname,$recipientLname,$mail,$verificationCode){
        $mail->isSMTP();                                           
        $mail->Host = 'smtp-relay.brevo.com';                    
        $mail->SMTPAuth = true;                                 
        $mail->Username = $_ENV["LOGINSMTP"];                    
        $mail->Password =$_ENV["PASSWORDSMTP"];                             
        $mail->SMTPSecure = 'ssl';            
        $mail->Port = 465;                
        $mail->setFrom('marwane.assou@gmail.com', 'Gym Manager');
        $mail->addAddress($recipientEmail,$recipientFname . $recipientLname);
        $mail->addBCC($recipientEmail);
        $mail->isHTML(true);
        $mail->Subject = 'verification code';
        $mail->Encoding = 'base64';
        $mail->Body = 
        '
        <div style="display: flex;justify-content: center;">
            <div style="display:flex;flex-direction: column;align-items: center;background-color: #eee;width: 50%;border-radius: 2%;padding:10px;">
                <p style="font-weight:bold;">Code:<b style="color:#00FC3A;font-size:20px;font-weight:bold;">'.$verificationCode.'</b></p>
                </div>
            </div>
        ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        try{
        $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }