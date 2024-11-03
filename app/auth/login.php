<?php

$username = $_POST["username"];
$password = $_POST["password"];

session_start();

include('../config/DatabaseConnect.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $db = new DatabaseConnect();
    $conn = $db->connectDB();    

        try {
            
            $stmt = $conn->prepare('SELECT * FROM `users` WHERE username = :p_username');
            $stmt->bindParam(':p_username',$username);
            $stmt->execute();
            $users = $stmt ->fetchAll();

            if($users){
                  if(password_verify($password,$users[0]["password"])){
                    $_SESSION = [];
                    session_regenerate_id(true);
                    $_SESSION['user_id']  = $users[0]['id'];
                    $_SESSION['username'] = $users[0]['username'];
                    $_SESSION['fullname'] = $users[0]['fullname'];
                    $_SESSION['is_admin'] = $users[0]['is_admin'];

                    header("location: /index.php");
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