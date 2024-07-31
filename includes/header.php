<div class="invisible w-full p-4 flex justify-between items-center gap-6 bg-white sticky top-0 z-10 shadow-xl">
                <i class="fa-solid fa-bars text-black cursor-pointer xl:invisible visible toggleButton"></i>
                <form class="flex items-center max-w-sm mx-auto" action="" method="post">   
                    <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                </svg>
            </div>
            <input type="text" id="simple-search" class="border text-sm rounded-lg  block w-full ps-10 p-2.5   dark:border-green dark:placeholder-gray-4" name="client_name" placeholder="Search name..." required />
        </div>
            <?php
                if($_GET['language']=="en")
                    echo'<input type="submit" class="font-bold md:p-2.5 p-1.5 ms-2 text-sm text-white bg-green rounded-lg border border-blue-700 hover:bg-white hover:text-green focus:ring-4 focus:outline-none  dark:bg-blue-600  dark:focus:ring-blue-800 cursor-pointer transform transition-transform duration-300 hover:scale-110" value="search" name="search">
                <span class="sr-only ">Search</span>';
                else
                    echo'<input type="submit" class="font-bold md:p-2.5 p-1.5 ms-2 text-sm text-white bg-green rounded-lg border border-blue-700 hover:bg-white hover:text-green focus:ring-4 focus:outline-none  dark:bg-blue-600  dark:focus:ring-blue-800 cursor-pointer transform transition-transform duration-300 hover:scale-110" value="بحث" name="search">
                    <span class="sr-only ">بحث</span>';
            ?>
        </input>
    </form>
        <div>
            <?php 
             $query="{CALL selectImageUser(?)}";
             $stmt=sqlsrv_prepare($conn,$query,Array($_SESSION['user_id']));
             $result=sqlsrv_execute($stmt);
            $output=sqlsrv_fetch_array($stmt);
            echo '<div class="flex items-center">
            <div class="md:w-[45px] md:h-[45px] w-[40px] h-[30px] bg-green  rounded-full p-[2px] mr-2">
                                    <img src="'.$output['user_image'].'" alt="" class="rounded-full object-center brightness-100 w-full h-full">
                                    </div>
                                    <p class="text-green font-bold text-[7px] md:text-[15px]">'.$_SESSION['first_name'].' '.$_SESSION['last_name'].'</p>
                                    </div>';?>
        </div>
        </div>