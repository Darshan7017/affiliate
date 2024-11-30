<?php
 require('session.php');
confirm_logged_in(); 
include('../db.php');
if (logged_in()) {
?>
<script>if(performance.navigation.type == 2){
   location.reload(true);
}</script>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.min.css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="./Assets/loader.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
</head>
<body class="dark:bg-gray-700" style="font-family: 'Poppins', sans-serif;">
<?php include("nav.php"); ?>
<div class=" bb dark:text-white">
<div class="flex flex-col">
<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
<div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
<div class="overflow-hidden shadow-md sm:rounded-lg">
<table class="min-w-full dark:text-white" id="myTable" >
<thead class="bg-gray-50 dark:bg-gray-700">
<tr>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Aff ID
</th>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Conversions
</th>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Clicks
</th>




</tr>
</thead>
<tbody>
             <?php 
        $offerid=$_GET['id'];
             $sql = "SELECT * FROM conversions where offerid=$offerid and `lead`=1";
             $resultset = mysqli_query($conn, $sql);
                while( $record = mysqli_fetch_assoc($resultset) ) {
                   $userid=$record['userid'];
                   
                    $sql="Select * from conversions where offerid=$offerid and lead=1 and userid=$userid";
                    $query=mysqli_query($conn,$sql);
                    $rows0=mysqli_num_rows($query);
                  
                    $sql1="Select * from conversions where offerid=$offerid and userid=$userid";
                    $query1=mysqli_query($conn,$sql1);
                    $rows1=mysqli_num_rows($query1);
                    if(!$_SESSION[$userid]){
                  ?>
<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
<td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
<?php echo $record['userid']; ?>
</td>
<td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
<?php echo $rows0; ?>
</td>
<td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
<?php echo $rows1; ?>
</td>

</tr>


<?php } $_SESSION[$userid]='1'; } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</a>

</center>
</div>
<br>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>
<script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
<script src="./Assets/dark.js"></script>
<script src="./Assets/animate.js"></script>
</body>
</html>
<?php } ?>