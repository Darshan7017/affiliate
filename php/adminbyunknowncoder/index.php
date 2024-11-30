<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('session.php');
confirm_logged_in();
include('../db.php');

// Initialize $date variable if it's not set

if (logged_in()) {
  // conversions
  $sql = "SELECT * FROM conversions WHERE `lead`=1 AND date='$date'";
  $query = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($query);

  // clicks
  $sql1 = "SELECT * FROM conversions WHERE date='$date'";
  $query1 = mysqli_query($conn, $sql1);
  $rows1 = mysqli_num_rows($query1);

  // Calculate Conversion Rate (CR)
  if ($rows1 > 0) {
    $Cr = ($rows / $rows1) * 100;
    $Cr = sprintf('%0.2f', round($Cr, 2));
  } else {
    $Cr = 0;
  }
}
?>
<!doctype html>
<html>
<head>
  <meta name="apple-mobile-web-app-status-bar-style" content="#FFB700">
  <meta name="description" content="Onx is an affiliate marketing portal. Here you will get many offers with high payouts 100% Indian, 100% Trusted">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.min.css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link rel="stylesheet" href="./Assets/loader.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
<title>Prime Affiliate Media</title>
<link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
document.documentElement.classList.add('dark');
} else {
document.documentElement.classList.remove('dark');
}
</script>
</head>
<body class="dark:bg-gray-700" style="font-family: 'Poppins', sans-serif;">
<?php include "nav.php"; ?>
<div class="p-2">
<center>
<br>
<div class="p-3 border border-gray-500 dark:border-white relative overflow-x-auto rounded-lg shadow-lg sm:rounded-lg">
<div class="bg-gradient-to-r from-purple-300 via-purple-400 to-purple-600 rounded-lg dark:border-white border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 bg-gradient-to-b border-b border-gray-600 rounded-lg shadow-xl p-3">

<div class="flex flex-row items-center">
<div class="flex-shrink pr-4">
<div class="rounded-full dark:text-white text-4xl">
<i class="far fa-bolt"></i>
</div>
</div>
<div class="flex-1 text md:text-center">
<h3 class="font-bold text-2xl text-gray-900 dark:text-white"><?php echo $rows; ?></h3>
<h5 class="font-bold text-gray-900 text-lg dark:text-white">Today Conversions</h5>
</div>
</div>
</div>

<br>
<div class="bg-gradient-to-r from-red-300 via-red-400 to-red-500 rounded-lg dark:border-white border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 bg-gradient-to-b border-b border-gray-600 rounded-lg shadow-xl p-3">
<div class="flex flex-row items-center">
<div class="flex-shrink pr-4">
<div class="rounded-full dark:text-white text-4xl">
<i class="far fa-bullseye-pointer"></i>
</div>
</div>
<div class="flex-1 text md:text-center">
<h3 class="font-bold text-2xl text-gray-900 dark:text-white"><?php echo $rows1; ?></h3>
<h5 class="font-bold text-gray-900 text-lg dark:text-white">Today Clicks</h5>
</div>
</div>
</div>

<br>
<div class="bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 rounded-lg dark:border-white border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 bg-gradient-to-b border-b border-gray-600 rounded-lg shadow-xl p-3">
<div class="flex flex-row items-center">
<div class="flex-shrink pr-4">
<div class="rounded-full dark:text-white text-4xl">
<i class="far fa-chart-line"></i>
</div>
</div>
<div class="flex-1 text md:text-center">
<h3 class="font-bold text-2xl text-gray-900 dark:text-white"><?php echo $Cr; ?>%</h3>
<h5 class="font-bold text-lg text-gray-900 dark:text-white">Conversion Rate</h5>
</div>
</div>
</div>
</center>
</div>

<!-- Table for offers -->
<div class="p-2">
<div class="border border-gray-200 relative overflow-x-auto rounded shadow-md sm:rounded-lg">
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="myTable">
<thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
<tr>
<th scope="col" class="px-6 py-3">Offer</th>
<th scope="col" class="px-6 py-3">Cr</th>
<th scope="col" class="px-6 py-3">Conversions</th>
<th scope="col" class="px-6 py-3">Clicks</th>
<th scope="col" class="px-6 py-3">ID</th>
<th scope="col" class="px-6 py-3">Report</th>
<th scope="col" class="px-6 py-3">Aff Report</th>
<th scope="col" class="px-6 py-3">Edit</th>
<th scope="col" class="px-6 py-3">Delete</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM offer";
$resultset = mysqli_query($conn, $sql);
while ($record = mysqli_fetch_assoc($resultset)) {
$offerid = $record['id'];
$sql = "SELECT * FROM conversions WHERE offerid=$offerid AND `lead`=1";
$query = mysqli_query($conn, $sql);
$rows0 = mysqli_num_rows($query);

$sql1 = "SELECT * FROM conversions WHERE offerid=$offerid";
$query1 = mysqli_query($conn, $sql1);
$rows1 = mysqli_num_rows($query1);

$cr = $rows1 > 0 ? ($rows0 / $rows1) * 100 : 0;
?>
<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
<th scope="row" class="px-6 py-4 font-medium flex items-center text-gray-900 dark:text-white whitespace-nowrap">
<img src="https://fastback.in/affiliate/static/media/success.e39fa5f54a849d8fc1a5.png" style="width:35px; height:35px; border-radius:50%; border:1px solid green; margin-right:7px;">
<?php echo $record['name']; ?>
</th>
<td class="px-6 py-4"><?php echo sprintf('%0.2f', $cr); ?>%</td>
<td class="px-6 py-4"><?php echo $rows0; ?></td>
<td class="px-6 py-4"><?php echo $rows1; ?></td>
<td class="px-6 py-4"><?php echo $record['id']; ?></td>
<td class="px-6 py-4">
<a href="report.php?id=<?php echo $record['id']; ?>" class="text-blue-600 dark:text-blue-500 hover:underline">View Report</a>
</td>
<td class="px-6 py-4">
<a href="aff-report.php?id=<?php echo $record['id']; ?>" class="text-blue-600 dark:text-blue-500 hover:underline">Aff Report</a>
</td>
<td class="px-6 py-4">
<a href="edit.php?id=<?php echo $record['id']; ?>" class="text-green-600 dark:text-green-500 hover:underline">Edit</a>
</td>
<td class="px-6 py-4">
<a href="delete.php?id=<?php echo $record['id']; ?>" onclick="return confirm('Are you sure you want to delete this offer?');" class="text-red-600 dark:text-red-500 hover:underline">Delete</a>
</td>
</tr>
<?php
} ?>
</tbody>
</table>
</div>
</div>
</div>

<script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
// Preloader hide logic
const preloader = document.getElementById('preloader');
if (preloader) {
preloader.style.display = 'none';
}
});
</script>

</body>
</html>