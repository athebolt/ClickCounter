<?php
    session_start();

    $servername = "localhost";
    $db_username = "athebolt";
    $db_password = "0204329";
    $db_name = "clickCounter";

    $conn = new mySqli($servername, $db_username, $db_password, $db_name);
    
    if($conn->connect_error)
    {
        exit("connection failed: " . $conn->connect_error);
    }
    else
    {
        //echo "<h1 class='text-light'> GOOD CONNECTION </h1>";
        //store connection in session variable?
        $_SESSION ["Connection"] = true;
        //redirect to login
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="index.js"></script>
</head>
<body>
</body>
</html>