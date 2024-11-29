<?php
    session_start();

    $conn = new mysqli($_SESSION["host"],$_SESSION["user"],$_SESSION["pass"],$_SESSION["db"]);

    if($conn->connect_error)
    {
        //there is a bad connection, disconnect
        exit("bad connection" . $conn->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <div class="row" style="align-content:center;height:70vh">
            <div class="col"></div>
            <div class="col-8 bg-light rounded" style="width:300px">
                <form action="register.php" method="post">
                    <div class="mb-3 mt-3">
                        <p class="text-center">Register</p>
                        <?php
                            //if something is being posted to the server (the form info)
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                //testing
                                //echo "<h1 class='text-light'>register button pressed</h1>";
                            
                                //get all users
                                $sql = "SELECT * FROM users;";
                            
                                //run query
                                $result = $conn->query($sql);
                            
                                //boolean if username exists
                                $err = false;
                            
                                //if there are users
                                if($result->num_rows > 0)
                                {
                                    while($row = $result->fetch_assoc())
                                    {
                                        if($row["uname"] == $_POST["txt_reg_uname"])
                                        {
                                            //username already exists
                                            echo "<div class='alert alert-danger text-center'>Username already exists.</div>";
                                            $err = true;
                                            break;
                                        }
                                    }
                                
                                    //if username is unique
                                    if(!$err)
                                    {
                                        //make sure fields are filled
                                        if(!empty($_POST["txt_reg_uname"]) && !empty($_POST["txt_reg_fname"]) && !empty($_POST["txt_reg_lname"]) && !empty($_POST["txt_reg_password"]) && !empty($_POST["txt_reg_conPass"]))
                                        {
                                            //make sure password and conPass match
                                            if($_POST["txt_reg_password"] == $_POST["txt_reg_conPass"])
                                            {
                                                //good to register new user
                                                
                                                //insert into users values ('uname','fname','lname',password');
                                                $sql = "INSERT INTO users 
                                                VALUES ('" . $_POST["txt_reg_uname"] . "','" . $_POST["txt_reg_fname"] . "','" . $_POST["txt_reg_lname"] . "','" . $_POST["txt_reg_password"] . "');";

                                                //if the query ran, then the user was added to the table
                                                if($conn->query($sql) == true)
                                                {
                                                    //take user to the game page
                                                    header('Location: game.php');
                                                
                                                    $conn->close();
                                                }
                                                else
                                                {
                                                    //record creation failed, sometimes this happens and idk why but its nice to have the error message
                                                    echo "<div class='alert alert-danger text-center'>SERVER ERROR. Try again.</div>";
                                                }
                                            }
                                            else
                                            {
                                                //invalid info
                                                echo "<div class='alert alert-danger text-center'>Passwords do not match.</div>";
                                            }
                                        }
                                        else
                                        {
                                            //invalid info
                                            echo "<div class='alert alert-danger text-center'>Please fill all fields.</div>";
                                        }
                                    }
                                }
                            }
                        ?>
                        <input type="text" class="form-control" name="txt_reg_uname" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="txt_reg_fname" placeholder="first name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="txt_reg_lname" placeholder="last name">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="txt_reg_password" placeholder="password">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="txt_reg_conPass" placeholder="confirm password">
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-info text-light">REGISTER</button>
                    </div>
                </form>
                <p class="text-secondary small text-center">Have an account? <a href="index.php" class="text-info text-decoration-none">Login</a></p>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>