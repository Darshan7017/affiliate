<?php
 require('session.php');
confirm_logged_in(); 
include('../db.php');
if (logged_in()) {
    $number = "SELECT * FROM approvals where status='pending'";
    $res12 = mysqli_query($conn,$number);
    $total_approval = mysqli_num_rows($res12);

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="UPDATE approvals SET status='approved' where id=$id";
            
        $res=mysqli_query($conn,$sql);
        
        if($res){
          
                    echo "<script>alert('Successfully Approved')</script>";
                              echo "<meta http-equiv = 'refresh' content = '0; url = approvals.php' />";
        
        }else{
                      echo "<script>alert('Something went wrong')</script>";
                              echo "<meta http-equiv = 'refresh' content = '0; url = approvals.php' />";
        }
    }
    if(isset($_GET['idall'])){

        $sql="UPDATE approvals SET status='approved'";
            
        $res=mysqli_query($conn,$sql);
        
        if($res){
          
                    echo "<script>alert('Successfully Approved All')</script>";
                              echo "<meta http-equiv = 'refresh' content = '0; url = approvals.php' />";
        
        }else{
                      echo "<script>alert('Something went wrong')</script>";
                              echo "<meta http-equiv = 'refresh' content = '0; url = approvals.php' />";
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
  <meta name="apple-mobile-web-app-status-bar-style" content="#FFB700">
  <meta name="description" content="Onx in an affiliate marketing portal. here you will get many offers with high payout 100% Indian 100% Trusted">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.min.css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="./Assets/loader.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
<title>Onx Camp- Offer</title>
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
   <script src="https://cdn.tailwindcss.com"></script>
   <script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
</head>
<body class="dark:bg-gray-700"style="font-family: 'Poppins', sans-serif;">
    <div id="preloader"></div>
<?php include("nav.php"); ?>

<div class="mt-4 ">
<div class="flex">

<h3 class="text-xl font-medium text-gray-900 dark:text-white m-5">Approval Requests</h3>


<a href="approvals.php?idall=<?php echo $record['id']; ?>" class="mt-5 text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Approve All<span class="inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded ml-2"><?php echo $total_approval; ?></span></a>


</div>
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
Aff ID
</th>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Offer ID
</th>
<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
Approve
</th>


</tr>
</thead>
<tbody>
             <?php 
           
             $sql = "SELECT * FROM approvals where status='pending'";
             $resultset = mysqli_query($conn, $sql);
                while( $record = mysqli_fetch_assoc($resultset) ) {

 
  		
                  ?>
<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
<td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
<?php echo $record['userid']; ?>
</td>
<td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
<?php echo $record['offerid']; ?>
</td>
<td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
<a href="approvals.php?id=<?php echo $record['id']; ?>" class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Approve</a>
</td>
</td>
</tr>

<?php } ?>
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

<script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
<script src="./Assets/dark.js"></script>
<script src="./Assets/animate.js"></script>

</body>
</html>
<?php } ?>