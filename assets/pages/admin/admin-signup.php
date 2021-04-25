<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $first_name = $last_name = $password = $confirm_password = $unique_id = $reg_code = "";
$username_err = $first_name_err = $last_name_err = $password_err = $confirm_password_err = $unique_id_err = $reg_code__err = "";
$reg_code_new = 1234567890;
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT admin_id FROM admininfo WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) > 0){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }


            // Validate roll number
    
            // Validate username
    
        // // Prepare a select statement
        // $sql = "SELECT id FROM students WHERE email = ?";
        
        // if($stmt = mysqli_prepare($link, $sql)){
        //     // Bind variables to the prepared statement as parameters
        //     mysqli_stmt_bind_param($stmt, "s", $param_email);
            
        //     // Set parameters
        //     $param_email = trim($_POST["email"]);
            
        //     // Attempt to execute the prepared statement
        //     if(mysqli_stmt_execute($stmt)){
        //         /* store result */
        //         mysqli_stmt_store_result($stmt);
                
        //         if(mysqli_stmt_num_rows($stmt) > 0){
        //             $email_err = "This email is already taken.";
        //         } else{
        //             $email = trim($_POST["email"]);
        //         }
        //     } else{
        //         echo "Oops! Something went wrong. Please try again later.";
        //     }
        // }
   

            
        
    

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    

    //getting values
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    // $term = trim($_POST["term"]);
    // $fees = trim($_POST["fees"]);

    $unique_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 10);

    //first_name
    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter your First Name.";     
    }
    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter your Last Name.";     
    }
    
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate registration code
    if(empty(trim($_POST["reg_code"]))){
        $reg_code__err = "Please enter a Registration Code.";     
    } if(strlen(trim($_POST["reg_code"])) < 10){
        $reg_code_err = "Registration code must have atleast 10 characters.";
    }else{
        $reg_code = trim($_POST["reg_code"]);
        if($reg_code != $reg_code_new){
            $reg_code__err = "Wrong Registraion Code.";
        }
    }
    
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err) && empty($last_name_err) && empty($roll_number_err) && empty($class_err) && empty($reg_code__err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO admininfo (admin_id, username, password, first_name, last_name) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_unique_id, $param_username, $param_password, $param_first_name, $param_last_name);
            
            // Set parameters
            $param_username = $username;
            $param_unique_id = $unique_id;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            // $param_roll_number = $roll_number;
            // $param_class = $class;
            // $param_term = $term;
            // $param_fees = $fees;



            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                session_start();
                header("location: ../../../index");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <link rel="icon" type="image/png" href="../../images/cropllet-favicon.png">
    <!-- tailwind css -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- stylesheet -->
    <link rel="stylesheet" href="../css/courses.css">

    <title>cropllet tool - Admin signup</title>
</head>
<body>
   <!-- navbar start -->
   <section class="navbar">
    <header class="text-gray-700 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
          <a href="../../../index" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img style="width:50px;" src="../../images/cropllet_logo.png" alt="Logo">
            <span class="ml-3 text-xl">cropllet tool</span>
          </a>
          <!-- <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center nav-a">
            <a href="../../index.html" class="mr-5 hover:text-gray-900">Home</a>
            <a href="courses.html" class="mr-5 hover:text-gray-900">Courses</a>
            <a href="../../index.html#contact" class="mr-5 hover:text-gray-900">Contact</a>
            <a href="login.php" class="mr-5 hover:text-gray-900">Login</a>
          </nav> -->
         
        </div>
        <hr>
      </header>
   </section>
   <!-- navbar end -->

  <!-- Sign up start -->
  <section class="text-gray-700 body-font relative">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Sign Up</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Enetr your details in the form to signup</p>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" data-toggle="validator"  class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-1/2">

        <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $first_name_err; ?></p>

          <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="First Name" name="first_name" data-error="First name is required." required="required" type="text">
        </div>
        <div class="p-2 w-1/2">

        <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $last_name_err; ?></p>

          <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Last Name" data-error="Last name is required." required="required" name="last_name" type="text">
        </div>
        <div class="p-2 w-1/2">

        <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $username_err; ?></p>

          <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Username" data-error="Username is required." required="required" name="username" type="text">
        </div>
        
        <div class="p-2 w-1/2">

        <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($reg_code__err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $reg_code__err; ?></p>

          <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Registration Code" name="reg_code" data-error="Registration code is required." required="required" type="text">
        </div>
        <div class="p-2 w-1/2">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>"></p>
            <p class="text-xs text-gray-500 mt-3"><?php echo $password_err; ?></p>

            <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Password" data-error="Password is required." required="required" name="password" type="password">
        </div>
        <div class="p-2 w-1/2">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>"></p>
            <p class="text-xs text-gray-500 mt-3"><?php echo $confirm_password_err; ?></p>

            <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Confirm Password" data-error="Confirm Password is required." required="required" name="confirm_password" type="password">
        </div>
        <div class="p-2 w-full">
          <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Sign Up</button>
        </div>
        
      </div>
</form>
  </div>
</section>
  <!-- Sign up end -->

   <!-- footer start -->
   <footer class="text-gray-500 bg-gray-900 body-font fixed bottom-0 left-0 right-0">
    <div class="container px-2 py-4 mx-auto flex items-center sm:flex-row flex-col">
      <a href="../../../index" class="flex title-font font-medium items-center md:justify-start justify-center text-white">
        <span class="ml-3 text-xl">cropllet tool</span>
      </a>
      <p class="text-sm text-gray-600 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-800 sm:py-2 sm:mt-0 mt-4">Copyright © 2020 cropllet tool
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