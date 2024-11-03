<?php
    session_start();
    require_once($_SERVER["DOCUMENT_ROOT"]."/app/config/Directories.php");
    require_once(ROOT_DIR."includes/header.php");
?>
    <!-- Navbar -->
    <?php require_once(ROOT_DIR."includes/navbar.php"); ?>

    <!-- Product Details -->
    <div class="container mt-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="https://via.placeholder.com/500" alt="Product Image" class="img-fluid">
            </div>

            <!-- Product Information -->
            <div class="col-md-6">
                <h2>Product Name</h2>
                <p class="lead">$50.00</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam convallis, orci sit amet luctus malesuada, felis nisi vehicula velit, at sodales neque purus eget metus. Praesent dictum feugiat purus.</p>

                <!-- Quantity Selection -->
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" class="form-control" value="1" min="1">
                </div>

                <!-- Add to Cart Button -->
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products (Optional) -->
    <div class="container my-5">
        <h3>Related Products</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/200" class="card-img-top" alt="Related Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Related Product 1</h5>
                        <p class="card-text">$30.00</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/200" class="card-img-top" alt="Related Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Related Product 2</h5>
                        <p class="card-text">$40.00</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/200" class="card-img-top" alt="Related Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Related Product 3</h5>
                        <p class="card-text">$35.00</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/200" class="card-img-top" alt="Related Product 4">
                    <div class="card-body">
                        <h5 class="card-title">Related Product 4</h5>
                        <p class="card-text">$45.00</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once(ROOT_DIR."includes/footer.php"); ?>