<?php 
// $product_id = $_GET['product_id'];
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

    <title>cropllet tool - Product Upload</title>
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



 
// Initialize the sessio
date_default_timezone_set('Asia/Kolkata');
$date = date('y-m-d H:i:s');

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  $product_id = trim($_POST["product_id"]);
  $upload_status = trim($_POST["upload_status"]);


  $sql = "SELECT upload_status FROM products WHERE product_id='$product_id'";
  $result = mysqli_query($link, $sql);
  if ($result !== false) {
  $row = mysqli_fetch_row($result);
  // echo $row[0];
  if($row[0] == $upload_status){
    $product_id_err = "Product ID already uploaded";
    echo "Product ID already uploaded";
  }
  else{
    $upload_status = trim($_POST["upload_status"]);
  }
  }


 
    
    // $product_name = trim($_POST["product_name"]);
    // $product_quantity = trim($_POST["product_quantity"]);
    // $product_price = trim($_POST["product_price"]);
    // $product_box = trim($_POST["product_box"]);
    // $product_category = trim($_POST["product_category"]);
    // $list_status = trim($_POST["list_status"]);
    // $listed_date = trim($_POST["listed_date"]);
    // $listed_by = trim($_POST["listed_by"]);
    // $upload_status = trim($_POST["upload_status"]);
    $upload_date = $date;
    $uploaded_by = $_SESSION["first_name"];
    // $recieved_status = trim($_POST["recieved_status"]);
    // $recieved_date = trim($_POST["recieved_date"]);
    // $recieved_by = trim($_POST["recieved_by"]);

    
// Check input errors before inserting in database
    if(empty($product_id_err) && empty($upload_status_err) && empty($upload_date_err) && empty($uploaded_by_err)){
      
      $sql = "UPDATE products SET upload_status = '$upload_status', upload_date = '$upload_date', uploaded_by = '$uploaded_by' WHERE product_id ='$product_id'";

if ($link->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $link->error;
}
    }
   
   // Close connection
  //  mysqli_close($link);
}
?>

   <?php
    // Include config file
require_once "config.php";

// Define variables and initialize with empty values
$first_name = $last_name = $roll_number = $class = $fees = $update_fees = "";
$first_name_err = $last_name_err = $roll_number_err = $class_err = $fees_err = $update_fees_err = "";


$product_id_err = $product_name_err = $product_quantity_err = $product_price_err = $product_total_err = $product_box_err = $product_category_err = $list_status_err = "";
$listed_date_err = $listed_by_err = $upload_status_err = $uploaded_by_err = $upload_date_err = $recieved_status_err = $recieved_date_err = $recieved_by_err = "";



// $sql = "SELECT * FROM products where product_id = '$product_id'  order by product_id desc"; 
//     $result = $link->query($sql);
//     if ($result->num_rows > 0) {
//     // output data of each row
//     $row = $result->fetch_assoc()

?>

 <!-- student list start-->
<section class="text-gray-700 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Product Uplaod</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">You can change the product status to uploaded which means uploaded on vehicle and ready to move to destination</p>
      
    </div>
    
    <div class=" w-full mx-auto overflow-auto">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
        
          <tr>
            <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-center">Product ID</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-center">Upload Status</th>
            
            
          </tr>
         
        </thead>
        <tbody> 
        
    
          
          <tr>
            
            <td class="border-t-2 border-gray-200">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($product_id_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $product_id_err; ?></p>
              <input style = "width: 100%;" class="text-center bg-white rounded focus:outline-none  focus:border-indigo-500 text-base  py-2 mb-4" name="product_id" autofocus="autofocus" placeholder="Click here to enter Product ID" type="text" required>
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($upload_status_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $upload_status_err; ?></p>
              <input readonly style = "width: 100%;" class=" text-center bg-white rounded focus:outline-none  focus:border-indigo-500 text-base  py-2 mb-4"  name="upload_status" value="Uploaded" type="text">
            </td>    
          
          </tr>
          
        </tbody>
      </table>
      <div class="mt-20 text-center mx-auto">
	                <button type="submit" class="text-white bg-green-500 border-0 py-2 px-6 rounded">Submit</button>
	        </div>
      </form>
    </div>
    
  </div>
</section>
   <!-- student list end -->
   <?php
   require_once "config.php";
   $sql = "SELECT count(*) FROM products where upload_status = 'Uploaded'";
  $result = mysqli_query($link, $sql);
  if ($result !== false) {
  $row = mysqli_fetch_row($result);
  //  $total_product =  $row[0];
  }
  ?>
   <!-- uploaded products start -->
<section class="text-gray-700 body-font">
  <div class="container-fluid px-6 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Uploaded products</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">This are the products that are recently uploaded on vehicle to move to destination</p>
    </div>
    <div class=" w-full mx-auto overflow-auto">
    <p style="padding: 10px;background: #5DADE2; color: white;" class= "text-center">Total Number of Products Uploaded: <?php echo $row[0]; ?></p>
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Image</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product ID</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Name</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Quantity</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Box</th>            
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Category</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Status</th>
            <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Uploaded Date</th>                    
          </tr>
        </thead>
        <tbody> 
        <?php
    // Include config file
require_once "config.php";

// Define variables and initialize with empty values
$first_name = $last_name = $roll_number = $class = $fees = $update_fees = "";
$first_name_err = $last_name_err = $roll_number_err = $class_err = $fees_err = $update_fees_err = "";

$sql = "SELECT * FROM products where upload_status = 'Uploaded' order by product_id desc"; 
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

?>
    <!-- <form action="" method="post" data-toggle="validator"  class="lg:w-1/2 md:w-2/3 mx-auto"> -->
          
          <tr>

            <td class="border-t-2 border-gray-200 ">
             <img style = "width: 120px; height: 80px " src="upload/<?php echo $row["product_id"]; ?>.png" alt="">
            </td>

            <td class="border-t-2 border-gray-200  ">
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_id"]; ?>" name="last_name" type="text">
            </td>

            <td class="border-t-2 border-gray-200  ">
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_name"]; ?>" name="roll_number" type="text">
            </td>

            <td class="border-t-2 border-gray-200  ">
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_quantity"]; ?>" name="class" type="text">
            </td>

            <td class="border-t-2 border-gray-200  ">
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_box"]; ?>" name="class" type="text">
            </td>

            <td class="border-t-2 border-gray-200 ">
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base px-4 py-2 mb-4" value="<?php echo $row["product_category"]; ?>" name="first_name" type="text">
            </td> 

            <td class="border-t-2 border-gray-200  ">
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["upload_status"]; ?>" name="fees" type="text">
            </td>                      
        
            <td class="border-t-2 border-gray-200 ">
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base px-4 py-2 mb-4" value="<?php echo $row["upload_date"]; ?>" name="upload_date" type="text">
            </td>  
        <!-- </form> -->            
          </tr>
          
          <?php
}
echo "</table>";
} else { echo "0 results"; }
$link->close();
?>
        </tbody>
      </table>
    </div>
    
  </div>
</section>

   <!-- uploaded products end -->


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