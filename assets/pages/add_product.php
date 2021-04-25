<?php
// Include config file
 
session_start();

require_once "config.php";

 
// Define variables and initialize with empty values
// $username = $first_name = $last_name = $roll_number = $password = $confirm_password = $class = $unique_id = $reg_code = $term = $fees= "";
// $username_err = $first_name_err = $last_name_err = $roll_number_err = $password_err = $confirm_password_err = $class_err = $unique_id_err = $reg_code__err = "";
// $product_id = "";
// $product_id_err = "";
// $reg_code_new = 1234567890;

$product_id = $product_name = $product_quantity = $product_price = $product_total = $product_box = $product_category = $list_status = $listed_date = $listed_by = "";

$product_id_err = $product_name_err = $product_quantity_err = $product_price_err = $product_total_err = $product_box_err = $product_category_err = $list_status_err = $listed_date_err = $listed_by_err = "";

 
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
     
 
    // Validate product ID
    if(empty(trim($_POST["product_id"]))){
        $product_id_err = "Please enter a Product ID.";
    }
    elseif(strlen(trim($_POST["product_id"])) < 10){
        $product_id_err = "Product ID must have atleast 10 characters.";
    }
     else{
        // Prepare a select statement
        $product_id = trim($_POST["product_id"]);
        $sql = "SELECT product_id FROM products WHERE product_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["product_id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) > 0)
                {
                    $product_id_err = "This Product ID is already taken.";
                    echo "This Product is already listed;<br>";
                }
                 else
                {
                    $product_id = trim($_POST["product_id"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }


            // Validate product quantity
        // if(empty(trim($_POST["product_quantity"])))
        // {
        //     $product_quantity_err = "Please enter Product Quantity.";
        // } 
        // else
        // {
        //     $product_quantity = trim($_POST["class"]);
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

    if(empty(trim($_POST["image"]))){
        echo "Please click image before submitting.";
    }
    else{
        $img = $_POST['image'];
    
    $folderPath = "upload/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = $product_id . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64); 
    }
    //getting values
    // Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('y-m-d H:i:s');

    $product_name = trim($_POST["product_name"]);
    $product_quantity= trim($_POST["product_quantity"]);
    $product_price = trim($_POST["product_price"]);
    $product_total = trim($_POST["product_total"]);
    $product_box = trim($_POST["product_box"]);
    $product_category = trim($_POST["product_category"]);
    $list_status = trim($_POST["list_status"]);
    $listed_date = $date;
    $listed_by = $_SESSION["first_name"];
    

    // $unique_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 10);

    
    
    // Check input errors before inserting in database
    if(empty($product_id_err) && empty($product_name_err) && empty($product_quantity_err) && empty($product_price_err) && empty($product_total_err) && empty($product_box_err) && empty($product_category_err) && empty($list_status_err) && empty($listed_date_err) && empty($listed_by_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO products (product_id, product_name, product_quantity, product_price, product_total, product_box, product_category, list_status, listed_date, listed_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_product_id, $param_product_name, $param_product_quantity, $param_product_price, $param_product_total, $param_box, $param_product_category, $param_list_status, $param_listed_date, $param_listed_by);
            
            // Set parameters
            $param_product_id = $product_id;
            $param_product_name = $product_name;
            $param_product_quantity = $product_quantity;
            $param_product_price = $product_price;
            $param_product_total = $product_total;
            $param_box = $product_box;
            $param_product_category = $product_category;
            $param_list_status = $list_status;
            $param_listed_date = $listed_date;
            $param_listed_by = $listed_by;
 
            // $param_username = $username;
            // $param_unique_id = $unique_id;
            // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // $param_first_name = $first_name;
            // $param_last_name = $last_name;
            // $param_roll_number = $roll_number;
            // $param_class = $class;
            // $param_term = $term;
            // $param_fees = $fees;



            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                session_start();
                header("location: add_edit_product");
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