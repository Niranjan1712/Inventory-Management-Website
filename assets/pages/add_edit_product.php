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

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/webcam.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->

    <style>
    body{
      zoom: 0.9;
    }
    </style>
    

    <title>cropllet tool - Add/Edit Products</title>
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
$product_id_err = $product_name_err = $product_price_err = $product_total_err = $product_total_err = $product_box_err = $product_quantity_err= "";
$product_box_err = $product_category_err = $list_status_err = "";
?> 


   

 <!-- student list start-->
<section class="text-gray-700 body-font">
  <div class="container-fluid px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Add products to database</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">You can add new products to database along with their photo</p>
      
    </div>
    
    <div class=" w-full mx-auto overflow-auto">
    
      <table class="table-auto w-full text-left whitespace-no-wrap">

        <!-- capture image start-->
<section>
	<div class="container mx-auto ">
	    
	   <form method="POST" action="add_product">
	        <div class="flex space-x-10">
	            <div style= "border:2px solid black;" class="flex-1">
	                <div class="mx-auto" id="my_camera"></div>
	                <input style="margin:0px 250px 0px 250px;" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded" type=button value="Take Snapshot" onClick="take_snapshot()">
	                <input type="hidden" name="image" class="image-tag">
                </div>
	            <div style= "border:2px solid black;" class="flex-1">
	                <div id="results">Your captured image will appear here...</div>
	            </div>
            </div>
            <table style="width:100%; margin-top: 20px; background: #BFC9CA; height: 160px;">
                <tr>
                    <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product ID</th>
                    <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Name</th>
                    <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Quantity</th>
                    <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Price</th>
                    <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Total</th>
                    <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Box</th>
                    <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Category</th>
                    <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Listing Status</th>
                </tr>
                <tr>
                <td class="border-t-2 border-gray-200 px-3">
                    <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($product_id_err)) ? 'has-error' : ''; ?>"></p>
                    <p class="text-xs text-gray-500 mt-3"><?php echo $product_id_err; ?></p>
                    <input class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4 text-center" name="product_id" type="text" required>
                </td>
                <td class="border-t-2 border-gray-200 px-3">
                    <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($product_name_err)) ? 'has-error' : ''; ?>"></p>
                    <p class="text-xs text-gray-500 mt-3"><?php echo $product_name_err; ?></p>
                    <input class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4 text-center" name="product_name" type="text" required>
                </td>
                <td class="border-t-2 border-gray-200 px-3">
                    <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($product_quantity_err)) ? 'has-error' : ''; ?>"></p>
                    <p class="text-xs text-gray-500 mt-3"><?php echo $product_quantity_err; ?></p>
                    <input id="qnty" class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4 text-center" name="product_quantity" type="number" required>
                </td>
                <td class="border-t-2 border-gray-200 px-3">
                    <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($product_price_err)) ? 'has-error' : ''; ?>"></p>
                    <p class="text-xs text-gray-500 mt-3"><?php echo $product_price_err; ?></p>
                    <input id="price" class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4 text-center" name="product_price" type="number" required>
                </td>
                <td class="border-t-2 border-gray-200 px-3">
                    <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($product_total_err)) ? 'has-error' : ''; ?>"></p>
                    <p class="text-xs text-gray-500 mt-3"><?php echo $product_total_err; ?></p>
                    <input readonly id="total" class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4 text-center" name="product_total" type="numbder" required>                  
                </td>
                <td class="border-t-2 border-gray-200 px-3">
                    <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($product_box_err)) ? 'has-error' : ''; ?>"></p>
                    <p class="text-xs text-gray-500 mt-3"><?php echo $product_box_err; ?></p>
                    <input id="price" class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4 text-center" name="product_box" type="text">
                </td>
                <td class="border-t-2 border-gray-200 px-3">
                    <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($product_category_err)) ? 'has-error' : ''; ?>"></p>
                    <p class="text-xs text-gray-500 mt-3"><?php echo $product_category_err; ?></p>
                    <input id="price" class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4 text-center" name="product_category" type="text">
                </td>
                <td class="border-t-2 border-gray-200 px-3">
                    <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($list_status_err)) ? 'has-error' : ''; ?>"></p>
                    <p class="text-xs text-gray-500 mt-3"><?php echo $list_status_err; ?></p>
                    <input readonly id="price" class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4 text-center" name="list_status" value="Listed" type="text" required>
                </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center"><a style = "" class="text-white bg-indigo-500 border-0 py-1 px-6 rounded" onclick="totalAmount()">Calculate</a></td>
                </tr>
            </table>


	            <div class=" text-center">
	                <br/>
	                <button type="submit" class="text-white bg-green-500 border-0 py-2 px-6 rounded">Submit</button>
	            </div>
	        
	    </form>
	</div>
</section>
<!-- capture image end -->

<!-- Product edit start -->
<?php
   require_once "config.php";
   $sql = "SELECT count(*) FROM products";
  $result = mysqli_query($link, $sql);
  if ($result !== false) {
  $row = mysqli_fetch_row($result);
  //  $total_product =  $row[0];
  }
  ?>
<!-- student list start-->
<section class="text-gray-700 body-font">
  <div class="container-fluid px-6 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Recently added products</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">This displays the recently added products in database</p>
    </div>
    <div class=" w-full mx-auto overflow-auto">
    <p style="padding: 10px;background: #5DADE2; color: white;" class= "text-center">Total Number of Products: <?php echo $row[0]; ?></p>
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Image</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product ID</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Name</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Quantity</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Box</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Status</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Category</th>
            <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Edit</th>
            <!-- <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Box</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Product Category</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">List Status</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Listed Added</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Upload Status</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Upload Date</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Recieved Status</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Recieved Date</th> -->
            <!-- <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Listed By</th>
            <th class="py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Uploaded By</th>
            <th class=" py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Recieved By</th> -->
            
          </tr>
        </thead>
        <tbody> 
        <?php
    // Include config file
require_once "config.php";

// Define variables and initialize with empty values
$first_name = $last_name = $roll_number = $class = $fees = $update_fees = "";
$first_name_err = $last_name_err = $roll_number_err = $class_err = $fees_err = $update_fees_err = "";

 
// Initialize the sessio
 

 
// // Processing form data when form is submitted
// if($_SERVER["REQUEST_METHOD"] == "POST"){
 
//     // Check if first name is empty
//     if(empty(trim($_POST["first_name"]))){
//         $first_name_err = "Please enter First Name.";
//     } else{
//         $first_name = trim($_POST["first_name"]);
//     }
    
//     // Check if last name is empty
//     if(empty(trim($_POST["last_name"]))){
//         $last_name_err = "Please enter your last name.";
//     } else{
//         $last_name = trim($_POST["last_name"]);
//     }

//     // Check if roll number is empty
//     if(empty(trim($_POST["roll_number"]))){
//       $roll_number_err = "Please enter your roll number";
//   } else{
//       $roll_number = trim($_POST["roll_number"]);
//   }

//   // Check if class is empty
//   if(empty(trim($_POST["class"]))){
//     $class_err = "Please enter your class";
// } else{
//     $class = trim($_POST["class"]);
// }

// // Check if fees is empty
// if(empty(trim($_POST["fees"]))){
//   $fees_err = "Please enter your fees";
// } else{
//   $fees = trim($_POST["fees"]);
// }

// // Check if update fees is empty
// if(empty(trim($_POST["update_fees"]))){
//   $update_fees_err = "Please enter your fees";
// } else{
//   $update_fees = trim($_POST["update_fees"]);
// }

// // Check input errors before inserting in database
//     if(empty($first_name_err) && empty($last_name_err) && empty($roll_number_err) && empty($class_err) && empty($fees_err) && empty($update_fees_err)){
      
//       $sql = "UPDATE students SET fees='$update_fees' WHERE roll_number='$roll_number'";

// if ($link->query($sql) === TRUE) {
//   echo "Record updated successfully";
// } else {
//   echo "Error updating record: " . $link->error;
// }
//     }
   
//    // Close connection
//   //  mysqli_close($link);
// }
require_once "config.php";

$sql = "SELECT * FROM products order by product_id desc"; 
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

?>
    <!-- <form action="" method="post" data-toggle="validator"  class="lg:w-1/2 md:w-2/3 mx-auto"> -->
          
          <tr>
            <td class="border-t-2 border-gray-200 ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $first_name_err; ?></p>
        <img style = "width: 120px; height: 80px " src="upload/<?php echo $row["product_id"]; ?>.png" alt="">
              <!-- <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base px-4 py-2 mb-4" value="<?php echo $row[""]; ?>" name="first_name" type="text"> -->
            </td>
            <td class="border-t-2 border-gray-200  ">
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
            <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["product_box"]; ?>" name="class" type="text">
            </td>
            <td class="border-t-2 border-gray-200  ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($fees_err)) ? 'has-error' : ''; ?>"></p>
            
        <p class="text-xs text-gray-500 mt-3"><?php echo $fees_err; ?></p>
            <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base  py-2 mb-4" value="<?php echo $row["list_status"]; ?>" name="fees" type="text">
            </td>

            <td class="border-t-2 border-gray-200 ">
            <p class="text-xs text-gray-500 mt-3 <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>"></p>
        <p class="text-xs text-gray-500 mt-3"><?php echo $first_name_err; ?></p>
              <input readonly class="bg-white rounded focus:outline-none focus:border-indigo-500 text-base px-4 py-2 mb-4" value="<?php echo $row["product_category"]; ?>" name="first_name" type="text">
            </td>            
          
          
        
            <td class="border-t-2 border-gray-200 px-4 py-3">
            <a href="edit_product?product_id=<?php echo $row["product_id"];?>" class="text-white bg-indigo-500 border-0 py-2 px-8  focus:outline-none hover:bg-indigo-600 rounded">Edit</a>
           
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
   <!-- student list end -->
<!-- Product edit end -->



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
   <!-- Configure a few settings and attach camera start-->
<script language="JavaScript">
    Webcam.set({
        width: 400,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img class="mx-auto" style = "width: 400px; height: 300px; margin-top:27px;" src="'+data_uri+'"/>';
        } );
    }
</script>
<script>
function totalAmount(){
var quantity = parseFloat(document.getElementById("qnty").value)
var price = parseFloat(document.getElementById("price").value)
var total = parseFloat(quantity*price)
document.getElementById("total").value = total;
}
</script>
<!-- Configure a few settings and attach camera end-->
   
   </body>
   </html>