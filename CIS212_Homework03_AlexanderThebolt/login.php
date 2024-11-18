<?php
    if($_SESSION['Connection'])
    {
        echo "<h1 class='text-light'>Connection found</h1>";
    }
    else
    {
        echo "<h1 class='text-light'>Not found</h1>";
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
                <form action="game.php" method="post">
                    <div class="mb-3 mt-3">
                        <p class="text-center">Login</p>
                        <input type="text" class="form-control" id="uname" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="password" placeholder="password">
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-info text-light">LOGIN</button>
                    </div>
                </form>
                <p class="text-secondary small text-center">Not registered? <a href="register.php" class="text-info text-decoration-none">Create an account</a></p>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>