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
            <div class="flex items-center text-white  w-[97%]   mt-5  px-6 py-2 hover:bg-white mx-2 rounded-l-full cursor-pointer   hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-table block basis-[15%]"></i>
                        <a href="./dashboard.php" class="cursor-pointer block basis-[85%]">Dashboard</a>
            </div>
            <div class="flex items-center text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3 rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-user block basis-[15%]"></i>
                        <a href="./add_client.php" class="cursor-pointer block basis-[85]">Add client</a>
            </div>
            <div class="flex items-center text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-calendar-day block basis-[15%]"></i>
                        <a class="basis-[85%] cursor-pointer block" href="./historicalData.php?month='.date('m').'&year='.date('Y').'">Historical Data</a>
            </div>
            <div class="flex items-center text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-eye-slash basis-[15%]"></i>
                        <a href="./expiredMembers.php" class="basis-[85%] cursor-pointer">Expired Members</a>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-user-check block basis-[15%]"></i>
                        <a class="cursor-pointer block basis-[85%]" href="./activeMembers.php">Active Members</a>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-sharp fa-solid fa-comments-dollar block basis-[15%]"></i>
                        <a class="cursor-pointer basis-[85%]" href="./add_fees.php">Add Fees</a>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page" style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-gear block basis-[15%]"></i>
                        <a class="cursor-pointer block basis-[85]">Settings</a>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-right-from-bracket block basis-[15%]"></i>
                        <a href="./logout.php" class="cursor-pointer basis-[85%]">Log out</a>
            </div>
        </div>';
    }
    function selectClientsDashboard($conn,$gymId,$userId){
        $query="{CALL selectClients(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-1xl text-center mt-3 text-grey-light font-bold">You don\'t have any client</div>';
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
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">'.ucfirst($row['client_first_name']) .' '.ucfirst($row['client_last_name']).'</span></p>
                    </div>
                    <div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</p>
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
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <button class="block  md:px-3 md:py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                            <a href="./details.php?client_id='.$row['client_id'].'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>
                        </div>
                        <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
        }
    }
    function drawerMoney($conn,$gymId){
        $query="SELECT dbo.calculateFee(?) as sum";
        $result=sqlsrv_query($conn,$query,array($gymId));
        $row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
        return $row['sum'];   
    }
    function newClientsOfThisMonth($conn,$gymId){
        $query="{CALL newClientOfThisMonth(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_fetch_array($result);
        return $rowCount['number'];
    }
    function earningThisMonth($conn,$gymId){
        $query="SELECT dbo.earningOfMonth(?) as sum";
        $result=sqlsrv_query($conn,$query,array($gymId));
        $row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
        return $row['sum'];
    }
    function selectExpiredClients($conn,$gymId,$userId){
        $query="{CALL searchClientsMonthExpired(?)}";
        $result=sqlsrv_query($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="text-xl text-center text-grey-light font-bold">You don\'t have any expired members</div>';
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
                        <p class=" basis-[90%]  text-green font-black full-name">name:<span class=" text-black ml-1 font-bold">'.ucfirst($row['client_first_name']) .' '.ucfirst($row['client_last_name']).'</span></p>
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
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <button class="block  md:px-3 md:py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                            <a href="./details.php?client_id='.$row['client_id'].'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>
                        </div>
                        <div class=" h-[10%] w-full bottom absolute bottom-3 left-0"></div>
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
            echo '<div class="text-xl text-center text-grey-light font-bold">You don\'t have any active members</div>';
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
                        <p class=" basis-[90%]  text-green font-black full-name">name:<span class=" text-black ml-1 font-bold">'.ucfirst($row['client_first_name']) .' '.ucfirst($row['client_last_name']).'</span></p>
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
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <button class="block  md:px-3 md:py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                            <a href="./details.php?client_id='.$row['client_id'].'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>
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
            echo '<div class="text-xl mt-5 text-center text-grey-light font-bold">You don\'t have any expired operations</div>';
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
                                <td class="py-2 text-center font-bold flex gap-1 items-center ">
                                    <div class="w-[55px] h-[55px] bg-green p-[3px] rounded-full">
                                        <img src="'.$row['client_image'].'" alt="" class="rounded-full object-center brightness-100 w-full h-full">
                                    </div>
                                    <p class="text-start">'.$row['client_first_name'].'  '.$row['client_last_name'].'</p>
                                </td>
                                <td class=" py-2 text-center font-bold">'.$row['beginning_period_date']->format('Y-m-d').'</td>
                                <td class=" py-2 text-center font-bold">'.$row['end_period_date']->format('Y-m-d').'</td>
                                <td class=" py-2 text-center font-bold amount">
                                    '.$row['amount'].'<span> DH</span>
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
            echo '<div class="text-1xl mt-5 text-center text-grey-light  font-bold">You don\'t have any new members</div>';
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
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">'.ucfirst($row['client_first_name']) .' '.ucfirst($row['client_last_name']).'</span></p>
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
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <button class="block  md:px-3 md:py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                            <a href="./details.php?client_id='.$row['client_id'].'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>
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
            echo "<option value='./historicalData.php?month=" . $row['month'] . "&year=" . $row['year'] . "'>
            " . $row['year'] . '-' . $row['month'] ."
            </option>";
        }
        echo '</select>';
    }
    
    function informationClient($conn,$gymId,$clientId){
        $query="{CALL selectInformationOfClient(?,?)}";
        $result=sqlsrv_query($conn,$query,array($gymId,$clientId));
        while($row=sqlsrv_fetch_array($result)){
            echo '
            <div class="basis-[25%] rounded-full p-[4px] bg-green">
                <img src="'.$row['client_image'].'" class="w-full h-[250px] rounded-full object-center"/>
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
                        <div class="flex  gap-2 mt-5 px-5">
                             <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Price:</p>
                                <p class="text-black font-bold basis-[60%] text-start">'.$row['price'].'</p>
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
            echo '<div class="text-xl text-center text-grey-light font-bold">This Client don\'t have any operations</div>';
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
            header("location:./search.php?client_name=$clientName");
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
                        <p class=" basis-[90%]  text-green font-black full-name">name:<span class=" text-black ml-1 font-bold">'.ucfirst($row['client_first_name']) .' '.ucfirst($row['client_last_name']).'</span></p>
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
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</pd>
                        </div>
                    </div>
                        <div class="flex justify-end mt-2">
                            <button class="block  md:px-3 md:py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                            <a href="./edit.php?client_id='.$row['client_id'].'&user_id='.$userId.'
                            &gym_id='.$gymId.'" class="block  md:px-5 md:py-2  text-white bg-green  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold  mr-2">edit</a>
                             <a href="./details.php?client_id='.$row['client_id'].'" class="block  md:px-3 md:py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">Details</a>
                        </div>
                        <div class="h-[10%] w-full bottom absolute bottom-3 left-0 bg-green-dark"></div>
                </div>
            </div>';
            }
            echo ' </div>';
    }
    function pay($conn,$gymId,$clientId,$beginningDate){
        $query="{CALL pay(?,?,?)}";
        $result=sqlsrv_query($conn,$query,array($gymId,$clientId,$beginningDate));
    }
    function displayFee($conn,$gymId,$month,$year){
        $query="{CALL displayFees(?,?,?)}";
        $result=sqlsrv_query($conn,$query,array($gymId,$month,$year),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="mt-5 text-1xl text-center  text-grey-light font-bold">You don\'t have any fee in this month</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full mt-5"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl  text-green font-black text-[7px] md:text-sm ">
                            <tr>
                                <th class=" text-center">
                                    Description: 
                                </th>
                                <th class=" text-center">
                                    date: 
                                </th>
                                <th class=" text-center">
                                    amount: 
                                </th>
                            </tr>
                </thead>';
                 echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                $count=1;
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 md:text-sm text-[6px] ">
                        <td class=" py-5 text-center font-bold max-w-32">'.$row['description'].'</td>
                        <td class=" py-5 text-center font-bold">'.$row['date_of_fee']->format('Y-m-d').'</td>
                        <td class=" py-5 text-center font-bold money-fee">'.$row['amount'].'<span> DH</span></td>
                    </tr>';
                    $count++;
                }
                echo '</tbody>';
                echo '</table>';
        }
    }