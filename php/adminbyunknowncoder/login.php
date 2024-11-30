<?php
include('../db.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  </head>
  <body>
      <nav class="bg-white shadow-md border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
  <div class="container flex flex-wrap justify-between items-center mx-auto">
    <a href="#" class="flex items-center">
        <img src="https://fastback.in/logo.png" class="mr-3 h-4 sm:h-4" alt="Fastback" />
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Affiliate</span>
    </a>
    <div class="flex md:order-2">
    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
</button>
    </div>
    
    <div class="hidden w-full md:block md:w-auto rounded" id="mobile-menu">
      <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
      </ul>
    </div>
  </div>
</nav>
<div class="p-2">
 <!--Coded By Immortal182--->
<br>

<div class="p-3 border border-gray-500 dark:border-white relative overflow-x-auto rounded-lg shadow-lg sm:rounded-lg">
<h4 class="text-xl font-bold text-gray-900 dark:text-white text-center mt-4 mb-4">Fastback Admin Login</h4>
	<div class="relative">
  <form class="mt-8 space-y-6" method="post" action="">

    <div class="control has-icons-left">
                <input type="email" placeholder="Admin Email / Phone" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" name="email" required>
    </div>
     <div class="control has-icons-left">
                <input type="password" placeholder="*******" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" name="password" required>
    </div>

<br>
<div class="field">
              <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" name="btnlogin">
                Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php

if (isset($_POST['btnlogin'])) {

 session_start();
 
  $em = trim($_POST['email']);
  $pass = trim($_POST['password']);

  $email = mysqli_real_escape_string($conn, $em); 
  $upass = mysqli_real_escape_string($conn, $pass); 

  if ($upass == ''){
     ?>    <script type="text/javascript">
                alert("Password is missing!");
                window.location = "login.php";
                </script>
        <?php
  } else {
    
      if ($email == "darshan701@hotmail.com" && $upass == "Darshan@117") {
          require('session.php');
          $_SESSION['email']  = $email;

          ?>    <script type="text/javascript">
                      window.location = "index.php";
                  </script>
          <?php      
      } else {
          ?>    <script type="text/javascript">
                alert("Incorrect Credentials");
                window.location = "login.php";
                </script>
          <?php
      }
  }
}
?>
  </body>
</html>
