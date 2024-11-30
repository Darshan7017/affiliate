<?php
 require('session.php');
confirm_logged_in(); 
include('../db.php');

if(isset($_POST['submit'])){
    $offerid=$_POST['offerid'];
    $target_dir = "../bg/";
    $target_file = $target_dir . basename($_FILES["bg"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["bg"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        $uploadOk = 0;
      }
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
        if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file($_FILES["bg"]["tmp_name"], $target_file)) {
        echo "<script>alert(The file ". htmlspecialchars( basename( $_FILES["bg"]["name"])). " has been uploaded.)</script>";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    $imgname=$_FILES["bg"]["name"];
    
       $sql="UPDATE offer SET bg='$imgname' where id=$offerid";
    
    $res=mysqli_query($conn,$sql);
    
    if($res){
      
                echo "<script>alert('Successfully Updated')</script>";
                          echo "<meta http-equiv = 'refresh' content = '0; url = ' />";
    
    }else{
                  echo "<script>alert('Same Named Image Already Exists ! ')</script>";
                          echo "<meta http-equiv = 'refresh' content = '0; url = ' />";
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
<title>Onx-Cutomise</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="./Assets/loader.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
   <script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
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
<div class="p-2">
<br>
<div class="p-3 border border-gray-500 dark:border-white relative overflow-x-auto rounded-lg shadow-lg sm:rounded-lg">
<form class="space-y-6" action="" method="post" enctype="multipart/form-data">
<div>
    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Offer</label>
<select id="countries" name="offerid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
    <option selected>Select Offer</option>
  <?php 
$sql = "SELECT id,name, category, model,event,payout FROM offer";
$resultset = mysqli_query($conn, $sql);
                while( $record = mysqli_fetch_assoc($resultset) ) {
                  $offerid=$record['id'];
                  $offername=$record['name'];
                  $image=$record['bg'];
  		
                  ?>
                  <option value="<?php echo $offerid ?>">  <?php echo $offername ?></option>

  <?php } ?>
</select>
<br>
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="">Background Image</label>
            <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="bg" onchange="previewFile(this);" required>
            <br>
            <img id="previewImg" src="../bg/default.jpg" alt="default" style="width:100px;height:auto;">
          <br><button type="submit" name="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    
        </form>
         </div>
        <footer class="p-4 mt-3 bg-white rounded-lg shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800">
        <span class="text-sm text-red-500 sm:text-center dark:text-gray-400"><a href="#" class="hover:underline">Donot Upload Same Images More times . Else System Will Reject</a>
        </span>
        </footer>
        <script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
<script src="./Assets/dark.js"></script>
<script src="./Assets/animate.js"></script>
         </body>
         </html>