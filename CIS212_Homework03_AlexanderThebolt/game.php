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
<body class="bg-dark">
    <div class="container mt-5">
        <div class="row" style="align-content:center;height:70vh">
            <div class="col"></div>
            <div class="col-8 bg-light text-center rounded p-3" style="width:400px">
                <h1 class="pb-3">Click Counter</h1>

                <p>How many times can you click in 5 seconds?</p>

                <p id="p_game_timer">Click the button below to find out!</p>

                <button type="button" id="btn_game_counter" class="btn btn-secondary" style="width:75%;height:150px;" onclick="startGame()">Click here</button>

                <p class="mt-3 mb-4" id="p_game_hs" style="visibility:hidden">To see high scores, click <a href="scores.php" class="text-info text-decoration-none">here</a>.</p>

                <div class="row">
                    <div class="col">
                        <a href="game.php" id="btn_game_res" class="btn btn-success disabled">Restart</a>
                    </div>
                    <div class="col">
                        <a href="index.php" id="btn_game_log" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>