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
    <title>Game</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="game.js" type="text/javascript"></script>
</head>
<body class="bg-dark" onload="initHighScoresPage()">
    <div class="container mt-5">
        <div class="row" style="align-content:center;height:70vh">
            <div class="col"></div>
            <div class="col-8 bg-light text-center rounded p-3" style="width:400px">
                <h1 class="pb-3">Click Counter</h1>

                <?php
                    if(isset($_POST["btn_game_sub"]))
                    {
                        $sql = "INSERT INTO scores (uname,total,cps,date)
                        VALUES ('" . $_SESSION["uname"] . "','" . $_POST["txt_game_total"] . "','" . $_POST["txt_game_cps"] . "','" . date("Y-m-d") . "');";

                        //echo "<div class='alert alert-success text-center'>" . $sql . "</div>";

                        if($conn->query($sql) == true)
                        {
                            //score saved
                            echo "<div class='alert alert-success alert-dismissible text-center'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Score submitted successfully!</div>";
                        }
                        else
                        {
                            echo "<div class='alert alert-danger alert-dismissible text-center'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>SERVER ERROR.</div>";
                        }
                    }
                ?>

                <p id="p_game_caption">How many times can you click in 5 seconds?</p>

                <p id="p_game_timer">Click the button below to find out!</p>

                <button type="button" id="btn_game_counter" class="btn btn-secondary" style="width:75%;height:150px;" onclick="startGame()">Click here</button>

                <p class="mt-3 mb-4" id="p_game_hs">To see high scores, click <a href="scores.php" class="text-info text-decoration-none">here</a>.</p>

                <div class="row">
                    <div class="col-4">
                        <a href="game.php" id="btn_game_res" class="btn btn-success disabled">Restart</a>
                    </div>
                    <div class="col-4">
                        <form action="game.php" method="post">
                            <input type="hidden" id="txt_game_total" name="txt_game_total">
                            <input type="hidden" id="txt_game_cps" name="txt_game_cps">
                            <button type="submit" name="btn_game_sub" id="btn_game_sub" class="btn btn-primary disabled">Submit</button>
                        </form>
                    </div>
                    <div class="col-4">
                        <a href="index.php" id="btn_game_log" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>