<?php

$username = $_POST["username"];
$password = $_POST["password"];

session_start();

//received user input

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //validate confirmpassword

        //connect to database
        $host = "localhost";
        $database = "ecommb1";
        $dbusername = "root";
        $dbpassword = "";
        
        $dsn = "mysql: host=$host;dbname=$database;";
        try {
            $conn = new PDO($dsn, $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            $stmt = $conn->prepare('SELECT * FROM `users` WHERE username = :p_username');
            $stmt->bindParam(':p_username',$username);
            
            $stmt->execute();
            $users = $stmt ->fetchAll();
            if($users){
                //echo $users[0]["password"];
                  if(password_verify($password,$users[0]["password"])){
                    //echo "login successful;
                    header("location: /index.php");
                    $_SESSION["fullname"] = $users[0]["fullname"];
                    exit;
                  }else{
                    header("location: /login.php");
                    $_SESSION["error"] = "password did not match";
                    exit;
                  }

                if($password == $users[0]["password"]){
                echo "user found".json_encode($users);
                $_SESSION["fullname"] = $users[0]["fullname"];
                $_SESSION ["fullname"] = $users[0]["fullname"];
            }else{
                echo "user not exist";
            }
        }

            //header("location: /registration.php?success=Connection Successful");
            exit; 
        } catch (Exception $e){
            echo "Connection Failed: " . $e->getMessage();
        }
        

}


//connect to database
//insert data

?>