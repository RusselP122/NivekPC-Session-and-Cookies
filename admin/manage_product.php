<!DOCTYPE HTML>
<html>

<head>
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="manage_product.css">
    <link rel="stylesheet" href="mproduct.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
            body {
        background-color: #1b203d;
      }
    
      </style>
	
</head>

<body>

<?php include_once 'sidenav.php'; ?>


    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav">☰ Dashboard</span>
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav2">☰ Dashboard</span>
            </div>

            <div class="col-div-6 profile-container">
                <div class="profile">
                    <img src="avatar.png" class="pro-img" />
                    <p>Adminstrator <i class="fa fa-ellipsis-v dots" aria-hidden="true"></i></p>
                    <div class="profile-div">
                        <p><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="product-heading">Product List</h2>

        <form action="" class="search-bar">
            <input type="search" name="search" pattern=".*\S.*" required>
            <button class="search-btn" type="submit">
                <span>Search</span>
            </button>
        </form>

        <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Product</th>
                <th>Product ID</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include your database connection file
            include_once "../include/conn.php";
            include_once 'product_modal.php'; // Include the product modal file


            // Define how many products to display per page
            $productsPerPage = 10;

            // Get the current page number, default to 1 if not set
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calculate the offset for fetching products from the database
            $offset = ($current_page - 1) * $productsPerPage;

            // Initialize the search query variable
            $searchQuery = '';

            // Check if search query is submitted
            if (isset($_GET['search'])) {
                // Sanitize the search query to prevent SQL injection
                $searchQuery = htmlspecialchars($_GET['search']);
                // Modify the SQL query to include search functionality
                $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchQuery%' LIMIT $offset, $productsPerPage";
            } else {
                // Default SQL query without search functionality
                $sql = "SELECT * FROM products LIMIT $offset, $productsPerPage";
            }

            // Fetch products from the database with pagination
            $result = $pdo->query($sql);

            // Check if there are products in the database
            if ($result->rowCount() > 0) {
                // Define the path to the folder where shop images are stored
                $shopImageFolder = "../shop_product/";

                // Iterate through the product rows and display them in the table
                while ($product = $result->fetch()) {
                    echo "<tr>";
                    echo "<td>{$product['product_id']}</td>";
                    echo "<td><img src='{$shopImageFolder}{$product['product_img']}' alt='Product Image' class='product-img'></td>";
                    echo "<td>{$product['product_name']}</td>";
                    echo "<td>{$product['product_id']}</td>";
                    echo "<td>₱ {$product['product_price']}</td>";
                    echo "<td>{$product['stock']}</td>";
                    echo "<td><span>{$product['description']}</span></td>"; // Modified line
                    echo "<td>";
                    echo $product['stock'] > 0 ? "Active" : "Out of Stock";
                    echo "</td>";
                    echo "<td>";
                    echo "<button class='edit-button' data-product-id='{$product['product_id']}'><i class='fa fa-edit'></i> Edit</button>";
                    echo "<button class='delete-button' data-product-id='{$product['product_id']}'><i class='fa fa-trash'></i> Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No products found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

        <div class="pagination-container">
            <ul class="pagination">
                <?php
		// Calculate total number of products
$total_products_sql = "SELECT COUNT(*) AS total FROM products";
$total_products_result = $pdo->query($total_products_sql);
$total_products_row = $total_products_result->fetch(PDO::FETCH_ASSOC);
$total_products = $total_products_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_products / $productsPerPage);

// Display pagination links
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<li><a href='?page=$i'>$i</a></li>";
}

                ?>
            </ul>
        </div>

<!-- New button container -->
<div class="new-button-container">
    <div class="box-header with-border">
        <a href="#addProductModal" data-toggle="modal" class="btn btn-primary btn-sm btn-flat new-button">
            <i class="fa fa-plus"></i> Add Product
        </a>
    </div>
</div>


        <svg class="hide">
            <symbol id="left" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </symbol>
            <symbol id="right" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </symbol>
        </svg>

    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="mp.js"></script>
    <script src="adminpanel.js"></script>

   
 <script>
    $(document).ready(function() {
        // Edit button click event
        $('.edit-button').click(function() {
            var productId = $(this).data('product-id');
            $.ajax({
                url: 'get_product.php',
                type: 'POST',
                data: { productId: productId },
                dataType: 'json',
                success: function(response) {
                    $('#editProductId').val(response.product_id);
                    $('#editProductName').val(response.product_name);
                    $('#editProductPrice').val(response.product_price);
                    $('#editProductStock').val(response.stock);
                    $('#editProductDescription').val(response.description);
                    $('#editProductModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Delete button click event
        $('.delete-button').click(function() {
            var productId = $(this).data('product-id');
            // Confirm deletion
            if (confirm('Are you sure you want to delete this product?')) {
                // Send an AJAX request to delete_product.php with the product ID
                $.post('delete_product.php', { product_id: productId }, function(data) {
                    // Reload the page or update the product list after deletion
                    location.reload();
                });
            }
        });
    });
</script>
