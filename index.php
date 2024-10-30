<?php
require_once('connection.php');
$newconnection->useLogout();
if(!isset($_SESSION['name'])) {
    
}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<div class="container border border-dark mt-3">
    <form action="" method="post">
        <button type="submit" name="user_out">logout</button>
    </form>
    <br>
    <form class="row g-3" method="POST">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Start Date:</label>
            <input type="date" name="start_date" class="form-control" id="start_date">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">End Date:</label>
            <input type="date" name="end_date" class="form-control" id="endt_date">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name" id="product_name">
        </div>

        <div class="col-md-6">
            <label for="category">Category</label>
            <select class="form-select" name="category">
                <option value="">All</option>
                <option value="Vegetables">Vegetables</option>
                <option value="Fruits">Fruits</option>
                <option value="Drinks">Drinks</option>
                <option value="Foods">Food</option>
            </select>
        </div>

        <div class="col-6">
            <label for="member_type">Product availability:</label>
            <select class="form-select" name="product_availability">
                <option value="">All</option>
                <option value="In Stock">In stock</option>
                <option value="Out of Stock">Out of stock</option>
            </select>
        </div>




        <div class="col-12">
            <button type="submit" name="search" class="btn btn-primary">Filter</button>
        </div>
    </form>
    <br>
</div>


<div class="container">
    <div class="col-12 mt-3 d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
    </div>
    <table class="table table-bordered table-dark mt-2">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Product Availability</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {
            ?>
                <tr>
                    <th scope="row"><?= $row['id']; ?></th>
                    <td><?= $row['product_name']; ?></td>
                    <td><?= $row['category']; ?></td>
                    <td><?= $row['price']; ?></td>
                    <td><?= $row['quantity']; ?></td>
                    <td><?= $row['product_availability']; ?></td>
                    <td><?= $row['date']; ?></td>
                    <td>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['id'] ?>">Delete</button>

                    </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="crud.php" method="post">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="editProductName" class="form-label">Product Name</label>
                                                <input type="text" value="<?= $row['product_name']; ?>" class="form-control" id="editProductName" name="product_name" placeholder="Enter product name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editCategory" class="form-label">Category</label>
                                                <select id="editAvailability" value="" class="form-select" name="category">
                                                    <option selected disabled>Choose...</option>
                                                    <option value="Vegetables">Vegetables</option>
                                                    <option value="Fruits">Fruits</option>
                                                    <option value="Drinks">Drinks</option>
                                                    <option value="Foods">Food</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" value="<?= $row['id'] ?>" name="product_id">
                                                <label for="editPrice" class="form-label">Price</label>
                                                <input type="number" value="<?= $row['price']; ?>" class="form-control" id="editPrice" name="price" placeholder="Enter price">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editQuantity" class="form-label">Quantity</label>
                                                <input type="number" value="<?= $row['quantity']; ?>" class="form-control" id="editQuantity" name="quantity" placeholder="Enter quantity">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editAvailability" class="form-label">Availability</label>
                                                <select id="editAvailability" value="product_availability" class="form-select" name="availability">
                                                    <option selected disabled>Choose...</option>
                                                    <option value="In Stock">In Stock</option>
                                                    <option value="Out of Stock">Out of Stock</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editDate" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="editDate" name="date" value="<?= isset($row['date']) ? $row['date'] : ''; ?>" placeholder="Date">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="update_product" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- delete Modal -->
                <div class="modal fade" id="deleteModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="crud.php" method="post">
                                    <div class="container-fluid">
                                        <input type="hidden" value="<?= $row['id'] ?>" name="product_id">
                                        <p>Are you sure you want to delete this?</p>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="delete_product" class="btn btn-primary">Delete</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </tbody>
    </table>
</div>



<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="crud.php" method="post">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="editProductName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="editProductName" name="product_name" placeholder="Enter product name">
                            </div>
                            <div class="col-md-6">
                                <label for="editCategory" class="form-label">Category</label>
                                <select id="editAvailability" value="" class="form-select" name="category">
                                    <option selected disabled>Choose...</option>
                                    <option value="Vegetables">Vegetables</option>
                                    <option value="Fruits">Fruits</option>
                                    <option value="Drinks">Drinks</option>
                                    <option value="Foods">Food</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="editPrice" class="form-label">Price</label>
                                <input type="number" class="form-control" id="editPrice" name="price" placeholder="Enter price">
                            </div>
                            <div class="col-md-6">
                                <label for="editQuantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="editQuantity" name="quantity" placeholder="Enter quantity">
                            </div>
                            <div class="col-md-6">
                                <label for="editAvailability" class="form-label">Availability</label>
                                <select id="editAvailability" class="form-select" name="availability">
                                    <option selected>Choose...</option>
                                    <option value="In Stock">In Stock</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="editDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="editDate" name="date" placeholder="Enter quantity">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_product" class="btn btn-primary">Add changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>