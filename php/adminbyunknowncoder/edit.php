<?php
 require('session.php');
confirm_logged_in(); 
include('../db.php');
if (logged_in()) {
    $id=$_GET['id'];
$sql = "SELECT * FROM offer where id=$id";
          $resultset = mysqli_query($conn, $sql);
          $record = mysqli_fetch_assoc($resultset);
        $name=$record['name'];
        $model=$record['model'];
        $link=$record['link'];
        $category=$record['category'];
        $payout=$record['payout'];
       
       
 if(isset($_POST['submit'])){
            $name=$_POST['name'];
            $model=$_POST['model'];
            $link=$_POST['link'];
            $category=$_POST['category'];
            $payout=$_POST['payout'];
            
            
               $sql="UPDATE offer SET name='$name',model='$model',link='$link',category='$category' where id=$id";
            
            $res=mysqli_query($conn,$sql);
            
            if($res){
              
                        echo "<script>alert('Successfully Updated')</script>";
                                  echo "<meta http-equiv = 'refresh' content = '0; url = index.php' />";
            
            }else{
                          echo "<script>alert('Something went wrong ')</script>";
                                  echo "<meta http-equiv = 'refresh' content = '0; url = index.php' />";
            }
            
            }
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
   <script src="https://cdn.tailwindcss.com"></script>


</head>
<body class="dark:bg-gray-700">
<?php include("nav.php"); ?>

<center>
<div class="mt-5 p-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700 ">
<form class="space-y-6 text-left dark:text-white m-1" action="" method="post">
<h3 class="text-xl font-medium text-gray-900 dark:text-white">Edit Offer</h3>
<div>
<label for="">Name</label>
<input type="text" name="name" value="<?php echo $name; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Postback Url" required="" value="<?php echo $url; ?>">
<label for="">Model</label>
<input type="text" name="model" value="<?php echo $model; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Postback Url" required="" value="<?php echo $url; ?>">
<label for="">Link</label>
<input type="text" name="link" value="<?php echo $link; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Postback Url" required="" value="<?php echo $url; ?>">
<label for="">Category</label>
<input type="text" name="category" value="<?php echo $category; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Postback Url" required="" value="<?php echo $url; ?>">
<label for="">Payout</label>
<input type="text" name="payout" value="<?php echo $payout; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Postback Url" required="" value="<?php echo $url; ?>">

</div>

<button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="submit">Update</button>

</form>

</center>

<script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }

    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {

    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

    // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
    
});

</script>

</body>
</html>
<?php } ?>