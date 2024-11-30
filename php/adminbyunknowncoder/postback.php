<?php
 require('session.php');
 confirm_logged_in(); 
include('../db.php');
 $id= $_SESSION['email'];
  $sql='SELECT * FROM admin where id=1';
  $resultset=  mysqli_query($conn,$sql);
  $record = mysqli_fetch_assoc($resultset);
  $token=$record['token'];
  $num = mysqli_num_rows($resultset);
  if($num == 0) {
   $sql="INSERT INTO `admin` (`token`) VALUES (UUID()) where email='$id'";
   $res=mysqli_query($conn,$sql);
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
<link rel="stylesheet" href="./Assets/loader.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
<title>Onx Camp-PostBack</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
<div class="p-4">
<br>
<center>
<div class="p-3 border border-gray-500 dark:border-white relative overflow-x-auto rounded-lg shadow-lg sm:rounded-lg">
<h3 class="text-xl font-medium text-gray-900 dark:text-white">Postback</h3>
<div><br>
<textarea id="myInput" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Postback URL" readonly><?php echo $domain.'l?token='.$token.'&tid={aff_click_id}&event={event_name}'; ?></textarea>
<br>
<button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" onclick="myFunction()">
    Copy Postback
  </button>
  <br>
	<div class="card-body border " style="border-radius:5px;border:1px solid #eee;">
	<h1 class="text-grey-400 mb-2 dark:text-white"> When Using (O18) <br><br> After Postback Given Above : tid={aff_click_id}
	<br> After Offer Link : &aff_click_id={tid}</h1>
</div>
<br>
<hr>
<br>
<ol class="relative border-l border-gray-200 dark:border-gray-700">                  
    <li class="mb-10 ml-6">            
        <span class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
            <svg aria-hidden="true" class="w-3 h-3 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
        </span>
        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Copy The PostBack From Above <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">First</span></h3>
        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">You Can See The Last {Replace_here}</time>
        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">When Using Offer 18 Or Other Panels Every Panel Have Their Own Significant Token For eg:{affclick_id},{aff_click_id}.</p>
        <a href="https://www.offer18.com" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"><svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path></svg> Go to O18</a>
    </li>
    <li class="mb-10 ml-6">
        <span class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
            <svg aria-hidden="true" class="w-3 h-3 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
        </span>
        <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Paste This As Your Postback in Trackier panel</h3>
        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Must Replace The Last</time>
        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Ask To Your Supervisor Or Users For The Replace thing.</p>
    </li>
</ol>
</div>




</center>


<script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
<script src="./Assets/dark.js"></script>
<script src="./Assets/animate.js"></script>
<script>
   function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Postback Url Copied Successfully ");
}
  </script>
</body>
</html>
