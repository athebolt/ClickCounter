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
    <title>High Scores</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="scoreHelper.js" type="text/javascript"></script>
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <div class="row">
            <div class="col"></div>
            <div class="col-10 bg-light text-center rounded table-responsive-sm p-3 pb-5">
                <h1>High Scores</h1>
                <div class="row my-3">
                    <div class="col">
                        <!-- This form is how I determine the sort query for the score sorting. Default is highest first. -->
                        <form action="scores.php" method="post"><input type="hidden" id="txt_scores_sort" name="sortBy"><button type="submit" hidden id="btn_scores_sortBy">Submit sort</button></form>
                        <div class="dropdown dropend">
                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown">Sort By</button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" onclick="sortBy('high')">Highest</button></li>
                                <li><button class="dropdown-item" onclick="sortBy('low')">Lowest</button></li>
                                <li><button class="dropdown-item" onclick="sortBy('today')">Today</button></li>
                                <li><hr class="dropdown-divider"></hr></li>
                                <?php
                                    $sql = "SELECT uname FROM users;";

                                    $results = $conn->query($sql);

                                    $count = 0;
                                    while($row = $results->fetch_assoc())
                                    {
                                        echo "<li><button id='btn_scores_user" . ++$count . "' class='dropdown-item' onclick='sortByUser(" . $count . ")'>" . $row["uname"] . "</button></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <a href="game.php" class="btn btn-info">Return to game</a>
                    </div>
                </div>

                <?php
                    if($_POST["sortBy"] == "high")
                    {
                        $sql = "SELECT cps, scores.uname, fname, lname, total, date
                        FROM scores
                        INNER JOIN users ON scores.uname = users.uname
                        ORDER BY total DESC;";
                    }
                    elseif($_POST["sortBy"] == "low")
                    {
                        $sql = "SELECT cps, scores.uname, fname, lname, total, date
                        FROM scores
                        INNER JOIN users ON scores.uname = users.uname
                        ORDER BY total;";
                    }
                    elseif($_POST["sortBy"] == "today")
                    {
                        $sql = "SELECT cps, scores.uname, fname, lname, total, date
                        FROM scores
                        INNER JOIN users ON scores.uname = users.uname
                        WHERE date='" . date("Y-m-d") . "';";
                    }
                    elseif(empty($_POST["sortBy"]))
                    {
                        echo "<script>console.log('post is empty');</script>";

                        $sql = "SELECT cps, scores.uname, fname, lname, total, date
                        FROM scores
                        INNER JOIN users ON scores.uname = users.uname
                        ORDER BY total DESC;";
                    }
                    else
                    {
                        $sql = "SELECT cps, scores.uname, fname, lname, total, date
                        FROM scores
                        INNER JOIN users ON scores.uname = users.uname
                        WHERE scores.uname='". $_POST["sortBy"] ."';";
                    }

                    $results = $conn->query($sql);

                    if($results->num_rows > 0)
                    {
                        echo "<table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th>Row #</th>
                                        <th>Clicks Per Second</th>
                                        <th>User</th>
                                        <th>Full Name</th>
                                        <th>Total Clicks</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>";

                        $count = 1;
                        while($row = $results->fetch_assoc())
                        {
                            echo    "<tr>
                                        <td>" . $count++ . "</td>
                                        <td>" . $row["cps"] . "</td>
                                        <td>" . $row["uname"] . "</td>
                                        <td>" . $row["fname"] . " " . $row["lname"] . "</td>
                                        <td>" . $row["total"] . "</td>
                                        <td>" . $row["date"] . "</td>
                                    </tr>";
                        }
                        echo   "</tbody>
                            </table>";
                    }
                    else
                    {
                        //no data found
                        echo "<div class='alert alert-secondary text-center'>No scores yet. Play to get a score!</div>";
                    }
                ?>

                
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>