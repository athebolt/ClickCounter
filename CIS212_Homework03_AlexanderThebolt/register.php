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
                <form action="game.php" method="post">
                    <div class="mb-3 mt-3">
                        <p class="text-center">Register</p>
                        <input type="text" class="form-control" id="uname" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="fname" placeholder="first name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="lname" placeholder="last name">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" placeholder="password">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="conPass" placeholder="confirm password">
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