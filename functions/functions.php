<?php
    function sidebar($userId,$gymId){
        echo '<div class="md:basis-[18%] bg-green  h-screen rounded-lg md:sticky md:top-0
        fixed top-0 left-0 basis-[50%] translate-x-[-100%] z-10 md:translate-x-[] sidebar transition duration-300">
            <div class="flex items-center z-10 px-3 bg-black py-5 rounded-bl-full justify-between">
                <div class="flex items-center">
                    <img src="../images/logo.png"  class="block w-[50px] h-[50px]">
                    <p class="ml-3 text-1xl font-bold text-white">Gym Manager</p>
                </div>
                <i class="fa-sharp fa-solid fa-xmark text-white fa-1x md:invisible visible cross hover:scale-125 transform transition duration-100 fa-2x ml-5"></i>
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
            echo '<div class="text-1xl text-center mt-3 text-grey font-bold">You don\'t have any client</div>';
        }
        else{
            echo '<div class="w-full  p-3 mt-3 rounded-md grid grid-cols-4 gap-3">';
            while($row=sqlsrv_fetch_array($result)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  transition duration-300 ease-in-out hover:scale-110 cursor-pointer h-96 relative">
                <div class="h-[45%] px-10 mt-2">
                    <div class="h-full w-full p-1 rounded-full  bg-green">    
                        <img src="'.$row['client_image'].'" class=" h-full w-full object-center rounded-full brightness-125">
                    </div>
                </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold">'.$row['client_first_name'].' '.$row['client_last_name'].'</span></p>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="textx-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('Y-m-d').'</p>
                        </div>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[60%] flex">
                            <p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5">15</span>d:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5 ">10</span>min:<span class="secondes mx-0.5">30</span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <a href="./edit.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-5 md:py-2  text-white bg-green  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold  mr-2">edit</a>
                            <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">Details</a>
                        </div>
                        <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
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
            echo '<div class="text-xl text-center text-grey font-bold">You don\'t have any expired members</div>';
        }
        else{
            echo '<div class="w-full  p-3 mt-3 rounded-md grid grid-cols-4 gap-3">';
            while($row=sqlsrv_fetch_array($result)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  transition duration-300 ease-in-out hover:scale-110 cursor-pointer h-96 relative">
                <div class="h-[45%] px-10 mt-2">
                    <div class="h-full w-full p-1 rounded-full  bg-green">    
                        <img src="'.$row['client_image'].'" class=" h-full w-full object-center rounded-full brightness-125">
                    </div>
                </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold">'.$row['client_first_name'].' '.$row['client_last_name'].'</span></p>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="textx-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('Y-m-d').'</p>
                        </div>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[60%] flex">
                            <p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5">15</span>d:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5 ">10</span>min:<span class="secondes mx-0.5">30</span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <a href="./edit.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-5 md:py-2  text-white bg-green  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold  mr-2">edit</a>
                            <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">Details</a>
                        </div>
                        <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
        }
    }    
    function selectActiveClients($conn,$gymId,$userId){
        $query="{CALL searchClientsWhoTheyHaveAccess(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-xl text-center text-grey font-bold">You don\'t have any active members</div>';
        }
        else{
            echo '<div class="w-full  p-3 mt-3 rounded-md grid grid-cols-4 gap-3">';
            while($row=sqlsrv_fetch_array($result)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  transition duration-300 ease-in-out hover:scale-110 cursor-pointer h-96 relative">
                <div class="h-[45%] px-10 mt-2">
                    <div class="h-full w-full p-1 rounded-full  bg-green">    
                        <img src="'.$row['client_image'].'" class=" h-full w-full object-center rounded-full brightness-125">
                    </div>
                </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold">'.$row['client_first_name'].' '.$row['client_last_name'].'</span></p>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="textx-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('Y-m-d').'</p>
                        </div>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[60%] flex">
                            <p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5">15</span>d:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5 ">10</span>min:<span class="secondes mx-0.5">30</span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <a href="./edit.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-5 md:py-2  text-white bg-green  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold  mr-2">edit</a>
                            <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">Details</a>
                        </div>
                        <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
        }
    }   
    function showOperations($conn,$gymId,$userId,$month,$year){
        $query="{CALL calculateTotalOfMonth(?,?,?)}";
        $result=sqlsrv_query($conn,$query,array($gymId,$month,$year),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-xl mt-5 text-center text-grey font-bold">You don\'t have any expired operations</div>';
        }
        else{
            echo '<table class="text-sm text-left mt-5 rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl  text-green font-black text-[7px] md:text-sm ">
                            <tr>
                                <th class=" text-start ">
                                    Full Name: 
                                </th>
                               
                                <th class=" text-center">
                                    Beginning Period Date: 
                                </th>
                                <th class=" text-center">
                                    End Period Date: 
                                </th>
                                <th class=" text-center">
                                    price: 
                                </th>
                            </tr>
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 text-[7px] md:text-sm">
                                <td class="px-1 py-2 text-center font-bold flex gap-1 items-center ">
                                    <div class="basis-[17%] w-[55px] h-[55px] bg-green p-[3px] rounded-full">
                                        <img src="'.$row['client_image'].'" alt="" class="rounded-full   object-center brightness-100 w-full h-full">
                                    </div>
                                    <p class="basis-[83%] text-start">'.$row['client_first_name'].'  '.$row['client_last_name'].'</p>
                                </td>
                                <td class="px-1 py-2 text-center font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center font-bold">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class="px-1 py-2 text-center font-bold amount">
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
            echo '<div class="text-1xl mt-5 text-center text-grey  font-bold">You don\'t have any new members</div>';
        }
        else{
            echo '<div class="w-full  p-3 mt-3 rounded-md grid grid-cols-4 gap-3">';
            while($row=sqlsrv_fetch_array($result)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  transition duration-300 ease-in-out hover:scale-110 cursor-pointer h-96 relative">
                <div class="h-[45%] px-10 mt-2">
                    <div class="h-full w-full p-1 rounded-full  bg-green">    
                        <img src="'.$row['client_image'].'" class=" h-full w-full object-center rounded-full brightness-125">
                    </div>
                </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold">'.$row['client_first_name'].' '.$row['client_last_name'].'</span></p>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="textx-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('Y-m-d').'</p>
                        </div>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[60%] flex">
                            <p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5">15</span>d:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5 ">10</span>min:<span class="secondes mx-0.5">30</span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <a href="./edit.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-5 md:py-2  text-white bg-green  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold  mr-2">edit</a>
                            <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">Details</a>
                        </div>
                        <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
        }
    }    
    function displaydates($conn,$userId,$gymId,$month,$year){
        $query="{CALL datesHistoricalData(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId));
        echo '<select  class="text-md mt-2 select bg-white border-2 rounded-md px-2 py-1">';
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
            echo '<div class="text-1xl text-center text-grey font-bold">You don\'t have any trial members</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
            style="border-radius:20px;">
            <thead class="capitalise rounded-xl bg-white text-green font-black md:text-sm text-[4px]">
            <tr class="py-2">
                    <th class=" text-center py-2">
                        First Name: 
                    </th>
                    <th class=" text-center py-2">
                        Last Name: 
                    </th>
                    <th class=" text-center py-2">
                        Beginning Period Date: 
                    </th>
                    <th class=" text-center py-2">
                            End Period Date: 
                    </th>
                    <th class=" text-center py-2">
                        Status: 
                    </th>
                    <th class=" text-center  py-2">
                            Left Time: 
                        </th>
                        <th class=" text-center  py-2">
                            informations: 
                        </th>
                    </tr>
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent md:text-sm text-[4px] py-2">
                                <td class=" text-center  font-bold py-2">'.$row['client_first_name'].'</td>
                                <td class=" text-center  font-bold py-2">'.$row['client_last_name'].'</td>
                                <td class=" text-center  font-bold beginning-date py-2">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class=" text-center font-bold end-date py-2">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class=" text-center  font-bold status py-2">'.$row['operation_status'].'</td>
                                <td class=" text-center  font-bold py-2">
                                <span class="days mx-0.5">15</span>d:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5">10</span>min:<span class="secondes mx-0.5">30</span>s</td>
                            <td class=" justify-center md:text-sm text-[4px]   font-bold flex gap-1 py-2">
                                <button  class="px-1 md:px-3 md:py-2   bg-green-dark text-white transition duration-100 ease-in-out hover:scale-110  hidden confirm h-1/2">confirm</button>
                                <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                                &gym_id='.$gymId.'" class="px-1 block  md:px-3 md:py-2   text-black bg-grey  transition duration-100 ease-in-out hover:scale-110 h-1/2">Details</a>
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
            echo '
            <div class="basis-[25%] rounded-full p-[4px] bg-green">
                <img src="'.$row['client_image'].'" class="w-full h-[250px] rounded-full"/>
            </div>
            <div class="basis-[75%]">
                        <div class="flex  gap-2 mt-5 px-5">
                            <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Client First Name:</p>
                                <p class="text-black font-bold basis-[60%] text-start">'.$row['client_first_name'].'</p>
                            </div>
                            <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Client Last Name:</p>
                                <p class="text-black font-bold basis-[60%] text-start">'.$row['client_last_name'].'</p>
                            </div>
                        </div>
                        <div class="flex  gap-2 mt-5 px-5">
                            <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Joinning Date:</p>
                                <p class="text-black font-bold basis-[60%] text-start">'.$row['joinning_date']->format('Y-m-d').'</p>
                            </div>
                            <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Client Last Name:</p>
                                <p class="text-black font-bold basis-[60%] text-start">'.$row['client_phone_number'].'</p>
                            </div>
                        </div>
            </div>';
        }
    }
    function displayDetailsClients($conn,$gymId,$userId,$clientId){
        $query="{CALL detailsClient(?)}";
        $result=sqlsrv_query($conn,$query,array($clientId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-xl text-center text-grey font-bold">This Client don\'t have any operations</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl bg-white text-green font-black md:text-sm text-[6px]">
                            <tr>
                                  <th class=" text-center">
                                    operation number: 
                                </th>
                                <th class=" text-center">
                                    Beginning period date: 
                                </th>
                                <th class=" text-center">
                                    End period date: 
                                </th>
                                <th class=" text-center">
                                    Operation status: 
                                </th>
                                <th class=" text-center">
                                    price: 
                                </th>
                            </tr>
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                $count=1;
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent md:text-sm text-[6px]">
                                <td class=" text-center  font-bold py-3">'.$count.'</td>
                                <td class=" text-center  font-bold py-3">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class=" text-center  font-bold py-3">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class=" text-center  font-bold beginning-date status py-3">'.$row['real_operations_status'].'</td>
                                <td class=" text-center  font-bold price py-3">'.$row['actual_price'].'</td>
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
            echo '<div class="w-full  p-3 mt-3 rounded-md grid grid-cols-4 gap-3">';
            while($row=sqlsrv_fetch_array($result)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  transition duration-300 ease-in-out hover:scale-110 cursor-pointer h-96 relative">
                <div class="h-[45%] px-10 mt-2">
                    <div class="h-full w-full p-1 rounded-full  bg-green">    
                        <img src="'.$row['client_image'].'" class=" h-full w-full object-center rounded-full brightness-125">
                    </div>
                </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold">'.$row['client_first_name'].' '.$row['client_last_name'].'</span></p>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="textx-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('Y-m-d').'</p>
                        </div>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[60%] flex">
                            <p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5">15</span>d:<span class="hrs mx-0.5">22</span>hrs:<span class="minutes mx-0.5 ">10</span>min:<span class="secondes mx-0.5">30</span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <a href="./edit.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-5 md:py-2  text-white bg-green  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold  mr-2">edit</a>
                            <a href="./details.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">Details</a>
                        </div>
                        <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
    }