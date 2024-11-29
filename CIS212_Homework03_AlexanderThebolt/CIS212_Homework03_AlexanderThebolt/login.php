<?php

    //before you say anything, i found these functions on W3Schools
    //i learned a different way to do the login so it would allow me to do a validation

    //not 100% sure what this does, but it allows me to access PHP session variables
    session_start();

    //start a new connection
    $conn = new mysqli($_SESSION["host"],$_SESSION["user"],$_SESSION["pass"],$_SESSION["db"]);

    //if there is an error in the connection...
    if($conn->connect_error)
    {
        //there is a bad connection, disconnect
        exit("bad connection" . $conn->connect_error);
    }

    //echo "<h1 class='text-light'>connected</h1>";

    //if something is being posted to the server (the form info)
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //testing
        //echo "<h1 class='text-light'>login button pressed</h1>";

        //get all users
        $sql = "SELECT * FROM users;";

        //run query
        $result = $conn->query($sql);

        //if there are users
        if($result->num_rows > 0)
        {
            //testing
            //echo "<h1 class='text-light'>grabbed users</h1>";

            //while there is a row in results
            while($row = $result->fetch_assoc())
            {
                //i put the username and password checks in different if statements to possibly reduce exploit possibilities

                //check if the posted username exists in the db table
                if($row['uname'] == $_POST['txt_login_uname'])
                {
                    //echo "<h1 class='text-light'>username found</h1>";
                
                    //check if password matches the username
                    if($row['password'] == $_POST['txt_login_password'])
                    {
                        //echo "<h1 class='text-light'>passwords match</h1>";

                        //set logged in user using a PHP session variable
                        $_SESSION["uname"] = $row['uname'];
    
                        //move to the game
                        header('Location: game.php');

                        //close connection? idk if i have to do this or not
                        $conn->close();
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <div class="row" style="align-content:center;height:70vh">
            <div class="col"></div>
            <div class="col-8 bg-light rounded" style="width:300px">
                <form action="login.php" method="post">
                    <div class="mb-3 mt-3">
                        <p class="text-center">Login</p>
                        <?php 
                            //this code should not be called if we are posting valid info because valid info redirects the page
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                //alert error message varies depending on if the boxes are filled or not
                                if(empty($_POST["txt_login_uname"]) || empty($_POST["txt_login_password"]))
                                {
                                    echo "<div class='alert alert-danger text-center'>Please fill both fields.</div>";
                                }
                                else
                                {
                                    echo "<div class='alert alert-danger text-center'>Invalid Username or Password.</div>";
                                }
                            }
                        ?>
                        <input type="text" class="form-control" name="txt_login_uname" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="txt_login_password" placeholder="password">
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" name="btn_login_login" class="btn btn-info text-light">LOGIN</button>
                    </div>
                </form>
                <p class="text-secondary small text-center">Not registered? <a href="register.php" class="text-info text-decoration-none">Create an account</a></p>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>