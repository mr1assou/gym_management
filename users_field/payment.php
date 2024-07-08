<?php
    include '../vendor/connect.php';
    include '../functions/functions.php';
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:./login.php?language='.$_GET['language'].'');
        exit;
    }
    searchForm($_SESSION['user_id'],$_SESSION['gym_id']);
    $query="{CALL selectSubscriptionPrice(?)}";
    $result=sqlsrv_query($conn,$query,Array($_SESSION['user_id']));
    $row=sqlsrv_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
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
             sidebar($_SESSION['user_id'],$_SESSION['gym_id']);
        ?>
        <!-- content -->
        <div class="md:basis-[82%] basis-[100%] z-0" style="padding-left:10px;">
            <?php include '../includes/header.php'?>
            <div class="flex justify-center w-full px-3 py-10">
            <form class=" mr-0 md:mr-20 z-10 bg-white rounded-md shadow-[0_3px_10px_rgb(0,0,0,0.2)] md:w-[80%] md:px-[2%] md:py-[1%] w-[100%] px-5 py-2" action="" method="post"  enctype="multipart/form-data">
            <h1 class="text-3xl font-bold mb-6 text-green">Unlock the Full Potential of Your Gym with Our All-In-One Management App!</h1>
        
        <p class="mb-6">Dear Gym Owner,</p>
        
        <p class="mb-6">Congratulations on taking the first step towards revolutionizing your gym management with our cutting-edge web app! We hope you've enjoyed the benefits of our free trial and seen firsthand how our platform can streamline your operations.</p>
        
        <h2 class="text-2xl font-semibold mb-4 text-green">Here’s Why You Should Subscribe:</h2>
        
        <ul class="list-disc list-inside mb-6 text-gray-700">
            <li class="mb-2"><strong>Effortless Member Management:</strong> Instantly identify members whose subscriptions are about to expire. Ensure only paying members access your gym, improving security and accountability.</li>
            <li class="mb-2"><strong>Financial Insights at Your Fingertips:</strong> Track your monthly earnings with ease. Gain valuable insights into your revenue streams and financial performance.</li>
            <li class="mb-2"><strong>Grow Your Gym Community:</strong> Monitor the number of new clients each month. Develop targeted marketing strategies to attract and retain more members.</li>
            <li class="mb-2"><strong>Time-Saving Automation:</strong> Say goodbye to manual tracking and paperwork. Free up more time to focus on what you do best – providing an exceptional fitness experience for your members.</li>
            <li class="mb-2"><strong>Access from Anywhere:</strong> Manage your gym on the go with mobile access. Stay connected to your gym’s operations from anywhere in the world.</li>
            <li class="mb-2"><strong>Client Earnings Insights:</strong> See exactly how much you gain from each client and all his operations, helping you optimize your pricing and services.</li>
            <li class="mb-2"><strong>Instant Client Lookup:</strong> Find client information in milliseconds rather than using a register or copybook.</li>
        </ul>
        
        <p class="mb-6">For just <span class="font-bold"><?php echo $row['subscription_price']
        ?> </span> <span class="font-bold">dirhams </span> per month, our app offers unparalleled value, helping you run your gym more efficiently and effectively. The data-driven insights and automated processes will not only save you time and effort but also boost your profitability and growth.</p>
        
        <p class="mb-6">Don't miss out on the opportunity to elevate your gym business. Subscribe now and continue enjoying all the benefits our app has to offer!</p>
        
        <p class="mb-6 text-green"><strong>Ready to transform your gym management? Subscribe today!</strong></p>
        
        <p class="mb-6">Thank you for choosing our app. We look forward to being a part of your gym’s success story.</p>
        
        <p class="mb-6">Best regards,<br>
        <?php echo '<div class="flex justify-between items-center">
        <div class="flex-col  items-center justify-center" >
            <div class="md:w-[150px] md:h-[150px] w-[40px] h-[30px] bg-green  rounded-full p-[2px] mr-2">
            <img src="../images/marwane_assou.jpeg" alt="" class="rounded-full object-cover brightness-100 w-full h-full">
            </div>
            <p class="text-green font-bold text-[7px] md:text-[15px] ml-5 mt-1">Marwane Assou</p>
            <p class="font-bold text-black ml-5 mt-1 text-[12px]">Creator of Gym Manager</p>
            </div>
            <div class="w-[50%]">
                <div class="flex ">
                    <span class="basis-[35%] font-bold text-green">Bank Account:</span></p>
                    <span class="basis-[65%] font-bold">5110371211013900</span></p>
                </div>
                <div class="flex mt-2">
                    <span class="basis-[35%] font-bold text-green">Contact:</span></p>
                    <span class="basis-[65%] font-bold">+212635103092</span></p>
                </div>
                <div class="flex mt-2 ">
                    <span class="basis-[35%] font-bold text-green">Email:</span></p>
                    <span class="basis-[65%] font-bold">marwane.assou@gmail.com</span></p>
                </div>
            </div>
            </div>
            ';?></p>
            </form> 
        </div>         
    </div>
    </div>
    <!-- javascript -->
    <script src="../js/payment.js" type="module"></script>
</body>
</html>





