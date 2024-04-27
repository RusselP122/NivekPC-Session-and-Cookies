<?php
include_once "../include/conn.php";

// Fetch order data from the database with date ordered as date only
$stmt = $pdo->query("SELECT *, DATE(date_ordered) AS ordered_date FROM order_list");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Order List</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="manage_product.css">
    <link rel="stylesheet" href="orderslist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include_once 'sidenav.php'; ?>

</head>

<body className='snippet-body'>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav">☰ Dashboard</span>
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav2">☰ Dashboard</span>
            </div>

            <div class="col-div-6 profile-container">
                <div class="profile">
                    <img src="avatar.png" class="pro-img" />
                    <p>Administrator <i class="fa fa-ellipsis-v dots" aria-hidden="true"></i></p>
                    <div class="profile-div">
                        <p><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" style="width: 200px;" placeholder="Search">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-borderless main">
                            <thead>
                                <tr class="head">
                                    <th scope="col">Username</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Date Ordered</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Iterate over each order and display its information in table rows
                                foreach ($orders as $order) {
                                    echo "<tr class='rounded bg-white'>";
                                    echo "<td>{$order['username']}</td>";
                                    echo "<td>{$order['id']}</td>";
                                    echo "<td>{$order['address']}</td>";
                                    echo "<td>{$order['phone']}</td>";
                                    echo "<td>{$order['ordered_date']}</td>";
                                    echo "<td>";
                                    echo "<div class='dropdown'>";
                                    echo "<button class='btn btn-warning btn-sm dropdown-toggle' type='button' id='paymentStatusDropdown{$order['id']}' data-toggle='dropdown' aria-expanded='false'>";
                                    echo "{$order['payment_status']}";
                                    echo "</button>";
                                    echo "<ul class='dropdown-menu' aria-labelledby='paymentStatusDropdown{$order['id']}'>";
                                    echo "<li><a class='dropdown-item' href='#'>Paid</a></li>";
                                    echo "<li><a class='dropdown-item' href='#'>Awaiting Authentication</a></li>";
                                    echo "<li><a class='dropdown-item' href='#'>Payment Failed</a></li>";
                                    echo "<li><a class='dropdown-item' href='#'>Unpaid</a></li>";
                                    echo "</ul>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>{$order['total']}</td>";
                                    echo "<td>{$order['payment_method']}</td>";
                                    echo "<td>";
                                    echo "<div class='dropdown'>";
                                    echo "<button class='btn btn-primary btn-sm dropdown-toggle' type='button' id='orderStatusDropdown{$order['id']}' data-toggle='dropdown' aria-expanded='false'>";
                                    echo "{$order['order_status']}";
                                    echo "</button>";
                                    echo "<ul class='dropdown-menu' aria-labelledby='orderStatusDropdown{$order['id']}'>";
                                    echo "<li><a class='dropdown-item' href='#'>Processing</a></li>";
                                    echo "<li><a class='dropdown-item' href='#'>Delivered</a></li>";
                                    echo "<li><a class='dropdown-item' href='#'>Cancelled</a></li>";
                                    echo "</ul>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-sm btn-edit'>Edit</button>";
                                    echo "<button class='btn btn-sm btn-delete'>Delete</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type='text/javascript'
        src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
    <script src="adminpanel.js"></script>
</body>

</html>
