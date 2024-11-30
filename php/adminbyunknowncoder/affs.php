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
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.min.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./Assets/loader.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<title>Onx Camp- Affliates</title>
   <script src="https://cdn.tailwindcss.com"></script>
<script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>

</head>
<?php

if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
    $page = 1;
}

$num_per_page = 10;
$start_from = ($page - 1)*10;
?>
<body class="dark:bg-gray-700" style="font-family: 'Poppins', sans-serif;">
    <div id="preloader"></div>
<?php include("nav.php"); ?>
<div class="p-4">
<div class="mt-4 ">
    <?php 
    $number = "SELECT * FROM aff where status='approved'";
    $res12 = mysqli_query($conn,$number);
    $total_aff = mysqli_num_rows($res12);
    ?>
<h3 class="text-xl font-medium text-gray-900 dark:text-white m-5">Affiliates<span class="inline-flex justify-center items-center ml-2 w-8 h-8 text-xs font-semibold text-green-800 bg-green-200 rounded-full"><?php echo $total_aff; ?></span></h3>
  <center>
  <div class=" bb dark:text-white">
<div class="flex flex-col">
<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
<div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
<div class="overflow-hidden shadow-md sm:rounded-lg">
<table class="min-w-full dark:text-white" id="myTable" >
<thead class="bg-gray-50 dark:bg-gray-700">
<tr>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
ID
</th>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Name
</th>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Company
</th>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Email
</th>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Password
</th>

<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Telegram
</th>

<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Remove
</th>


</tr>
</thead>
<tbody>
             <?php 
           
             $sql = "SELECT * FROM aff where status='approved' limit $start_from,$num_per_page";
             $resultset = mysqli_query($conn, $sql);
                while( $record = mysqli_fetch_assoc($resultset) ) {

 
  		
                  ?>
<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
<td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
<?php echo $record['id']; ?>
</td>
<td  class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
<?php echo $record['name']; ?>
</td>
<td  class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
<?php echo $record['company']; ?>
</td>
<td  class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
<?php echo $record['email']; ?>
</td>
<td  class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
<?php echo $record['password']; ?>
</td>
<td  class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
<?php echo $record['tg']; ?>
</td>

<td  class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
<a href="remove-aff.php?id=<?php echo $record['id']; ?>" onclick="return confirm('Are you sure?')" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Remove</a>
</td>
</td>
</tr>

<?php } ?>
</tbody>
</table>
<?php
    
    $pr_query = "SELECT * FROM aff where status='approved'";
    $pr_result =  mysqli_query($conn, $pr_query);
    $total_record = mysqli_num_rows($pr_result);
    
    $total_page = ceil($total_record/$num_per_page);
    
    if($page>1)
    {
     $prev = "<a href='affs.php?page=".($page-1)."' class='block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>
     <span class='sr-only'>Previous</span>
                    <svg class='w-5 h-5' aria-hidden='true' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z' clip-rule='evenodd'></path></svg></a>";   
    }
    for($i=1;$i<$total_page;$i++)
    {
        $page = "<a href='affs.php?page=".$i."' class='py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>$i</a>";
    }
    if($i>$page)
    {
     $next = "<a href='affs.php?page=".($page+1)."' class='block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>
     <span class='sr-only'>Next</span>
                    <svg class='w-5 h-5' aria-hidden='true' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z' clip-rule='evenodd'></path></svg></a>";   
    }
    
    ?>
    <nav class="flex justify-between items-center pt-4" aria-label="Table navigation">
        &nbsp;
        <ul class="inline-flex items-center -space-x-px">
            <li>
                <?php echo $prev; ?>
            </li>
            <li>
                <?php echo $page; ?>
            </li>
            <li>
                <?php echo $next; ?>
            </li>
        </ul>
    </nav>
</div>
</div>
</div>
</div>
</div>
</a>

</center>
</div>
</div>
<br>

<script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
<script src="./Assets/dark.js"></script>
<script src="./Assets/animate.js"></script>


</body>
</html>
<?php } ?>