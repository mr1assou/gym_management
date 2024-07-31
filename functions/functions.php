<?php
    function sidebar($conn,$userId,$gymId){
    $sql = "SELECT dbo.numActiveClients(?) AS activeClients";
    $stmt1=sqlsrv_prepare($conn,$sql,array($_SESSION['gym_id']));
    $result=sqlsrv_execute($stmt1);
    $result=sqlsrv_fetch_array($stmt1);
    $rowCount=$result['activeClients'];
    $sql = "SELECT dbo.numExpiredMembers(?) AS expiredClients";
    $stmt2=sqlsrv_prepare($conn,$sql,array($_SESSION['gym_id']));
    $result=sqlsrv_execute($stmt2);
    $result=sqlsrv_fetch_array($stmt2);
    $rowCount2=$result['expiredClients'];
    if($_GET['language']=="en")
        echo '<div class="md:basis-[18%] bg-green  h-screen rounded-lg xl:sticky xl:top-0
        fixed top-0 left-0 basis-[50%] translate-x-[-100%] z-20 xl:translate-x-[] sidebar transition duration-300">
            <div class="flex items-center z-10 px-3 bg-black py-5 rounded-bl-full justify-between">
                <div class="flex items-center">
                    <img src="../images/logo.png"  class="block w-[50px] h-[50px]">
                    <p class="ml-3 text-1xl font-bold text-white xl:text-md">Gym Manager</p>
                </div>
                <i class="fa-sharp fa-solid fa-xmark text-white cursor-pointer fa-1x xl:invisible visible cross hover:scale-125 transform transition duration-100 fa-2x ml-5"></i>
            </div>
            <div class="flex items-center text-white  w-[97%]   mt-5  px-6 py-2 hover:bg-white mx-2 rounded-l-full cursor-pointer   hover:text-green transform transition duration-300 link-page dashboard
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-table ml-1 basis-[15%]"></i>
                        <a href="./dashboard.php?language='.$_GET['language'].'" class="cursor-pointer ml-1 basis-[85%]">Dashboard</a>
                    </div>
            </div>
            <div class="flex items-center text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3 rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page add-client
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-user  basis-[15%] ml-1"></i>
                        <a href="./add_client.php?language='.$_GET['language'].'" class="cursor-pointer  basis-[85] ml-1">Add Client</a>
                    </div>
            </div>
            <div class="flex items-center text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page historical_data
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-calendar-day ml-1 basis-[15%]"></i>
                        <a class="basis-[85%] cursor-pointer ml-1" href="./historicalData.php?month='.date('m').'&year='.date('Y').'&language='.$_GET['language'].'">Historical Data</a>
                    </div>
            </div>
            <div class="flex items-center justify-between text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page expired_members
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-eye-slash basis-[15%]"></i>
                        <a href="./expiredMembers.php?language='.$_GET['language'].'" class="basis-[85%] cursor-pointer ml-1">Expired Members</a>
                    </div>
                    <p class="font-bold">'.$rowCount2.'</p>
            </div>
            <div class="flex items-center justify-between  text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page active_member
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-user-check  basis-[15%]"></i>
                        <a class="cursor-pointer ml-1 basis-[85%]" href="./activeMembers.php?language='.$_GET['language'].'">Active Members</a>
                    </div>
                    <p class="ml-1 font-bold">'.$rowCount.'</p>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page add_fees
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class=" fa-sharp fa-solid fa-comments-dollar block basis-[15%]"></i>
                        <a class="cursor-pointer basis-[85%] ml-1" href="./add_fees.php?language='.$_GET['language'].'">Add Fees</a>
                    </div>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer settings  hover:text-green transform transition duration-300 link-page" style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-gear  basis-[15%]"></i>
                        <a href="./settings.php?language='.$_GET['language'].'" class="cursor-pointer  basis-[85] ml-2">Settings</a>
                    </div>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-right-from-bracket block basis-[15%]"></i>
                        <a href="./logout.php?language='.$_GET['language'].'" class="cursor-pointer basis-[85%] ml-2">Log out</a>
                    </div>
                </div>
        </div>';
        else 
        echo '<div class="md:basis-[18%] bg-green  h-screen rounded-lg md:sticky md:top-0
        fixed top-0 left-0 basis-[50%] translate-x-[-100%] z-20 md:translate-x-[] sidebar transition duration-300 ">
            <div class="flex items-center z-10 px-1 bg-black py-5 rounded-bl-full
             justify-between">
                <div class="flex items-center">
                    <img src="../images/logo.png"  class="block w-[50px] h-[50px]">
                    <p class="ml-3 text-1xl xl:text-md font-bold text-white">Gym Manager</p>
                </div>
                <i class="fa-sharp fa-solid fa-xmark text-white fa-1x md:invisible visible cross hover:scale-125 transform transition duration-100 fa-2x ml-5"></i>
            </div>
            <div class="flex items-center text-white  w-[97%]   mt-5  px-2 py-2 hover:bg-white mx-2 rounded-l-full cursor-pointer   hover:text-green transform transition duration-300 link-page dashboard
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-table  basis-[15%]"></i>
                        <a href="./dashboard.php?language='.$_GET['language'].'" class="cursor-pointer  basis-[85%] ml-1 sm:text-[15px] text-[13px]">لوحة التحكم</a>
                    </div>
            </div>
            <div class="flex items-center text-white  w-[97%]   px-2 py-2 hover:bg-white mx-2 mt-3 rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page add-client
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-user  basis-[15%]"></i>
                        <a href="./add_client.php?language='.$_GET['language'].'" class="cursor-pointer  basis-[85] ml-1 sm:text-[15px] text-[13px]">إضافة متدرب</a>
                    </div>
            </div>
            <div class="flex items-center text-white  w-[97%]   px-2 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page  historical_data
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-calendar-day basis-[15%]"></i>
                        <a class="ml-1 basis-[85%] cursor-pointer sm:text-[15px] text-[13px]" href="./historicalData.php?month='.date('m').'&year='.date('Y').'&language='.$_GET['language'].' ">بيانات و عمليات</a>
                    </div>
            </div>
            <div class="flex items-center text-white  w-[97%]   pl-2 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page expired_members
            " style="border-top-right-radius:-20px;">
                    <div class="w-[82%]">
                        <i class="fa-solid fa-eye-slash basis-[15%]"></i>
                        <a href="./expiredMembers.php?language='.$_GET['language'].'" class="basis-[85%] cursor-pointer sm:text-[15px] text-[13px]">الأعضاء منتهية الصلاحية</a>
                    </div>
                    <p class="font-bold  text-end w-[18%] mr-0.5 pr-1.5">'.$rowCount2.'</p>
            </div>
            <div class="flex items-center text-white  w-[98%]  text-orange pl-2 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page active_member
            " style="border-top-right-radius:-20px;">
                     <div class="w-[82%]">   
                        <i class="fa-solid fa-user-check  basis-[10%]"></i>
                        <a class="cursor-pointer  basis-[90%] sm:text-[15px] text-[13px]" href="./activeMembers.php?language='.$_GET['language'].' ">الأعضاء سارية الصلاحية</a>
                    </div>
                    <p class="font-bold  text-end w-[18%] mr-1 pr-1">'.$rowCount.'</p>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-2 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page add_fees
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-sharp fa-solid fa-comments-dollar  basis-[15%]"></i>
                        <a class="cursor-pointer basis-[85%] ml-1 sm:text-[15px] text-[13px]" href="./add_fees.php?language='.$_GET['language'].'">إضافة مصاريف</a>
                    </div>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-2 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page settings" style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-gear  basis-[15%]"></i>
                        <a href="./settings.php?language='.$_GET['language'].'" class="cursor-pointer  basis-[85] ml-2 sm:text-[15px] text-[13px]">إعدادات</a>
                    </div>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-2 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                    <div>
                        <i class="fa-solid fa-right-from-bracket block basis-[15%]"></i>
                        <a href="./logout.php?language='.$_GET['language'].'" class="cursor-pointer basis-[85%] ml-2 sm:text-[15px] text-[13px]">تسجيل خروج</a>
                    </div>
            </div>
        </div>';
    }
    function selectClientsDashboard($conn,$gymId,$userId){
        $query="{CALL selectClients(?)}";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $result=sqlsrv_execute($stmt);
        $rowCount=sqlsrv_num_rows($stmt);
        if($rowCount==0){
            if($_GET['language']=="en")
                echo '<div class="text-1xl text-center mt-5 text-grey-light font-bold">You don\'t have any client</div>';
            else
            echo '<div class="text-1xl text-center mt-5 text-grey-light font-bold">ليس لديك أي متدرب</div>';
        }
        else{
            echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
            gap-3 row opacity-0">';
            while($row=sqlsrv_fetch_array($stmt)){
                if($row['operation_status']=="access"){
                    echo '
                    <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[65%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                    <div class="px-3 w-full mt-2">
                        <div class="flex w-full text-[11px]">';
                    if($_GET['language']=='en')
                        echo '
                            <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                            '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                    else
                        echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                            '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                    echo '</div>';
                    if($_GET['language']=="en")
                    echo '<div class="flex  text-[13px] font-black mt-1">
                            <div class=" basis-[55%] flex text-[11px]">
                                <p class="text-green font-black">start:</p>
                                <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                            </div>
                            <div class=" basis-[45%] flex text-[11px]">
                                <p class="text-green font-black">end:</p>
                                <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                            </div>
                        </div>';
                    else 
                    echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                    <div class=" basis-[55%] flex text-[11px] ">
                        <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        <p class="text-green font-black ml-1"> :النهاية</p>
                    </div>
                    <div class=" basis-[45%] flex text-[11px] justify-end">
                        <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        <p class="text-green font-black">:البداية</p>
                    </div>
                </div>';
                echo '<div class="flex  text-[13px] font-black mt-1">';
                            if($_GET['language']=='en')
                                echo ' <div class=" basis-[100%] justify-start flex"><p class="text-green font-black">Timer:</p>
                                <p class="text-center font-black timer text-green-dark">
                                <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                            else
                                echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-green-dark">
                                <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                                <p class="text-green font-black ml-1">:الوقت</p></div>';
                        echo '</div>';
                        echo'<div class="flex justify-end mt-2">';
                        if($_GET['language']=="en")    
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                        else
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">الدفع</button>
                            <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                            echo '</div>
                            <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                    </div>
                </div>';
                }
                else{
                    echo '
                    <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[65%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-red">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                    <div class="px-3 w-full mt-2">
                        <div class="flex w-full text-[11px]">';
                    if($_GET['language']=='en')
                        echo '
                            <p class=" basis-[90%]  text-red font-black">name:<span class=" text-black ml-1 font-bold full-name">
                            '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                    else
                        echo '<p class=" basis-[100%]  text-red font-black text-end"><span class=" text-black  font-bold full-name">
                            '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                    echo '</div>';
                    if($_GET['language']=="en")
                    echo '<div class="flex  text-[13px] font-black mt-1">
                            <div class=" basis-[55%] flex text-[11px]">
                                <p class="text-red font-black">start:</p>
                                <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                            </div>
                            <div class=" basis-[45%] flex text-[11px]">
                                <p class="text-red font-black">end:</p>
                                <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                            </div>
                        </div>';
                    else 
                    echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                    <div class=" basis-[55%] flex text-[11px] ">
                        <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        <p class="text-red font-black ml-1"> :النهاية</p>
                    </div>
                    <div class=" basis-[45%] flex text-[11px] justify-end">
                        <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        <p class="text-red font-black">:البداية</p>
                    </div>
                </div>';
                echo '<div class="flex  text-[13px] font-black mt-1">';
                            if($_GET['language']=='en')
                                echo ' <div class=" basis-[100%] justify-start flex"><p class="text-red font-black">Timer:</p>
                                <p class="text-center font-black timer text-red">
                                <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                            else
                                echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-red">
                                <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                                <p class="red font-black ml-1 text-red">:الوقت</p></div>';
                        echo '</div>';
                        echo'<div class="flex justify-end mt-2">';
                        if($_GET['language']=="en")    
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                        else
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">الدفع</button>
                            <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                            echo '</div>
                            <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                    </div>
                </div>';
                }
            }
            echo ' </div>';
        }
    }
    function selectAlternativeDashboard($conn,$gymId,$skip){
        $query="{CALL selectClientsAnotherPage(?,?)}";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId,$skip));
        $result=sqlsrv_execute($stmt);
            echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
            gap-3 row opacity-0">';
            while($row=sqlsrv_fetch_array($stmt)){
                if($row['operation_status']=="access"){
                    echo '
                    <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent   h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[65%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                    <div class="px-3 w-full mt-2">
                        <div class="flex w-full text-[11px]">';
                    if($_GET['language']=='en')
                        echo '
                            <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                            '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                    else
                        echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                            '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                    echo '</div>';
                    if($_GET['language']=="en")
                    echo '<div class="flex  text-[13px] font-black mt-1">
                            <div class=" basis-[55%] flex text-[11px]">
                                <p class="text-green font-black">start:</p>
                                <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                            </div>
                            <div class=" basis-[45%] flex text-[11px]">
                                <p class="text-green font-black">end:</p>
                                <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                            </div>
                        </div>';
                    else 
                    echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                    <div class=" basis-[55%] flex text-[11px] ">
                        <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        <p class="text-green font-black ml-1"> :النهاية</p>
                    </div>
                    <div class=" basis-[45%] flex text-[11px] justify-end">
                        <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        <p class="text-green font-black">:البداية</p>
                    </div>
                </div>';
                echo '<div class="flex  text-[13px] font-black mt-1">';
                            if($_GET['language']=='en')
                                echo ' <div class=" basis-[100%] justify-start flex"><p class="text-green font-black">Timer:</p>
                                <p class="text-center font-black timer text-green-dark">
                                <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                            else
                                echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-green-dark">
                                <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                                <p class="text-green font-black ml-1">:الوقت</p></div>';
                        echo '</div>';
                        echo'<div class="flex justify-end mt-2">';
                        if($_GET['language']=="en")    
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                        else
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">الدفع</button>
                            <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                            echo '</div>
                            <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                    </div>
                </div>';
                }
                else{
                    echo '
                    <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent   h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[65%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-red">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                    <div class="px-3 w-full mt-2">
                        <div class="flex w-full text-[11px]">';
                    if($_GET['language']=='en')
                        echo '
                            <p class=" basis-[90%]  text-red font-black">name:<span class=" text-black ml-1 font-bold full-name">
                            '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                    else
                        echo '<p class=" basis-[100%]  text-red font-black text-end"><span class=" text-black  font-bold full-name">
                            '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                    echo '</div>';
                    if($_GET['language']=="en")
                    echo '<div class="flex  text-[13px] font-black mt-1">
                            <div class=" basis-[55%] flex text-[11px]">
                                <p class="text-red font-black">start:</p>
                                <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                            </div>
                            <div class=" basis-[45%] flex text-[11px]">
                                <p class="text-red font-black">end:</p>
                                <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                            </div>
                        </div>';
                    else 
                    echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                    <div class=" basis-[55%] flex text-[11px] ">
                        <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        <p class="text-red font-black ml-1"> :النهاية</p>
                    </div>
                    <div class=" basis-[45%] flex text-[11px] justify-end">
                        <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        <p class="text-red font-black">:البداية</p>
                    </div>
                </div>';
                echo '<div class="flex  text-[13px] font-black mt-1">';
                            if($_GET['language']=='en')
                                echo ' <div class=" basis-[100%] justify-start flex"><p class="text-red font-black">Timer:</p>
                                <p class="text-center font-black timer text-red">
                                <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                            else
                                echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-red">
                                <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                                <p class="text-red font-black ml-1">:الوقت</p></div>';
                        echo '</div>';
                        echo'<div class="flex justify-end mt-2">';
                        if($_GET['language']=="en")    
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-red mr-2">confirm</button>
                                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                        else
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-red mr-2">الدفع</button>
                            <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                            echo '</div>
                            <div class="bg-red h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                    </div>
                </div>';
                }
            }
            echo ' </div>';
        }
    function drawerMoney($conn,$gymId){
        $query="SELECT dbo.calculateFee(?) as sum";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId));
        $result=sqlsrv_execute($stmt);
        $row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
        return $row['sum'];   
    }
    function newClientsOfThisMonth($conn,$gymId){
        $query="{CALL newClientOfThisMonth(?)}";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $result=sqlsrv_execute($stmt);
        $rowCount=sqlsrv_fetch_array($stmt);
        return $rowCount['number'];
    }
    function earningThisMonth($conn,$gymId){
        $query="SELECT dbo.earningOfMonth(?) as sum";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId));
        $result=sqlsrv_execute($stmt);
        $row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
        return $row['sum'];
    }
    function selectExpiredClients($conn,$gymId,$userId){
        $query="{CALL searchClientsMonthExpired(?)}";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $result=sqlsrv_execute($stmt);
        $rowCount=sqlsrv_num_rows($stmt);
        if($rowCount==0){
            if($_GET['language']=="en")
                echo '<div class="text-xl text-center text-grey-light font-bold">You don\'t have any expired members</div>';
            else
                echo '<div class="text-xl text-center text-grey-light font-bold">
                ليس لديك أي أعضاء منتهية الصلاحية
                </div>';
        }
        else{
            echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
            gap-3 row opacity-0">';
            while($row=sqlsrv_fetch_array($stmt)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                          <div class="h-full w-[70%] sm:w-[55%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-red">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-red font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                    <p class="text-red font-black ml-1"> :النهاية</p>
                </div>
                 <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                     <p class="text-red font-black ">:البداية</p>
                </div>
            </div>';
            echo '<div class="flex  text-[13px] font-black mt-1">';
                        if($_GET['language']=='en')
                            echo ' <div class=" basis-[100%] justify-start flex"><p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                        else
                            echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                            <p class="text-red font-black ml-1">:الوقت</p></div>';
                    echo '</div>';
                    echo'<div class="flex justify-end mt-2">';
                    if($_GET['language']=="en")    
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                        else
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">الدفع</button>
                            <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                            echo '</div>
                            <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
        }
    }    
    function alternativeExpiredClients($conn,$gymId,$skip){
        $query="{CALL clientsMonthsExpiredAnotherPage(?,?)}";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId,$skip));
        $result=sqlsrv_execute($stmt);
            echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
            gap-3 row opacity-0">';
            while($row=sqlsrv_fetch_array($stmt)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[70%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                    <p class="text-green font-black ml-1"> :النهاية</p>
                </div>
                 <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                     <p class="text-green font-black ">:البداية</p>
                </div>
            </div>';
            echo '<div class="flex  text-[13px] font-black mt-1">';
                        if($_GET['language']=='en')
                            echo ' <div class=" basis-[100%] justify-start flex"><p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                        else
                            echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                            <p class="text-green font-black ml-1">:الوقت</p></div>';
                    echo '</div>';
                    echo'<div class="flex justify-end mt-2">';
                    if($_GET['language']=="en")    
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                        else
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">الدفع</button>
                            <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                            echo '</div>
                            <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
        }
    function selectActiveClients($conn,$gymId,$userId){
        $query="{CALL searchClientsWhoTheyHaveAccess(?)}";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $result=sqlsrv_execute($stmt);
        $rowCount=sqlsrv_num_rows($stmt);
        if($rowCount==0){
            if($_GET['language']=="en")
                echo '<div class="text-xl text-center text-grey-light font-bold">You don\'t have any active members</div>';
            else
                echo '<div class="text-xl text-center text-grey-light font-bold">ليس لديك أعضاء سارية الصلاحية</div>'; 
        }
        else{
            echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
            gap-3 row opacity-0">';
            while($row=sqlsrv_fetch_array($stmt)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[70%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                    <p class="text-green font-black ml-1"> :النهاية</p>
                </div>
                 <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                     <p class="text-green font-black">:البداية</p>
                </div>
            </div>';
            echo '<div class="flex  text-[13px] font-black mt-1">';
                        if($_GET['language']=='en')
                            echo ' <div class=" basis-[100%] justify-start flex"><p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                        else
                            echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                            <p class="text-green font-black ml-1">:الوقت</p></div>';
                    echo '</div>';
                    echo'<div class="flex justify-end mt-2">';
                    if($_GET['language']=="en")    
                    echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                    <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
            else
                echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">الدفع</button>
                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                echo '</div>
                <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
        }
        return $rowCount;
    }   
    function showOperations($conn,$gymId,$userId,$month,$year){
        $query="{CALL calculateTotalOfMonth(?,?,?)}";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId,$month,$year),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $result=sqlsrv_execute($stmt);
        $rowCount=sqlsrv_num_rows($stmt);
        if($rowCount==0 ){
            if($_GET['language']=="en")
                echo '<div class="text-1xl mt-5 text-center text-grey-light font-bold">You don\'t have any expired operations</div>';
            else
                echo '<div class="text-1xl mt-5 text-center text-grey-light font-bold">
                     ليس لديك أي عمليات في هذا الشهر</div>';
        }
        else{
            echo '<table class="text-sm text-left mt-5 rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl  text-green font-black text-[7px] md:text-sm ">';
                        if($_GET['language']=="en"){
                            echo '<tr>
                                <th class=" text-start ">
                                    Full Name: 
                                </th>
                               
                                <th class=" text-center">
                                    Beginning Date: 
                                </th>
                                <th class=" text-center">
                                    End  Date: 
                                </th>
                                <th class=" text-center">
                                    Checkout date: 
                                </th>
                                <th class=" text-center">
                                    price: 
                                </th>
                            </tr>';
                        }
                        else{
                            echo '<tr>
                                <th class=" text-start ">
                                    :الاسم الكامل
                                </th>
                               
                                <th class=" text-center">
                                    :تاريخ البداية
                                </th>
                                <th class=" text-center">
                                    :تاريخ النهاية   
                                </th>
                                <th class=" text-center">
                                    :تاريخ الأداء
                                </th>
                                <th class=" text-center">
                                    :المبلغ
                                </th>
                            </tr>';
                        }                
             echo '</thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                while($row=sqlsrv_fetch_array($stmt)){
                    echo '<tr class=" border-b dark:border-gray-70 text-[7px] md:text-sm">
                                <td class="py-2 text-center font-bold flex gap-1 items-center ">
                                    <div class="h-[20px] w-[20px] sm:w-[55px] sm:h-[55px] bg-green p-[1px] md:p-[3px] rounded-full">
                                        <img src="'.$row['client_image'].'" alt="" class="rounded-full object-center brightness-100 w-full h-full">
                                    </div>
                                    <p class="text-start">'.$row['client_first_name'].'  '.$row['client_last_name'].'</p>
                                </td>
                                <td class=" py-2 text-center font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</td>
                                <td class=" py-2 text-center font-bold">'.$row['end_period_date']->format('d-m-Y').'</td>
                                <td class=" py-2 text-center font-bold">'.$row['checkout_date']->format('d-m-Y').'</td>
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
        $stmt=sqlsrv_prepare($conn,$query,array($gymId,$month,$year),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $result=sqlsrv_execute($stmt);
        $rowCount=sqlsrv_num_rows($stmt);
        if($rowCount==0 && $_GET['language']=="en"){
            echo '<div class="text-1xl mt-5 text-center text-grey-light  font-bold">You don\'t have any new members</div>';
        }
        if($rowCount==0 && $_GET['language']=="ar"){
            echo '<div class="text-1xl mt-5 text-center text-grey-light  font-bold">
            ليس لديك أي أعضاء جدد في هذا الشهر</div>';
        }
        else{
            echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
            gap-3 row opacity-0">';
            while($row=sqlsrv_fetch_array($stmt)){
            if($row['operation_status']=="reject"){
            echo '
                 <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-80 relative ">
                    <div class="h-[50%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[76%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-red">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-red font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-red font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-red font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-red font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                    <p class="text-red font-black ml-1"> :النهاية</p>
                </div>
                 <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                     <p class="text-red font-black "> :البداية</p>
                </div>
            </div>';
            echo '<div class="flex  text-[13px] font-black mt-1">';
                    echo '</div>';
                    echo'<div class="flex justify-end mt-2">';
                    if($_GET['language']=="en")    
                    echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                    <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                else
                    echo '
                        <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                    echo '</div>
                    </div>
                </div>';
                }
                else{
                    echo '
                 <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-80 relative ">
                    <div class="h-[50%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[76%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                    <p class="text-green font-black ml-1"> :النهاية</p>
                </div>
                 <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                     <p class="text-green font-black "> :البداية</p>
                </div>
            </div>';
            echo '<div class="flex  text-[13px] font-black mt-1">';
                    echo '</div>';
                    echo'<div class="flex justify-end mt-2">';
                    if($_GET['language']=="en")    
                    echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                    <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                else
                    echo '
                        <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                    echo '</div>
                    </div>
                </div>';
                }
                
            }
            echo ' </div>';
        }
    }    
    function displaydates($conn,$userId,$gymId,$month,$year){
        $query="{CALL datesHistoricalData(?)}";
        $stmt=sqlsrv_prepare($conn,$query,array($gymId));
        $result=sqlsrv_execute($stmt);
        echo '<select  class=" text-md mt-2 select bg-white border-2 rounded-md px-2 py-1">';
        echo '<option value="" selected disabled hidden>'.$year.'-'.$month.'</option>';
        while($row=sqlsrv_fetch_array($stmt)){
            echo "<option value='./historicalData.php?month=" . $row['month'] . "&year=" . $row['year'] . "&language=" . $_GET['language'] . "'>
            " . $row['year'] . '-' . $row['month'] . "
            </option>";


        }
        echo '</select>';
    }
    function informationClient($conn,$gymId,$row){
        if($row['operation_status']=="access"){
            echo '
            <div class="2xl:w-[20%] md:w-[40%] sm:w-[50%] w-[85%]   rounded-full p-[4px]  relative bg-green xl:w-[25%]
                ">
                <img src="'.$row['client_image'].'" class="w-full h-[230px]  rounded-full object-center image-field"/>
                <button class="absolute bottom-2 right-2 image-button bg-white text-green rounded-full hover:text-white hover:bg-green">
                    <i class="fa-solid fa-circle-plus  fa-3x
                    cursor-pointer "></i>
                </button>
                <input  type="file" name="image" 
                class="image-input hidden"/>
            </div>
            <div class="2xl:w-[75%] w-full xl:w-[70%]">
                        <div class="xl:flex xl:flex-row flex flex-col-reverse  gap-2 mt-5 ">';
                        if($_GET['language']=="en")
                            echo'<div class="flex  gap-2 mt-5 items-center xl:basis-[50%] ">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Client First Name:</p>
                                <p class="text-black font-bold basis-[60%] text-start">'.$row['client_first_name'].'</p>
                            </div>
                            <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Client Last Name:</p>
                                <p class="text-black font-bold basis-[60%] text-start">'.$row['client_last_name'].'</p>
                            </div>';
                        else
                            echo'
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                                <p class="text-black font-bold basis-[40%] text-end">'.$row['client_last_name'].'</p>
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5">:الإسم العائلي</p>
                        </div>
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                                <p class="text-black font-bold basis-[40%] text-end">'.$row['client_first_name'].'</p>
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5">:الإسم الشخصي</p>
                            </div>
                            ';
                        echo'</div>
                        <div class="xl:flex xl:flex-row flex flex-col  gap-2 mt-5 xl:px-5">';
                            if($_GET['language']=="en")
                            echo'
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                            <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Joinning Date:</p>
                                  <p class="text-black font-bold basis-[60%] text-start">'.$row['joinning_date']->format('d-m-Y').'</p>
                                
                            </div>
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                             <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Phone Number:(0123456789)</p>
                                <input type="text" pattern="0[0-9]{9}" name="phone_number"  class="text-black font-bold basis-[60%] text-start bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value="'.$row['client_phone_number'].'"/>
                            </div>';
                            else
                                echo'
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%] ">
                                  <p class="text-black font-bold basis-[40%] text-end">'.$row['joinning_date']->format('d-m-Y').'</p>
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5 ">:تاريخ الانضمام</p>
                            </div>
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                                <input type="text" pattern="0[0-9]{9}" name="phone_number"  class="text-black font-bold xl:basis-[50%] basis-[50%] text-center bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value="'.$row['client_phone_number'].'"/>
                                <p class="text-green text-1xl md:text-sm  font-bold xl:basis-[50%] basis-[50%] text-end xl:mr-0 mr-5">:رقم الهاتف</p>
                            </div>';
                        echo'</div>
                        <div class="xl:flex xl:flex-row flex flex-col  gap-2 mt-5 px-5">';
                        if($_GET['language']=="en")
                            echo'<div class="flex  gap-2 mt-5 items-center basis-[50%] ">
                                <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Price:</p>
                                 <p class="text-black font-bold xl:basis-[60%] basis-[70%] 
                                 text-start ml-5">'.$row['price'].'<span class="text-black font-bold"> DH</span></p>
                            </div>
                            <div class="flex justify-end gap-2 mt-5 items-center basis-[50%]">
                                <input type="submit" name="change" value="Change" class="px-5 py-2 block text-white rounded-md  bg-green scale-110 cursor-pointer hover:bg-white border border-solid hover:text-green font-bold"/>
                            </div>';
                        else
                        echo'<div class="flex  gap-2 mt-5 items-center  xl:basis-[50%]">
                             <p class="text-black  font-bold basis-[40%] text-center 2xl:ml-10 ml-5" dir="rtl" lang="ar">'.$row['price'].'<span class="text-black font-bold"> درهم</span></p>
                            <p class="text-green text-1xl md:text-sm font-bold basis-[50%]   text-end xl:mr-5">:الواجب الشهري</p>
                        </div>
                        <div class="flex justify-end gap-2 mt-5 items-center basis-[50%]">
                            <input type="submit" name="change" value="تغيير" class="px-5 py-2 block text-white rounded-md  bg-green scale-110 cursor-pointer hover:bg-white border border-solid hover:text-green font-bold"/>
                        </div>';
                        echo'</div>
            </div>';
        }
        else{
            echo '
            <div class="2xl:w-[20%] md:w-[40%] sm:w-[50%] w-[85%]   rounded-full p-[4px]  relative bg-red xl:w-[25%]
                ">
                <img src="'.$row['client_image'].'" class="w-full h-[230px]  rounded-full object-center image-field"/>
                <button class="absolute bottom-2 right-2 image-button bg-white text-red rounded-full hover:text-white hover:bg-red">
                    <i class="fa-solid fa-circle-plus  fa-3x
                    cursor-pointer "></i>
                </button>
                <input  type="file" name="image" 
                class="image-input hidden"/>
            </div>
            <div class="2xl:w-[75%] w-full xl:w-[70%]">
                        <div class="xl:flex xl:flex-row flex flex-col-reverse  gap-2 mt-5 ">';
                        if($_GET['language']=="en")
                            echo'<div class="flex  gap-2 mt-5 items-center xl:basis-[50%] ">
                                <p class="text-red text-1xl md:text-sm  font-bold basis-[40%] text-start">Client First Name:</p>
                                <p class="text-black font-bold basis-[60%] text-start">'.$row['client_first_name'].'</p>
                            </div>
                            <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                                <p class="text-red text-1xl md:text-sm  font-bold basis-[40%] text-start">Client Last Name:</p>
                                <p class="text-black font-bold basis-[60%] text-start">'.$row['client_last_name'].'</p>
                            </div>';
                        else
                            echo'
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                                <p class="text-black font-bold basis-[40%] text-end">'.$row['client_last_name'].'</p>
                                <p class="text-red text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5">:الإسم العائلي</p>
                        </div>
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                                <p class="text-black font-bold basis-[40%] text-end">'.$row['client_first_name'].'</p>
                                <p class="text-red text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5">:الإسم الشخصي</p>
                            </div>
                            ';
                        echo'</div>
                        <div class="xl:flex xl:flex-row flex flex-col  gap-2 mt-5 xl:px-5">';
                            if($_GET['language']=="en")
                            echo'
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                            <p class="text-red text-1xl md:text-sm  font-bold basis-[40%] text-start">Joinning Date:</p>
                                  <p class="text-black font-bold basis-[60%] text-start">'.$row['joinning_date']->format('d-m-Y').'</p>
                                
                            </div>
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                             <p class="text-red text-1xl md:text-sm  font-bold basis-[40%] text-start">Phone Number:(0123456789)</p>
                                <input type="text" pattern="0[0-9]{9}" name="phone_number"  class="text-black font-bold basis-[60%] text-start bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value="'.$row['client_phone_number'].'"/>
                            </div>';
                            else
                                echo'
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%] ">
                                  <p class="text-black font-bold basis-[40%] text-end">'.$row['joinning_date']->format('d-m-Y').'</p>
                                <p class="text-red text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5 ">:تاريخ الانضمام</p>
                            </div>
                            <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                                <input type="text" pattern="0[0-9]{9}" name="phone_number"  class="text-black font-bold xl:basis-[50%] basis-[50%] text-center bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value="'.$row['client_phone_number'].'"/>
                                <p class="text-red text-1xl md:text-sm  font-bold xl:basis-[50%] basis-[50%] text-end xl:mr-0 mr-5">:رقم الهاتف</p>
                            </div>';
                        echo'</div>
                        <div class="xl:flex xl:flex-row flex flex-col  gap-2 mt-5 px-5">';
                        if($_GET['language']=="en")
                            echo'<div class="flex  gap-2 mt-5 items-center basis-[50%] ">
                                <p class="text-red text-1xl md:text-sm  font-bold basis-[40%] text-start">Price:</p>
                                 <p class="text-black font-bold xl:basis-[60%] basis-[70%] 
                                 text-start ml-5">'.$row['price'].'<span class="text-black font-bold"> DH</span></p>
                            </div>
                            <div class="flex justify-end gap-2 mt-5 items-center basis-[50%]">
                                <input type="submit" name="change" value="Change" class="px-5 py-2 block text-white rounded-md  bg-red scale-110 cursor-pointer hover:bg-white border border-solid hover:text-red font-bold"/>
                            </div>';
                        else
                        echo'<div class="flex  gap-2 mt-5 items-center  xl:basis-[50%]">
                             <p class="text-black  font-bold basis-[40%] text-center 2xl:ml-10 ml-5" dir="rtl" lang="ar">'.$row['price'].'<span class="text-black font-bold"> درهم</span></p>
                            <p class="text-red text-1xl md:text-sm font-bold basis-[50%]   text-end xl:mr-5">:الواجب الشهري</p>
                        </div>
                        <div class="flex justify-end gap-2 mt-5 items-center basis-[50%]">
                            <input type="submit" name="change" value="تغيير" class="px-5 py-2 block text-white rounded-md  bg-red scale-110 cursor-pointer hover:bg-white border border-solid hover:text-red font-bold"/>
                        </div>';
                        echo'</div>
            </div>';
        }
    }
    function displayDetailsClients($conn,$gymId,$userId,$clientId,$row){
        $query="{CALL detailsClient(?)}";
        $result=sqlsrv_query($conn,$query,array($clientId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="mt-10 text-xl text-center text-grey-light font-bold">This Client don\'t have any operations</div>';
        }
        else{
            if($row['operation_status']=="access"){
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full mt-10"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl bg-white text-green font-black md:text-sm text-[6px]">
                            <tr>';
                            if($_GET['language']=="en")
                                echo'  <th class=" text-center">
                                    operation number: 
                                </th>
                                <th class=" text-center">
                                    Beginning period date: 
                                </th>
                                <th class=" text-center">
                                    End period date: 
                                </th>
                                <th class=" text-center">
                                    checkout_date: 
                                </th>
                                <th class=" text-center">
                                    Operation status: 
                                </th>
                                <th class=" text-center">
                                    price: 
                                </th>';
                                else
                                    echo'  <th class=" text-center">
                                       :رقم العملية
                                    </th>
                                    <th class=" text-center">
                                        :تاريخ البداية
                                    </th>
                                    <th class=" text-center">
                                         :تاريخ النهاية
                                    </th>
                                    <th class=" text-center">
                                        :تاريخ الأداء 
                                    </th>
                                    <th class=" text-center">
                                        :حالة العملية
                                    </th>
                                    <th class=" text-center">
                                        :المبلغ
                                    </th>';
                 echo'           </tr>
                </thead>';
            }
            else{
                echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full mt-10"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl bg-white text-red font-black md:text-sm text-[6px]">
                            <tr>';
                            if($_GET['language']=="en")
                                echo'  <th class=" text-center">
                                    operation number: 
                                </th>
                                <th class=" text-center">
                                    Beginning period date: 
                                </th>
                                <th class=" text-center">
                                    End period date: 
                                </th>
                                <th class=" text-center">
                                    checkout_date: 
                                </th>
                                <th class=" text-center">
                                    Operation status: 
                                </th>
                                <th class=" text-center">
                                    price: 
                                </th>';
                                else
                                    echo'  <th class=" text-center">
                                       :رقم العملية
                                    </th>
                                    <th class=" text-center">
                                        :تاريخ البداية
                                    </th>
                                    <th class=" text-center">
                                         :تاريخ النهاية
                                    </th>
                                    <th class=" text-center">
                                        :تاريخ الأداء 
                                    </th>
                                    <th class=" text-center">
                                        :حالة العملية
                                    </th>
                                    <th class=" text-center">
                                        :المبلغ
                                    </th>';
                 echo'           </tr>
                </thead>';
            }
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                $count=1;
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent md:text-sm text-[7px]">
                                <td class=" text-center  font-bold py-3">'.$count.'</td>
                                <td class=" text-center  font-bold py-3">'.$row['beginning_period_date']->format('d-m-Y').'</td>
                                <td class=" text-center  font-bold py-3">'.$row['end_period_date']->format('d-m-Y').'</td>
                                <td class=" text-center  font-bold py-3">'.$row['checkout_date']->format('d-m-Y').'</td>';
                            if($_GET['language']=="en")
                                echo '<td class=" text-center  font-bold beginning-date status py-3">'.$row['real_operations_status'].'</td>';
                            else
                                echo '<td class=" text-center  font-bold beginning-date status py-3">خالص</td>';
                            echo'
                                <td class=" text-center  font-bold price py-3">'.$row['actual_price'].' DH</td>
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
            header('location:./search.php?client_name='.$clientName.'&language='.$_GET['language'].'');
        }
    }
    function searchClient($conn,$userId,$gymId,$clientName){
            $query="{CALL search(?,?)}";
            $stmt=sqlsrv_prepare($conn,$query,array($gymId,$clientName));
            $result=sqlsrv_execute($stmt);
            echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
            gap-3 row md:opacity-0">';
            while($row=sqlsrv_fetch_array($stmt)){
               if($row['operation_status']=="access"){ 
                echo '
                    <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[85%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                    <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                    <p class="text-green font-black ml-1"> :النهاية</p>
                </div>
                 <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                     <p class="text-green font-black"> :البداية</p>
                </div>
            </div>';
            echo '<div class="flex  text-[13px] font-black mt-1">';
                        if($_GET['language']=='en')
                            echo ' <div class=" basis-[100%] justify-end flex"><p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                        else
                            echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                            <p class="text-green font-black ml-1">:الوقت</p></div>';
                    echo '</div>';
                    echo'<div class="flex justify-end mt-2">';
                    if($_GET['language']=="en")    
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a></div>';
                        else
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">الدفع</button>
                            <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a></div>';
                            echo '
                            <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>';
                        }
               else{ 
                echo '
                    <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[85%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-red">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                    <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-red font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-red font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-red font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-red font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                    <p class="text-red font-black ml-1"> :النهاية</p>
                </div>
                 <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                     <p class="text-red font-black"> :البداية</p>
                </div>
            </div>';
            echo '<div class="flex  text-[13px] font-black mt-1">';
                        if($_GET['language']=='en')
                            echo ' <div class=" basis-[100%] justify-end flex"><p class="text-red font-black">Timer:</p>
                            <p class="text-center font-black timer text-red">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                        else
                            echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-red">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                            <p class="text-red font-black ml-1">:الوقت</p></div>';
                    echo '</div>';
                    echo'<div class="flex justify-end mt-2">';
                    if($_GET['language']=="en")    
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-red mr-2">confirm</button>
                                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a></div>';
                        else
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">الدفع</button>
                            <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a></div>';
                            echo '
                            <div class="bg-red h-[10%] w-full bottom absolute bottom-3 left-0"></div>';
                        }
                
                echo'</div>
            </div>';
            }
            echo ' </div>';
    }
    function pay($conn,$gymId,$clientId,$beginningDate,$kind,$price){
        $query="{CALL pay(?,?,?,?,?)}";
        $stmt1=sqlsrv_prepare($conn,$query,array($gymId,$clientId,$beginningDate,$kind,$price));
        $result=sqlsrv_execute($stmt1);
    }
    function displayFee($conn,$gymId,$month,$year){
        $query="{CALL displayFees(?,?,?)}";
        $stmt=sqlsrv_query($conn,$query,array($gymId,$month,$year),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $result=sqlsrv_execute($stmt);
        $rowCount=sqlsrv_num_rows($stmt);
        if($rowCount==0 ){
            if($_GET['language']=="en")
                echo '<div class="mt-5 text-1xl text-center  text-grey-light font-bold">You don\'t have any fee in this month</div>';
            else
                echo '<div class="mt-5 text-1xl text-center  text-grey-light font-bold">
             ليس لديك أي مصاريف  في هذا الشهر</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full mt-5"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl  text-green font-black text-[7px] md:text-sm ">';
                if($_GET['language']=="en")
                            echo '<tr>   
                                <th class=" text-center">
                                    Description: 
                                </th>
                                <th class=" text-center">
                                    date: 
                                </th>
                                <th class=" text-center">
                                    amount: 
                                </th>
                            </tr>';
                else
                    echo '<tr>   
                        <th class=" text-center">
                          :الحدث
                        </th>
                        <th class=" text-center">
                            :التاريخ
                        </th>
                        <th class=" text-center">
                            :المبلغ
                        </th>
                    </tr>';
                echo'</thead>';
                 echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                $count=1;
                while($row=sqlsrv_fetch_array($stmt)){
                    echo '<tr class=" border-b dark:border-gray-70 md:text-sm text-[7px] ">
                        <td class=" py-5 text-center font-bold max-w-32">'.$row['description'].'</td>
                        <td class=" py-5 text-center font-bold">'.$row['date_of_fee']->format('d-m-Y').'</td>
                        <td class=" py-5 text-center font-bold money-fee">'.$row['amount'].'<span> DH</span></td>
                    </tr>';
                    $count++;
                }
                echo '</tbody>';
                echo '</table>';
        }
    }
    function informationUser($conn,$userId,$row){
        echo '
        <div class="2xl:w-[23%] xl:w-[25%]  xl:flex w-[100%] flex flex-col items-center">
            <div class="xl:w-[100%] w-[85%] rounded-full p-[4px] bg-green relative">
                <img src="'.$row['user_image'].'" class="w-full h-[250px] rounded-full object-center image-field"/>
                <button class="absolute bottom-2 right-2 image-button bg-white text-green rounded-full hover:text-white hover:bg-green">
                <i class="fa-solid fa-circle-plus  fa-3x
                cursor-pointer "></i>
            </button>
            <input  type="file" name="image" 
            class="image-input hidden"/>
            </div>
            <div class="flex justify-center gap-2 mt-2 items-center basis-[50%]">';
                        if($_GET['language']=="en")
                            echo '<input type="submit" name="change" value="Change image" class="px-5 py-2 block text-white rounded-md  bg-green scale-110 cursor-pointer hover:bg-white border border-solid hover:text-green font-bold"/>';
                            else
                                 echo '<input type="submit" name="change" value="تغيير الصورة" class="px-5 py-2 block text-white rounded-md  bg-green scale-110 cursor-pointer hover:bg-white border border-solid hover:text-green font-bold"/>';
                       echo' </div>
        </div>
        <div class="2xl:w-[75%] xl:w-[74%] w-full px-5 text-md">
                    <div class="xl:flex xl:flex-row flex flex-col-reverse  gap-2 mt-5 ">';
                        if($_GET['language']=="en")
                            echo '<div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                            <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Client First Name:</p>
                            <p class="text-black font-bold basis-[60%] text-start">'.$row['first_name'].'</p>
                        </div>
                        <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                            <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Client Last Name:</p>
                            <p class="text-black font-bold basis-[60%] text-start">'.$row['Last_name'].'</p>
                        </div>';
                        else echo '<div class="flex  gap-2 mt-5 items-center basis-[50%]">
                            <p class="text-black font-bold basis-[60%] text-end">'.$row['first_name'].'</p>
                            <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-end xl:mr-5 mr-0">:الإسم الشخصي</p>
                        </div>
                        <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                            <p class="text-black font-bold basis-[60%] text-end">'.$row['Last_name'].'</p>
                             <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-end">:الإسم العائلي</p>
                        </div>';
                   echo '</div>';
                    echo '<div class="xl:flex xl:flex-row flex flex-col-reverse  gap-2 xl:mt-5 mt-3">';
                    if($_GET['language']=='en')
                        echo'
                        <div class="flex  gap-2 mt-5 items-center xl:basis-[50%] ">
                            <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Start Date:</p>
                            <p class="text-black font-bold basis-[60%] text-start">'.$row['beginning_period']->format('d-m-Y').'</p>
                        </div>
                        <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                            <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">End Date:</p>
                            <p class="text-black font-bold basis-[60%] text-start">'.$row['end_period']->format('d-m-Y').'</p>
                        </div>';
                    else echo '
                    <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                            <p class=" text-black font-bold basis-[60%] text-end xl:mr-3 mr-0">'.$row['end_period']->format('d-m-Y').'</p>
                            <p class=" text-green text-1xl md:text-sm  font-bold basis-[40%] text-end xl:mr-5 mr-0">:نهاية الإشتراك</p>
                        </div>
                    <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                            <p class="text-black font-bold basis-[60%] text-end">'.$row['beginning_period']->format('d-m-Y').'</p>
                            <p class="text-end text-green text-1xl md:text-sm  font-bold basis-[40%] "> :بداية الإشتراك</p>
                        </div>
                        ';
                    echo '</div>';
                    echo'<div class="xl:flex xl:flex-row flex flex-col-reverse  gap-2 xl:mt-5 mt-3">';
                    if($_GET['language']=="en")
                        echo'
                        <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                            <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start ">Subscription price:</p>
                            <p class="basis-[60%] text-black font-bold">'.$row['subscription_price'].'</p>
                        </div>
                        <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                            <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start ">email:</p>
                            <p class="basis-[60%] text-black font-bold">'.$row['email'].'</p>
                        </div>';
                    else   echo'
                    <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                       <p class="basis-[60%] text-black font-bold text-end">'.$row['subscription_price'].'</p>
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-end xl:mr-5 mr-0">:مبلغ الإشتراك</p>
                    </div>
                    <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                        <p class="basis-[60%] text-black font-bold text-end">'.$row['email'].'</p>
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-end ">:البريد الإلكتروني</p>
                    </div>';
                    echo'</div>';
        echo'</div>';
}

function checkSession(){
    if(isset($_SESSION['user_id'])){
        if((time()-$_SESSION['last_login'])/60>=10)
        {
             header('location:./logout.php?language='.$_SESSION['language'].'');
             exit;
        }
        else
        $_SESSION['last_login']=time();
    }
}

function selectActiveClientsAlternative($conn,$gymId,$skipNum){
    $query="{CALL selectActiveMembersAnotherPage(?,?)}";
    $stmt=sqlsrv_prepare($conn,$query,array($gymId,$skipNum));
    $result=sqlsrv_execute($stmt);
    echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
            gap-3 row opacity-0">';
            while($row=sqlsrv_fetch_array($stmt)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent   h-96 relative ">
                    <div class="h-[45%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[70%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[100%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                            <img src="'.$row['client_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['client_first_name'] .' '.$row['client_last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period_date']->format('d-m-Y').'</p>
                    <p class="text-green font-black ml-1"> :النهاية</p>
                </div>
                 <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period_date']->format('d-m-Y').'</p>
                     <p class="text-green font-black">:البداية</p>
                </div>
            </div>';
            echo '<div class="flex  text-[13px] font-black mt-1">';
                        if($_GET['language']=='en')
                            echo ' <div class=" basis-[100%] justify-start flex"><p class="text-green font-black">Timer:</p>
                            <p class="text-center font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p></div>';
                        else
                            echo '  <div class=" basis-[100%] justify-end flex "><p class=" font-black timer text-green-dark">
                            <span class="days mx-0.5"></span>d:<span class="hrs mx-0.5"></span>hrs:<span class="minutes mx-0.5 "></span>min:<span class="secondes mx-0.5"></span>s</p>
                            <p class="text-green font-black ml-1">:الوقت</p></div>';
                    echo '</div>';
                    echo'<div class="flex justify-end mt-2">';
                    if($_GET['language']=="en")    
                    echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">confirm</button>
                    <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
            else
                echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm hidden bg-green-dark mr-2">الدفع</button>
                <a href="./details.php?client_id='.$row['client_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                echo '</div>
                <div class="bg-green-dark h-[10%] w-full bottom absolute bottom-3 left-0"></div>
                </div>
            </div>';
            }
            echo ' </div>';
}
function checkSessionAdmin(){
    if(isset($_SESSION['user_id'])){
        if((time()-$_SESSION['last_login'])/60>=10)
        {
             header('location:../users_field/logout.php?language='.$_SESSION['language'].'');
             exit;
        }
        else
        $_SESSION['last_login']=time();
    }
}
function newUsersOfThisMonth($conn){
    $query="{CALL newUsersOfThisMonth}";
    $stmt=sqlsrv_prepare($conn,$query,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    $result=sqlsrv_execute($stmt);
    $rowCount=sqlsrv_fetch_array($stmt);
    return $rowCount['number'];
}
function selectUsersDashboard($conn){
    $query="{CALL selectUsers}";
    $stmt=sqlsrv_prepare($conn,$query,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    $result=sqlsrv_execute($stmt);
    $rowCount=sqlsrv_num_rows($stmt);
    if($rowCount==0){
        if($_GET['language']=="en")
            echo '<div class="text-1xl text-center mt-5 text-grey-light font-bold">You don\'t have any Users</div>';
        else
        echo '<div class="text-1xl text-center mt-5 text-grey-light font-bold">ليس لديك أي متدرب</div>';
    }
    else{
        echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
        gap-3 ">';
        while($row=sqlsrv_fetch_array($stmt)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-80 relative ">
                <div class="h-[50%] px-10 mt-2 flex justify-center">
                    <div class="h-full w-[75%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[90%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                        <img src="'.$row['user_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                    </div>
                </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['first_name'] .' '.$row['last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['first_name'] .' '.$row['last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period']->format('d-m-Y').'</p>
                    <p class="text-green font-black ml-1"> :النهاية</p>
                </div>
                <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period']->format('d-m-Y').'</p>
                    <p class="text-green font-black">:البداية</p>
                </div>
            </div>';
                    echo'<div class="flex justify-between mt-2">';
                    if($_GET['language']=="en")    
                        echo '<p class="block  px-3 py-2   mt-3 rounded-md font-bold  mr-2 status">'.$row['status'].'</p>
                            <a href="./details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                    else
                        echo '<p class="block  px-3 py-2  mt-3 rounded-md font-bold  status  mr-2">'.$row['status'].'</p>
                        <a href="./details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                        echo '<div></div>
                        </div>';
                echo'</div>
            </div>';
        }
        echo ' </div>';
    }
}
function sidebarUser(){
    if($_GET['language']=="en")
        echo '<div class="md:basis-[18%] bg-green  h-screen rounded-lg xl:sticky xl:top-0
        fixed top-0 left-0 basis-[50%] translate-x-[-100%] z-20 xl:translate-x-[] sidebar transition duration-300">
            <div class="flex items-center z-10 px-3 bg-black py-5 rounded-bl-full justify-between">
                <div class="flex items-center">
                    <img src="../images/logo.png"  class="block w-[50px] h-[50px]">
                    <p class="ml-3 text-1xl font-bold text-white xl:text-md">Gym Manager</p>
                </div>
                <i class="fa-sharp fa-solid fa-xmark text-white cursor-pointer fa-1x xl:invisible visible cross hover:scale-125 transform transition duration-100 fa-2x ml-5"></i>
            </div>
            <div class="flex items-center text-white  w-[97%]   mt-5  px-6 py-2 hover:bg-white mx-2 rounded-l-full cursor-pointer   hover:text-green transform transition duration-300 link-page dashboard
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-table block basis-[15%]"></i>
                        <a href="./admin_dashboard.php?language='.$_GET['language'].'" class="cursor-pointer block basis-[85%]">Dashboard</a>
            </div>
            <div class="flex items-center text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page expired_members
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-eye-slash basis-[15%]"></i>
                        <a href="./expired_users.php?language='.$_GET['language'].'" class="basis-[85%] cursor-pointer">Expired Users</a>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page active_member
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-user-check block basis-[15%]"></i>
                        <a class="cursor-pointer block basis-[85%]" href="../admin_field/active_users.php?language='.$_GET['language'].'">Active Users</a>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page active_member
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-user-check block basis-[15%]"></i>
                        <a class="cursor-pointer block basis-[85%]" href="../admin_field/inactive_users.php?language='.$_GET['language'].'">Inactive Users</a>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-right-from-bracket block basis-[15%]"></i>
                        <a href="../users_field/logout.php?language='.$_GET['language'].'" class="cursor-pointer basis-[85%]">Log out</a>
            </div>
        </div>';
        else 
        echo '<div class="md:basis-[18%] bg-green  h-screen rounded-lg md:sticky md:top-0
        fixed top-0 left-0 basis-[50%] translate-x-[-100%] z-20 md:translate-x-[] sidebar transition duration-300">
            <div class="flex items-center z-10 px-3 bg-black py-5 rounded-bl-full
             justify-between">
                <div class="flex items-center">
                    <img src="../images/logo.png"  class="block w-[50px] h-[50px]">
                    <p class="ml-3 text-1xl xl:text-md font-bold text-white">Gym Manager</p>
                </div>
                <i class="fa-sharp fa-solid fa-xmark text-white fa-1x md:invisible visible cross hover:scale-125 transform transition duration-100 fa-2x ml-5"></i>
            </div>
            <div class="flex items-center text-white  w-[97%]   mt-5  px-6 py-2 hover:bg-white mx-2 rounded-l-full cursor-pointer   hover:text-green transform transition duration-300 link-page dashboard
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-table block basis-[15%]"></i>
                        <a href="./admin_dashboard.php?language='.$_GET['language'].'" class="cursor-pointer block basis-[85%]">لوحة التحكم</a>
            </div>
            <div class="flex items-center text-white  w-[97%]   px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page expired_members
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-eye-slash basis-[15%]"></i>
                        <a href="../admin_field/expired_users.php?language='.$_GET['language'].'" class="basis-[85%] cursor-pointer">الأعضاء منتهية الصلاحية</a>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page active_member
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-user-check block basis-[15%]"></i>
                        <a class="cursor-pointer block basis-[85%]" href="../admin_field/active_users.php?language='.$_GET['language'].'">الأعضاء سارية الصلاحية</a>
            </div>
            <div class="flex items-center text-white  w-[97%]  text-orange px-6 py-2 hover:bg-white mx-2 mt-3  rounded-l-full cursor-pointer  hover:text-green transform transition duration-300 link-page
            " style="border-top-right-radius:-20px;">
                        <i class="fa-solid fa-right-from-bracket block basis-[15%]"></i>
                        <a href="../users_field/logout.php?language='.$_GET['language'].'" class="cursor-pointer basis-[85%]">تسجيل خروج</a>
            </div>
        </div>';
    }
    function selectExpiredUsers($conn){
        $query="{CALL expiredUsers}";
        $stmt=sqlsrv_prepare($conn,$query,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $result=sqlsrv_execute($stmt);
        $rowCount=sqlsrv_num_rows($stmt);
        if($rowCount==0){
            if($_GET['language']=="en")
                echo '<div class="text-xl text-center text-grey-light font-bold">You don\'t have any expired users</div>';
            else
                echo '<div class="text-xl text-center text-grey-light font-bold">
                ليس لديك أي أعضاء منتهية الصلاحية
                </div>';
        }
        else{
            echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
            gap-3 ">';
            while($row=sqlsrv_fetch_array($stmt)){
                echo '
                <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-80 relative ">
                    <div class="h-[50%] px-10 mt-2 flex justify-center">
                        <div class="h-full w-[75%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[90%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                            <img src="'.$row['user_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                        </div>
                    </div>
                <div class="px-3 w-full mt-2">
                    <div class="flex w-full text-[11px]">';
                if($_GET['language']=='en')
                    echo '
                        <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                        '.$row['first_name'] .' '.$row['Last_name'].'</span></p>';
                else
                    echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                        '.$row['first_name'] .' '.$row['Last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
                echo '</div>';
                if($_GET['language']=="en")
                echo '<div class="flex  text-[13px] font-black mt-1">
                        <div class=" basis-[55%] flex text-[11px]">
                            <p class="text-green font-black">start:</p>
                            <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period']->format('d-m-Y').'</p>
                        </div>
                        <div class=" basis-[45%] flex text-[11px]">
                            <p class="text-green font-black">end:</p>
                            <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period']->format('d-m-Y').'</p>
                        </div>
                    </div>';
                else 
                echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
                <div class=" basis-[55%] flex text-[11px] ">
                    <p  class="text-center  text-black  end-date font-bold">'.$row['end_period']->format('d-m-Y').'</p>
                    <p class="text-green font-black ml-1"> :النهاية</p>
                </div>
                 <div class=" basis-[45%] flex text-[11px] justify-end">
                    <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period']->format('d-m-Y').'</p>
                     <p class="text-green font-black ">:البداية</p>
                </div>
            </div>';
                    echo'<div class="flex justify-end mt-2">';
                    if($_GET['language']=="en")    
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm  bg-green-dark mr-2">confirm</button>
                                <a href="./details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                        else
                            echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm  bg-green-dark mr-2">الدفع</button>
                            <a href="./details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                            echo '</div>  
                </div>';
                echo '<p class="text-red mt-2 ml-2 font-bold">'.$row['status'].'</p>';
            echo'</div>';
            }
            echo ' </div>';
        }
    }


function userPay($conn,$clientId,$kind){
    $query="{CALL userPay(?,?)}";
    $stmt=sqlsrv_prepare($conn,$query,array($clientId,$kind));
    $result=sqlsrv_execute($stmt);
}
function selectActiveUsers($conn){
    $query="{CALL activeUsers}";
    $stmt=sqlsrv_prepare($conn,$query,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    $result=sqlsrv_execute($stmt);
    $rowCount=sqlsrv_num_rows($stmt);
    if($rowCount==0){
        if($_GET['language']=="en")
            echo '<div class="text-xl text-center text-grey-light font-bold">You don\'t have any active users</div>';
        else
            echo '<div class="text-xl text-center text-grey-light font-bold">
            ليس لديك أي أعضاء
            سارية الصلاحية    
            </div>';
    }
    else{
        echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
        gap-3 ">';
        while($row=sqlsrv_fetch_array($stmt)){
            echo '
            <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-80 relative ">
                <div class="h-[50%] px-10 mt-2 flex justify-center">
                    <div class="h-full w-[75%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[90%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                        <img src="'.$row['user_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                    </div>
                </div>
            <div class="px-3 w-full mt-2">
                <div class="flex w-full text-[11px]">';
            if($_GET['language']=='en')
                echo '
                    <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                    '.$row['first_name'] .' '.$row['Last_name'].'</span></p>';
            else
                echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                    '.$row['first_name'] .' '.$row['Last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
            echo '</div>';
            if($_GET['language']=="en")
            echo '<div class="flex  text-[13px] font-black mt-1">
                    <div class=" basis-[55%] flex text-[11px]">
                        <p class="text-green font-black">start:</p>
                        <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period']->format('d-m-Y').'</p>
                    </div>
                    <div class=" basis-[45%] flex text-[11px]">
                        <p class="text-green font-black">end:</p>
                        <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period']->format('d-m-Y').'</p>
                    </div>
                </div>';
            else 
            echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
            <div class=" basis-[55%] flex text-[11px] ">
                <p  class="text-center  text-black  end-date font-bold">'.$row['end_period']->format('d-m-Y').'</p>
                <p class="text-green font-black ml-1"> :النهاية</p>
            </div>
             <div class=" basis-[45%] flex text-[11px] justify-end">
                <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period']->format('d-m-Y').'</p>
                 <p class="text-green font-black ">:البداية</p>
            </div>
        </div>';
                echo'<div class="flex justify-end mt-2">';
                if($_GET['language']=="en")    
                        echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm  bg-green-dark mr-2">confirm</button>
                            <a href="../admin_field/details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                    else
                        echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm  bg-green-dark mr-2">الدفع</button>
                        <a href="../admin_field/details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                        echo '</div>  
            </div>';
            echo '<p class="text-green-dark mt-2 ml-2 font-bold">'.$row['status'].'</p>';
        echo'</div>';
        }
        echo ' </div>';
    }
}
function selectInactiveUsers($conn){
    $query="{CALL inactiveUsers}";
    $stmt=sqlsrv_prepare($conn,$query,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    $result=sqlsrv_execute($stmt);
    $rowCount=sqlsrv_num_rows($stmt);
    if($rowCount==0){
        if($_GET['language']=="en")
            echo '<div class="text-xl text-center text-grey-light font-bold">You don\'t have any active users</div>';
        else
            echo '<div class="text-xl text-center text-grey-light font-bold">
            ليس لديك أي أعضاء
            سارية الصلاحية    
            </div>';
    }
    else{
        echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
        gap-3 ">';
        while($row=sqlsrv_fetch_array($stmt)){
            echo '
            <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-80 relative ">
                <div class="h-[50%] px-10 mt-2 flex justify-center">
                    <div class="h-full w-[75%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[90%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                        <img src="'.$row['user_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                    </div>
                </div>
            <div class="px-3 w-full mt-2">
                <div class="flex w-full text-[11px]">';
            if($_GET['language']=='en')
                echo '
                    <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                    '.$row['first_name'] .' '.$row['Last_name'].'</span></p>';
            else
                echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                    '.$row['first_name'] .' '.$row['Last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
            echo '</div>';
           
                echo'<div class="flex justify-end mt-2">';
                if($_GET['language']=="en")    
                        echo '
                            <a href="../admin_field/details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                    else
                        echo '
                        <a href="../admin_field/details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                        echo '</div>  
            </div>';
            echo '<p class="text-green-dark mt-2 ml-2 font-bold">'.$row['status'].'</p>';
        echo'</div>';
        }
        echo ' </div>';
    }
}
function searchFormUser(){
    if(isset($_POST['search'])){
        $clientName=$_POST['client_name'];
        header('location:./search_user.php?client_name='.$clientName.'&language='.$_GET['language'].'');
    }
}

function searchUser($conn,$userName){
    $query="{CALL searchUser(?)}";
    $stmt=sqlsrv_prepare($conn,$query,array($userName));
    $result=sqlsrv_execute($stmt);
    echo '<div class="w-full  p-3 mt-3 rounded-md grid xl:grid-cols-4 2xl:grid-cols-4  3xl:grid-cols-6 4xl:grid-cols-7 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 
    gap-3">';
    while($row=sqlsrv_fetch_array($stmt)){
        echo '
            <div class="shadow-[0_3px_10px_rgb(0,0,0,0.2)] flex-col items-center rounded-md  parent  h-80 relative ">
                <div class="h-[50%] px-10 mt-2 flex justify-center">
                    <div class="h-full w-[75%] sm:w-[70%] md:w-[85%] lg:w-[90%] xl:w-[90%] 2xl:w-[75%] 3xl:w-[80%] p-1 4xl:w-[80%] rounded-full  bg-green">    
                        <img src="'.$row['user_image'].'" class=" h-full w-full  object-center rounded-full brightness-125">
                    </div>
                </div>
            <div class="px-3 w-full mt-2">
                <div class="flex w-full text-[11px]">';
            if($_GET['language']=='en')
                echo '
                    <p class=" basis-[90%]  text-green font-black">name:<span class=" text-black ml-1 font-bold full-name">
                    '.$row['first_name'] .' '.$row['last_name'].'</span></p>';
            else
                echo '<p class=" basis-[100%]  text-green font-black text-end"><span class=" text-black  font-bold full-name">
                    '.$row['first_name'] .' '.$row['last_name'].'</span> <span class="ml-1">:الإسم</span></p>';
            echo '</div>';
            if($_GET['language']=="en")
            echo '<div class="flex  text-[13px] font-black mt-1">
                    <div class=" basis-[55%] flex text-[11px]">
                        <p class="text-green font-black">start:</p>
                        <p class="text-center text-black ml-1 beginning-date font-bold">'.$row['beginning_period']->format('d-m-Y').'</p>
                    </div>
                    <div class=" basis-[45%] flex text-[11px]">
                        <p class="text-green font-black">end:</p>
                        <p  class="text-center  text-black ml-1 end-date font-bold">'.$row['end_period']->format('d-m-Y').'</p>
                    </div>
                </div>';
            else 
            echo '<div class="flex  text-[13px] font-black mt-1 justify-end">
            <div class=" basis-[55%] flex text-[11px] ">
                <p  class="text-center  text-black  end-date font-bold">'.$row['end_period']->format('d-m-Y').'</p>
                <p class="text-green font-black ml-1"> :النهاية</p>
            </div>
             <div class=" basis-[45%] flex text-[11px] justify-end">
                <p class="text-center text-black  beginning-date font-bold mr-1">'.$row['beginning_period']->format('d-m-Y').'</p>
                 <p class="text-green font-black ">:البداية</p>
            </div>
        </div>';
                echo'<div class="flex justify-end mt-2">';
                if($_GET['language']=="en")    
                        echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm  bg-green-dark mr-2">confirm</button>
                            <a href="./details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">details</a>';
                    else
                        echo '<button class="block  px-3 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold confirm  bg-green-dark mr-2">الدفع</button>
                        <a href="./details_user.php?client_id='.$row['user_id'].'&language='.$_GET['language'].'" class="block  px-3 py-2 p text-black bg-grey  transition duration-100 ease-in hover:scale-110 mt-3 rounded-md font-bold">تفاصيل</a>';
                        echo '</div>  
            </div>';
            echo '<p class="mt-2 ml-2 font-bold status">'.$row['status'].'</p>';
        echo'</div>';
        }
        echo ' </div>';       
}
function informationEachUser($conn,$row){
    echo '
    <div class="xl:basis-[25%] md:w-[40%] sm:w-[50%] w-[85%]  rounded-full p-[4px] bg-green relative 
        ">
        <img src="'.$row['user_image'].'" class="w-full h-[230px]  rounded-full object-center image-field"/>
        <button class="absolute bottom-2 right-2 image-button bg-white text-green rounded-full hover:text-white hover:bg-green">
            <i class="fa-solid fa-circle-plus  fa-3x
            cursor-pointer "></i>
        </button>
        <input  type="file" name="image" 
        class="image-input hidden"/>
    </div>
    <div class="xl:basis-[75%] w-full ">
                <div class="xl:flex xl:flex-row flex flex-col-reverse  gap-2 mt-5 ">';
                if($_GET['language']=="en")
                    echo'<div class="flex  gap-2 mt-5 items-center xl:basis-[50%] ">
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Client First Name:</p>
                        <p class="text-black font-bold basis-[60%] text-start">'.$row['first_name'].'</p>
                    </div>
                    <div class="flex  gap-2 mt-5 items-center basis-[50%]">
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Client Last Name:</p>
                        <p class="text-black font-bold basis-[60%] text-start">'.$row['last_name'].'</p>
                    </div>';
                else
                    echo'
                    <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                        <p class="text-black font-bold basis-[40%] text-end">'.$row['last_name'].'</p>
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5">:الإسم العائلي</p>
                </div>
                    <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                        <p class="text-black font-bold basis-[40%] text-end">'.$row['first_name'].'</p>
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5">:الإسم الشخصي</p>
                    </div>
                    ';
                echo'</div>
                <div class="xl:flex xl:flex-row flex flex-col  gap-2 mt-5 xl:px-5">';
                    if($_GET['language']=="en")
                    echo'
                    <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                    <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Joinning Date:</p>
                          <p class="text-black font-bold basis-[60%] text-start">'.$row['joinning_date']->format('d-m-Y').'</p>
                        
                    </div>
                    <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                     <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Phone Number:(0123456789)</p>
                        <input type="text" pattern="0[0-9]{9}" name="phone_number"  class="text-black font-bold basis-[60%] text-start bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value="'.$row['phone_number'].'"/>
                    </div>';
                    else
                        echo'
                    <div class="flex  gap-2 mt-5 items-center xl:basis-[50%] ">
                          <p class="text-black font-bold basis-[40%] text-end">'.$row['joinning_date']->format('d-m-Y').'</p>
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5">:تاريخ الانضمام</p>
                    </div>
                    <div class="flex  gap-2 mt-5 items-center xl:basis-[50%]">
                        <input type="text" pattern="0[0-9]{9}" name="phone_number"  class="text-black font-bold xl:basis-[50%] basis-[50%] text-center bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required value="'.$row['phone_number'].'"/>
                        <p class="text-green text-1xl md:text-sm  font-bold xl:basis-[50%] basis-[50%] text-end xl:mr-0 mr-5">:رقم الهاتف(0123456789)</p>
                    </div>';
                echo'</div>
                <div class="xl:flex xl:flex-row flex flex-col  gap-2 mt-5 px-5">';
                if($_GET['language']=="en")
                    echo'<div class="flex  gap-2 mt-5 items-center basis-[50%] ">
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start">Email:</p>
                         <p class="text-black font-bold xl:basis-[60%] basis-[70%] text-start ">'.$row['email'].'</p>
                    </div>
                  
                       <div class="flex  gap-2 mt-5 items-center xl:basis-[50%] ">
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[40%] text-start mr-5">city:</p>
                           <p class="text-black font-bold basis-[60%] text-start">'.$row['city'].'</p>
                    </div>
                    
                    ';
               
                else
                echo'<div class="flex  gap-2 mt-5 items-center  xl:basis-[50%]">
                     <p class="text-black font-bold basis-[40%] text-center ml-5" dir="rtl" lang="ar">'.$row['email'].'<span class="text-black font-bold"> </span></p>
                    <p class="text-green text-1xl md:text-sm font-bold basis-[50%]   text-end xl:mr-5">:البريد الإلكتروني</p>
                </div>
                   <div class="flex  gap-2 mt-5 items-center xl:basis-[50%] ">
                          <p class="text-black font-bold basis-[40%] text-end">'.$row['city'].'</p>
                        <p class="text-green text-1xl md:text-sm  font-bold basis-[60%] text-end mr-5">:المدينة</p>
                    </div>
        ';
        ;
                echo'</div>';
                echo'<button class="block  px-10 py-2 p text-white transition duration-100 ease-in hover:scale-110 mt-20  font-bold reset  bg-red mr-2">reset</button>';
                echo'</div>';
    
}


function displayDetailsUser(){
    $query="{CALL detailsClient(?)}";
        $result=sqlsrv_query($conn,$query,array($clientId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
        $rowCount=sqlsrv_num_rows($result);
        if($rowCount==0){
            echo '<div class="mt-10 text-xl text-center text-grey-light font-bold">This Client don\'t have any operations</div>';
        }
        else{
            echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full mt-10"
            style="border-radius:20px;">
                <thead class="capitalise rounded-xl bg-white text-green font-black md:text-sm text-[6px]">
                            <tr>';
                            if($_GET['language']=="en")
                                echo'  <th class=" text-center">
                                    operation number: 
                                </th>
                                <th class=" text-center">
                                    Beginning period date: 
                                </th>
                                <th class=" text-center">
                                    End period date: 
                                </th>
                                <th class=" text-center">
                                    checkout_date: 
                                </th>
                                <th class=" text-center">
                                    Operation status: 
                                </th>
                                <th class=" text-center">
                                    price: 
                                </th>';
                                else
                                    echo'  <th class=" text-center">
                                       :رقم العملية
                                    </th>
                                    <th class=" text-center">
                                        :تاريخ البداية
                                    </th>
                                    <th class=" text-center">
                                         :تاريخ النهاية
                                    </th>
                                    <th class=" text-center">
                                        :تاريخ الأداء 
                                    </th>
                                    <th class=" text-center">
                                        :حالة العملية
                                    </th>
                                    <th class=" text-center">
                                        :المبلغ
                                    </th>';
                 echo'           </tr>
                </thead>';
                echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
                $count=1;
                while($row=sqlsrv_fetch_array($result)){
                    echo '<tr class=" border-b dark:border-gray-70 parent md:text-sm text-[7px]">
                                <td class=" text-center  font-bold py-3">'.$count.'</td>
                                <td class=" text-center  font-bold py-3">'.$row['beginning_period_date']->format('d-m-Y').'</td>
                                <td class=" text-center  font-bold py-3">'.$row['end_period_date']->format('d-m-Y').'</td>
                                <td class=" text-center  font-bold py-3">'.$row['checkout_date']->format('d-m-Y').'</td>';
                            if($_GET['language']=="en")
                                echo '<td class=" text-center  font-bold beginning-date status py-3">'.$row['real_operations_status'].'</td>';
                            else
                                echo '<td class=" text-center  font-bold beginning-date status py-3">خالص</td>';
                            echo'
                                <td class=" text-center  font-bold price py-3">'.$row['actual_price'].' DH</td>
                    </tr>';
                    $count++;
                }
                echo '</tbody>';
                echo '</table>';
        }    

}

function displayDetailsEachUser($conn,$clientId){
    $query="{CALL detailsEachUser(?)}";
    $stmt=sqlsrv_prepare($conn,$query,array($clientId),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    $result=sqlsrv_execute($stmt);
    $rowCount=sqlsrv_num_rows($stmt);
    if($rowCount==0){
        echo '<div class="mt-10 text-xl text-center text-grey-light font-bold">This Client don\'t have any operations</div>';
    }
    else{
        echo '<table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  bg-white w-full mt-10"
        style="border-radius:20px;">
            <thead class="capitalise rounded-xl bg-white text-green font-black md:text-sm text-[6px]">
                        <tr>';
                        if($_GET['language']=="en")
                            echo'  <th class=" text-center">
                                operation number: 
                            </th>
                            <th class=" text-center">
                                Beginning  date: 
                            </th>
                            <th class=" text-center">
                                End  date: 
                            </th>
                            <th class=" text-center">
                                payment type: 
                            </th>
                            ';
                            else
                                echo'  <th class=" text-center">
                                   :رقم العملية
                                </th>
                                <th class=" text-center">
                                    :تاريخ البداية
                                </th>
                                <th class=" text-center">
                                     :تاريخ النهاية
                                </th>
                                <th class=" text-center">
                                    :حالة العملية
                                </th>
                               ';
             echo'           </tr>
            </thead>';
            echo '<tbody class="dark:bg-gray-700 dark:text-gray-400 ">';
            $count=1;
            while($row=sqlsrv_fetch_array($stmt)){
                echo '<tr class=" border-b dark:border-gray-70 parent md:text-sm text-[7px]">
                            <td class=" text-center  font-bold py-3">'.$count.'</td>
                            <td class=" text-center  font-bold py-3">'.$row['beginning_DATE']->format('d-m-Y').'</td>
                            <td class=" text-center  font-bold py-3">'.$row['end_date']->format('d-m-Y').'</td>';
                            echo '<td class=" text-center  font-bold beginning-date status py-3">'.$row['payment_type'].'</td>';
                            echo'
                </tr>';
                $count++;
            }
            echo '</tbody>';
            echo '</table>';
    }
}