<?php
 require('session.php');
confirm_logged_in(); 
include('../db.php');
if (logged_in()) {

       
       
 if(isset($_POST['submit'])){
            $name1=$_POST['name'];
            $model=$_POST['model'];
            $link=$_POST['link'];
            $category=$_POST['category'];
            $payout=$_POST['payout'];
             $event=$_POST['event'];
             $caps=$_POST['caps'];
            $d_event=$_POST['d_event'];
            
               $sql="INSERT INTO `offer` (`name`,`model`,`link`,`category`,`payout`,`d_event`,`event`,`caps`) VALUES ('$name1','$model','$link','$category','$payout','$d_event','$event','$caps')";
            
            $res=mysqli_query($conn,$sql);
            
            if($res){
              
                        echo "<script>alert('Successfully Added')</script>";
                        echo "<meta http-equiv = 'refresh' content = '0; url = index.php' />";
            
            }else{
                        echo mysqli_error($conn);
            }
          
            
            }
?>
<script>
if(performance.navigation.type == 2){
   location.reload(true);
}
</script>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.min.css" />
<title>Add Camp</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="./Assets/loader.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
   <script src="https://cdn.tailwindcss.com"></script>
<script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>

</head>
<body class="dark:bg-gray-700" style="font-family: 'Poppins', sans-serif;">
    <div id="preloader"></div>
<?php include("nav.php"); ?>

<center>
<div class="mt-5 p-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700 ">
<form class="space-y-6 text-left dark:text-white m-1" action="" method="post">
<h3 class="text-xl font-medium text-gray-900 dark:text-white">Add Offer</h3>
<div class="mb-6">
<input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Name" required>
</div>
<div class="mb-6">
<input type="text" name="model"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Model" required>
</div>
<div class="mb-6">
<input type="text" name="event"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Event" required>
</div>
<div class="mb-6">
<input type="text" name="link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Link" required>
</div>
<div class="mb-6">
<input type="text" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Category" required>
</div>
<div class="mb-6">
<input type="text" name="payout" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Payout" required>
</div>
<div class="mb-6">
<input type="text" name="d_event" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Event 2 / no" required>
</div>
<div class="mb-6">
<input type="text" name="caps" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Caps" required>
</div>
<button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="submit">Add</button>

</form>
<br>

</center>

<script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
<script src="./Assets/dark.js"></script>
<script src="./Assets/animate.js"></script>

</body>
</html>
<?php } ?>