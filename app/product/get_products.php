<?php
include(ROOT_DIR."app/config/DatabaseConnect.php");
    $db = new DatabaseConnect();
    $conn = $db->connectDB();

    //this variable will hold product data from db
    $productList =[];
    try {

        $sql  = "SELECT * FROM `products` "; //select statement here
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $productList = $stmt->fetchAll();
        

    } catch (PDOException $e){
        echo "Connection Failed: " . $e->getMessage();
        $db = null;
    }
    