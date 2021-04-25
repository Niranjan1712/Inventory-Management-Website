<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: assets/pages/operations.php");
  exit;
}
 
// Include config file
require_once "assets/pages/config.php";
 
// Define variables and initialize with empty values
$username = $password = $first_name = $last_name = "";
$unique_id = $hashed_password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT admin_id, username, first_name, last_name, password FROM admininfo WHERE username = ?";
        // $sql = "SELECT id, class, username, first_name, last_name, roll_number, fees, term, password FROM students WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $unique_id, $username, $first_name, $last_name, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["admin_id"] = $unique_id;
                            $_SESSION["username"] = $username;
                            $_SESSION["first_name"] = $first_name;
                            $_SESSION["last_name"] = $last_name;
                                                       
                            // Redirect user to welcome page
                            header("location: assets/pages/operations");
                        } else{
                            // Display an error message if password is not valid
                            $password_err ="<p class='alert text-center'>The password you entered was not valid.</p>";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "<p class='alert text-center'>No account found with that username.</p>";
                }
            } else{
                echo "<p class='alert text-center'>Oops! Something went wrong. Please try again later.</p>";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon -->
    <link rel="icon" type="image/png" href="assets/images/cropllet-favicon.png">
    <!-- tailwind css -->
    <!-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

    <link href="assets/css/tailwind.min.css" rel="stylesheet">

    <!-- stylesheet -->
    <link rel="stylesheet" href="../css/courses.css">

    <title>cropllet tool - Home</title>
</head>
<body>
   <!-- navbar start -->
   <section class="navbar">
    <header class="text-gray-700 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
          <a href="index" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img style="width:50px;" src="assets/images/cropllet_logo.png" alt="Logo">
            <span class="ml-3 text-xl">cropllet tool</span>
          </a>
          <!-- <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center nav-a">
            <a href="../../index.html" class="mr-5 hover:text-gray-900">Home</a>
            <a href="courses.html" class="mr-5 hover:text-gray-900">Courses</a>
            <a href="../../index.html#contact" class="mr-5 hover:text-gray-900">Contact</a>
            <a href="#" class="mr-5 hover:text-gray-900">Login</a>
          </nav> -->
         
        </div>
        <hr>
      </header>
   </section>
   <!-- navbar end -->

  <!-- login start -->
  <section class="text-gray-700 body-font">
    <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
      <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
        <h1 class="title-font font-medium text-3xl text-gray-900">Login with your username and password to access the content</h1>
        <p class="leading-relaxed mt-4">If you are new to this page click on sign up and create your username and password also you need to provide the registration code to do so</p>
      </div>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" data-toggle="validator" class="lg:w-2/6 md:w-1/2 bg-gray-200 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
        <h2 class="text-gray-900 text-lg font-medium text-center title-font mb-5">Login</h2>
        
        <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $username_err; ?></p>

        <input class="bg-white rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2 mb-4" placeholder="Username" name="username" data-error="Name is required." required="required" type="text">
        
        <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $password_err; ?></p>

        <input class="bg-white rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2 mb-4" placeholder="password" name="password" type="password" data-error="Password is required." required="required">

        <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Login</button>
        <p class="text-xs text-gray-500 mt-3">Don't have an account ? <a class="text-blue-500" href="assets/pages/admin/admin-signup">Sign up now</a>.
        </p>
        </form>
      <!-- </div> -->
    </div>
  </section>
  <!-- login end -->

   <!-- footer start -->
   <footer class="text-gray-500 bg-gray-900 body-font mt-20 bottom-0 left-0 right-0">
    <div class="container px-2 py-4 mx-auto flex items-center sm:flex-row flex-col">
      <a href="index" class="flex title-font font-medium items-center md:justify-start justify-center text-white">
        
        <span class="ml-3 text-xl">cropllet tool</span>
      </a>
      <p class="text-sm text-gray-600 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-800 sm:py-2 sm:mt-0 mt-4">Copyright © 2021 cropllet tool
      </p>
      <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
        <a class="text-gray-600">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-600">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-600">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-600">
          <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
            <circle cx="4" cy="4" r="2" stroke="none"></circle>
          </svg>
        </a>
      </span>
    </div>
  </footer>
   <!-- footer end -->
   </body>
   </html>