<?php 
$product_id = $_GET['product_id'];
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../index");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon -->
    <link rel="icon" type="image/png" href="../images/cropllet-favicon.png">
    <!-- tailwind css -->
    <!-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

    <link href="../css/tailwind.min.css" rel="stylesheet">

    <!-- stylesheet -->
    <link rel="stylesheet" href="../css/courses.css">

    <title>cropllet tool - Product Details</title>
</head>
<body>
   <!-- navbar start -->
   <section class="navbar">
    <header class="text-gray-700 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
          <a href="../../index" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img style="width:50px;" src="../images/cropllet_logo.png" alt="Logo">
            <span class="ml-3 text-xl">cropllet tool</span>
          </a>
          <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center nav-a">
            <!-- <a href="../../index.html" class="mr-5 hover:text-gray-900">Home</a>
            <a href="courses.html" class="mr-5 hover:text-gray-900">Courses</a>
            <a href="../../index.html#contact" class="mr-5 hover:text-gray-900">Contact</a> -->
            <a href="logout" class="mr-5 hover:text-gray-900">Logout</a>
          </nav>
         
        </div>
        <hr>
      </header>
   </section>
   <!-- navbar end -->
      <!-- student details start-->
      <section class="text-gray-700 body-font">
  <div class="container px-5 py-10 mx-auto">
    <div class="flex flex-wrap -m-4 text-center">
      <div class="p-4 sm:w-1/4 w-1/2">
        <p class="title-font font-medium  text-gray-900">First Name: <span class=" text-sm  text-gray-600"><?php echo htmlspecialchars($_SESSION["first_name"]); ?></span> </p>
        <!-- <p class="leading-relaxed">Users</p> -->
      </div>
      <div class="p-4 sm:w-1/4 w-1/2">
        <h2 class="title-font font-medium  text-gray-900">Last Name: <span class=" text-sm  text-gray-600"><?php echo htmlspecialchars($_SESSION["last_name"]); ?></span></h2>
        <!-- <p class="leading-relaxed">Subscribes</p> -->
      </div>
      <div class="p-4 sm:w-1/4 w-1/2">
        <h2 class="title-font font-medium  text-gray-900">Username: <span class=" text-sm  text-gray-600"><?php echo htmlspecialchars($_SESSION["username"]); ?></span></h2>
        <!-- <p class="leading-relaxed">Downloads</p> -->
      </div> 
      <div class="p-4 sm:w-1/4 w-1/2">
        <h2 class="title-font font-medium  text-gray-900">Unique Id: <span class=" text-sm  text-gray-600"><?php echo htmlspecialchars($_SESSION["admin_id"]); ?></span></h2>
        <!-- <p class="leading-relaxed">Downloads</p> -->
      </div> 
    </div>
  </div>
</section>
<hr>
   <!-- student details end -->

   <?php
    // Include config file
require_once "config.php";

// Define variables and initialize with empty values
$first_name = $last_name = $roll_number = $class = $fees = $update_fees = "";
$first_name_err = $last_name_err = $roll_number_err = $class_err = $fees_err = $update_fees_err = "";

 

$sql = "SELECT * FROM products where product_id = '$product_id'  order by product_id desc"; 
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc()

?>

 <!-- student list start-->
<section class="text-gray-700 body-font">
  <div class="container-fluid px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Product Details</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">These are the details of the product based on the product ID</p>
      
    </div>
    
    <div class=" w-full mx-auto overflow-auto">
    
      <table class="table-auto w-full text-left whitespace-no-wrap">
     <a href="upload/<?php echo $row["product_id"]; ?>.png" target="blank"><img style = "width: 200px; height: 150px; margin-bottom:10px;" class="mx-auto" src="upload/<?php echo $row["product_id"]; ?>.png" alt=""></a>
        <thead>
        
          <tr>
            <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product ID</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Name</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Quantity</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Price</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Total</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Box</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Category</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Listing Status</th>
            
          </tr>
         
        </thead>
        <tbody> 
        
    <!-- <form action="" method="post" data-toggle="validator"  class="lg:w-1/2 md:w-2/3 mx-auto"> -->
          
          <tr>
            
            <td class="border-t-2 border-gray-200">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $last_name_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_id"]; ?>" name="last_name" type="text">
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($roll_number_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $roll_number_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_name"]; ?>" name="roll_number" type="text">
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($class_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $class_err; ?></p>
            <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_quantity"]; ?>" name="class" type="text">
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($fees_err)) ? 'has-error' : ''; ?>"></p>
            <p class="text-xs text-gray-500 mt-3"><?php echo $class_err; ?></p>
            <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_price"]; ?>" name="class" type="text">
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($fees_err)) ? 'has-error' : ''; ?>"></p>
            
        <p class="text-xs text-gray-500 mt-3"><?php echo $fees_err; ?></p>
            <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_total"]; ?>" name="fees" type="text">
            </td>

            <td class="border-t-2 border-gray-200 ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $first_name_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base px-4 py-2 mb-4" value="<?php echo $row["product_box"]; ?>" name="first_name" type="text">
            </td>   
            <td class="border-t-2 border-gray-200">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $last_name_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_category"]; ?>" name="last_name" type="text">
            </td> 
            <td class="border-t-2 border-gray-200">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $last_name_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["list_status"]; ?>" name="last_name" type="text">
            </td>        
          
          
        
            
        <!-- </form> -->

            
          </tr>
          <tr>
            <!-- <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Image</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product ID</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Name</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Quantity</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Box</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Status</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Category</th> -->
            
            
            <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Listed Date</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Listed By</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Upload Status</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Upload Date</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Uploaded By</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Recieved Status</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Recieved Date</th>           
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Recieved By</th>
            
          </tr>
          <tr>
            
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $last_name_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["listed_date"]; ?>" name="last_name" type="text">
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($roll_number_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $roll_number_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["listed_by"]; ?>" name="roll_number" type="text">
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($class_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $class_err; ?></p>
            <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["upload_status"]; ?>" name="class" type="text">
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($fees_err)) ? 'has-error' : ''; ?>"></p>
            <p class="text-xs text-gray-500 mt-3"><?php echo $class_err; ?></p>
            <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["upload_date"]; ?>" name="class" type="text">
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($fees_err)) ? 'has-error' : ''; ?>"></p>
            
        <p class="text-xs text-gray-500 mt-3"><?php echo $fees_err; ?></p>
            <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["uploaded_by"]; ?>" name="fees" type="text">
            </td>

            <td class="border-t-2 border-gray-200 ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $first_name_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base px-4 py-2 mb-4" value="<?php echo $row["recieved_status"]; ?>" name="first_name" type="text">
            </td> 
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $last_name_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["recieved_date"]; ?>" name="last_name" type="text">
            </td>       
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $last_name_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["recieved_by"]; ?>" name="last_name" type="text">
            </td>    
          
          
        
            
        <!-- </form> -->

            
          </tr>
          
          <?php

} else { echo "0 results"; }
$link->close();
?>
        </tbody>
      </table>
    </div>
    
  </div>
</section>
   <!-- student list end -->

   <!-- footer start -->
   <footer class="text-gray-500 bg-gray-900 body-font mt-20 bottom-0 left-0 right-0">
    <div class="container px-2 py-4 mx-auto flex items-center sm:flex-row flex-col">
      <a href="../../index" class="flex title-font font-medium items-center md:justify-start justify-center text-white">
        <!-- <img class="rounded-full" src="../images/school-logo50X43.jpg" alt=""> -->
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