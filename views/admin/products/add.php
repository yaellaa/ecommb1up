<?php
session_start();

require_once($_SERVER["DOCUMENT_ROOT"]."/app/config/Directories.php");
require_once(ROOT_DIR."includes/header.php");

if(isset($_SESSION["error"])){
    $messageErr=$_SESSION["error"];
    unset($_SESSION["error"]);
};

if(isset($_SESSION["success"])){
    $messageSucc=$_SESSION["success"];
    unset($_SESSION["success"]);
};

require_once(__DIR__."/../../components/page-guard.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - MyShop</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar with Dropdown for User Account (Admin) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="homepage.php">MyShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.html">Dashboard</a>
                    </li>

                    <!-- Dropdown for Admin User -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            AdminUser <!-- Replace with dynamic admin username -->
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.html">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php require_once(__DIR__."/../../components/page-guard.php"); ?>

    <!-- Product Maintenance Form -->
    <div class="container my-5">
        <h2>Product Maintenance</h2>

        <!-- ALERTS -->
        <?php if (isset($messageSucc)) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo $messageSucc; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } elseif (isset($messageErr)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo $messageErr; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>


        <form action="<?php echo BASE_URL;?>app/product/create_product.php" enctype="multipart/form-data" method="POST">
        <div class="row">
                <!-- Left Column: Product Image -->
                <div class="col-md-4 mb-3">
                    <label for="productImage" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>

                    <div class="mt-3">
                        <img id="imagePreview" src="" alt="Image Preview" class="img-fluid" style="display: none; max-height: 300px;">
                    </div>
                </div>

                <!-- Right Column: Product Details -->
                <div class="col-md-8">
                    <div class="row">
                        <!-- Product Name -->
                        <div class="col-md-12 mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name">
                        </div>

                        <!-- Product Category -->
                        <div class="col-md-12 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" class="form-select" name="category">
                                <option selected>Choose a category</option>
                                <option value="1">Electronics</option>
                                <option value="2">Fashion</option>
                                <option value="3">Home Appliances</option>
                                <!-- Add more categories as needed -->
                            </select>
                        </div>
                    </div>

                    <div class="row">

                    <!-- Base Price -->
                    <div class="col-md-6 mb-3">
                        <label for="numberOfStocks" class="form-label">Base Price</label>
                        <input type="number" class="form-control" id="basePrice" name="basePrice" placeholder="Enter Base Price">
                    </div>

                        <!-- Number of Stocks -->
                        <div class="col-md-6 mb-3">
                            <label for="numberOfStocks" class="form-label">Number of Stocks</label>
                            <input type="number" class="form-control" id="numberOfStocks" name="numberOfStocks" placeholder="Enter number of stocks" oninput="calculateTotalPrice()">
                        </div>

                        <!-- Unit Price -->
                        <div class="col-md-6 mb-3">
                            <label for="unitPrice" class="form-label">Unit Price</label>
                            <input type="number" step="0.01" class="form-control" id="unitPrice" name="unitPrice" placeholder="Enter unit price" oninput="calculateTotalPrice()">
                        </div>

                        <!-- Total Price (Automatically Calculated) -->
                        <div class="col-md-6 mb-3">
                            <label for="totalPrice" class="form-label">Total Price</label>
                            <input type="text" class="form-control" id="totalPrice" name="totalPrice" placeholder="Total Price" readonly>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter product description"></textarea>
                        </div>
                    </div>

                    <!-- Save Button (aligned to right) -->
                    <div class="row">
                        <div class="col-md-12 d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Save Product</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script>
    const fileInput = document.getElementById('productImage');
    const imagePreview = document.getElementById('imagePreview');

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0]; // Get the selected file

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show the image
            }

            reader.readAsDataURL(file);
        }
    });

    function calculateTotalPrice() {
        const unitPrice = document.getElementById("unitPrice").value;
        const numberOfStocks = document.getElementById("numberOfStocks").value;
        const totalPrice = unitPrice * numberOfStocks;
        document.getElementById("totalPrice").value = totalPrice.toFixed(2);
    }
</script>    

    <?php require_once(ROOT_DIR."/includes/footer.php"); ?>
