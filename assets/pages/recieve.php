<?php 
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

    <title>cropllet tool - Recieve Product</title>
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

 <!-- rercieve option start -->
 <section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto flex flex-wrap">
    <div class="lg:w-2/3 mx-auto">
      
      <div class="flex flex-wrap -mx-2">
        <div class="px-2 w-1/2">
          <div class="flex flex-wrap w-full bg-gray-400 sm:py-24 py-16 sm:px-10 px-6 relative">
            <div class="text-center relative z-10 w-full">
              <h2 class="text-xl text-gray-900 font-medium title-font mb-2">Recieve Individual Product</h2>
              <p class="leading-relaxed">Click on recieve now to receive individual product.</p>
              <a style="width:50%;" href="product_recieved" class=" flex mx-auto text-center text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">Recieve Now</a>
            </div>
          </div>
        </div>
        <div class="px-2 w-1/2">
          <div class="flex flex-wrap w-full bg-gray-400 sm:py-24 py-16 sm:px-10 px-6 relative">
            <div class="text-center relative z-10 w-full">
              <h2 class="text-xl text-gray-900 font-medium title-font mb-2">Recieve Packed Box</h2>
              <p class="leading-relaxed">Click on recieve now to recieve packed box which has products inide.</p>
              <a style="width:50%;" href="recieve_box" class=" flex mx-auto text-center text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">Recieve Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 <!-- rercieve option end -->


   <!-- footer start -->
   <footer class="text-gray-500 bg-gray-900 body-font mt-20 bottom-0 left-0 right-0">
    <div class="container px-2 py-4 mx-auto flex items-center sm:flex-row flex-col">
      <a href="../../index" class="flex title-font font-medium items-center md:justify-start justify-center text-white">
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