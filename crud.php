<?php
session_start();
include("connection.php");

$connection = new Connection();
$con = $connection->OpenConnection(); // Initialize $con


if(isset($_POST['add_product']))
{
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity']; 
    $availability = $_POST['availability'];
    $date = $_POST['date'];


    //if user and email already exist
    $query = "INSERT INTO product_tbl(product_name,category,price,quantity,product_availability,date) 
    VALUES (:product_name, :category, :price, :quantity, :availability, :date)";
    $query_run = $con->prepare($query);

    $data = [
        ':product_name' => $product_name,
        ':category' => $category,
        ':price' => $price,
        ':quantity' => $quantity,
        ':availability' => $availability,
        ':date' => $date,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['message'] = "Inserted Successfully";
        header('Location: index.php');
        die;
    }
        $_SESSION['message'] = "Not Inserted";
        header('Location: index.php');
        die;
    }


if (isset($_POST['update_product'])) { // Check if the form was submitted
    $product_id = $_POST['product_id']; // Assuming you have a hidden input for product ID
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity']; 
    $availability = $_POST['availability'];
    $date = $_POST['date'];

    // Prepare the update query
    $query = "UPDATE product_tbl SET 
                product_name = :product_name,
                category = :category,
                price = :price,
                quantity = :quantity,
                product_availability = :availability,
                date = :date
              WHERE id = :product_id"; // Make sure 'id' matches your primary key field name

    $query_run = $con->prepare($query);

    // Bind parameters to the query
    $data = [
        ':product_name' => $product_name,
        ':category' => $category,
        ':price' => $price,
        ':quantity' => $quantity,
        ':availability' => $availability,
        ':date' => $date,
        ':product_id' => $product_id, // Bind the product ID
    ];

    // Execute the query
    $query_execute = $query_run->execute($data);

    // Check if the update was successful
    if ($query_execute) {
        $_SESSION['message'] = "Updated Successfully";
        header('Location: index.php');
        exit; // Use exit instead of die
    } else {
        $_SESSION['message'] = "Update Failed";
        header('Location: index.php');
        exit; // Use exit instead of die
    }
}





if (isset($_POST['delete_product'])) { // Check if the delete button was pressed
    $product_id = $_POST['product_id']; // Assuming you have a hidden input for product ID

    // Prepare the delete query
    $query = "DELETE FROM product_tbl WHERE id = :product_id"; // Make sure 'id' matches your primary key field name

    $query_run = $con->prepare($query);

    // Bind the product ID parameter
    $data = [
        ':product_id' => $product_id, // Bind the product ID
    ];

    // Execute the query
    $query_execute = $query_run->execute($data);

    // Check if the delete was successful
    if ($query_execute) {
        $_SESSION['message'] = "Deleted Successfully";
        header('Location: index.php');
        exit; // Use exit instead of die
    } else {
        $_SESSION['message'] = "Deletion Failed";
        header('Location: index.php');
        exit; // Use exit instead of die
    }
}



    



?>