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
                        <form action="scores.php" method="post"><input type="hidden" id="txt_scores_page" name="page"><input type="hidden" id="txt_scores_sort" name="sortBy"><button type="submit" hidden id="btn_scores_sortBy">Submit sort</button></form>
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
                    //if the passed sort type is "high" or if there is nothing, then we are sorting by highest first
                    if($_POST["sortBy"] == "high" || empty($_POST["sortBy"]))
                    {
                        $sql = "SELECT cps, scores.uname, fname, lname, total, date
                        FROM scores
                        INNER JOIN users ON scores.uname = users.uname
                        ORDER BY total DESC;";
                    }
                    //else if the sort type is "low", sort by lowest first
                    elseif($_POST["sortBy"] == "low")
                    {
                        $sql = "SELECT cps, scores.uname, fname, lname, total, date
                        FROM scores
                        INNER JOIN users ON scores.uname = users.uname
                        ORDER BY total;";
                    }
                    //sort by only the scores submitted today
                    elseif($_POST["sortBy"] == "today")
                    {
                        $sql = "SELECT cps, scores.uname, fname, lname, total, date
                        FROM scores
                        INNER JOIN users ON scores.uname = users.uname
                        WHERE date='" . date("Y-m-d") . "';";
                    }
                    //this case is used when a username is passed, sort by user, highest to lowest
                    else
                    {
                        $sql = "SELECT cps, scores.uname, fname, lname, total, date
                        FROM scores
                        INNER JOIN users ON scores.uname = users.uname
                        WHERE scores.uname='". $_POST["sortBy"] ."'
                        ORDER BY total DESC;";
                    }

                    //run query
                    $results = $conn->query($sql);

                    //check if query has rows
                    if($results->num_rows > 0)
                    {
                        //setup table heading
                        echo "<table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th>Clicks Per Second</th>
                                        <th>User</th>
                                        <th>Full Name</th>
                                        <th>Total Clicks</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                        <tbody>";
                        
                        $pageNumber = 1;

                        //find the page we are on
                        if(isset($_POST["page"]) && !empty($_POST["page"]))
                        {
                            echo "<script>console.log('test');</script>";

                            $pageNumber = $_POST["page"];

                            //determines how many rows in the query we skip if not on first page
                            $skip = ($pageNumber - 1) * 5;
                            
                            //skipping the rows
                            $count = 0;
                            while($skip > $count)
                            {
                                $results->fetch_assoc();
                                $count++;
                            }
                        }
                        //if no page is passed, we are on page 1
                        else
                        {
                            $pageNumber = 1;
                        }

                        //for testing, what page we are on
                        echo "<script>console.log('". $pageNumber . " page number" . "');</script>";

                        //display the table rows
                        $count = 1;
                        while($row = $results->fetch_assoc())
                        {
                            //only list 5 rows (5 per page)
                            if($count > 5)
                            {
                                break;
                            }

                            //displaying the rows
                            echo    "<tr>
                                        <td>" . $row["cps"] . "</td>
                                        <td>" . $row["uname"] . "</td>
                                        <td>" . $row["fname"] . " " . $row["lname"] . "</td>
                                        <td>" . $row["total"] . "</td>
                                        <td>" . $row["date"] . "</td>
                            </tr>";
                            
                            $count++;
                        }

                        //end table element tags
                        echo   "</tbody></table>";

                        //if there are more than 5 rows, display page numbers below the table
                        if($results->num_rows > 5)
                        {
                            //divides number of rows by 5 to get the amount of pages
                            $numPages = intdiv($results->num_rows,5);

                            //if we are on the first page, we cant go back a page
                            if($pageNumber <= 1)
                            {
                                $disabledPrev = "disabled";
                            }
                            else
                            {
                                $disabledPrev = "";
                            }

                            //if we are on the last page, we cannot go forward a page
                            if($pageNumber == $numPages+1)
                            {
                                $disabledNext = "disabled";
                            }
                            else
                            {
                                $disabledNext = "";
                            }

                            //display page numbers
                            echo "<ul class='pagination justify-content-center'>";
                            echo "<li class='page-item'><button class='page-link " . $disabledPrev . "' onclick='setPage(" . ($pageNumber - 1) . ")'>Previous</button></li>";

                            //determines how many page numbers to display
                            for($i = 1; $i < $numPages + 2; $i++)
                            {
                                echo "<li class='page-item'><button class='page-link' onclick='setPage(" . $i . ")'>" . $i . "</button></li>";
                            }

                            //next page tag and end page number tag
                            echo "<li class='page-item'><button class='page-link " . $disabledNext . "' onclick='setPage(" . ($pageNumber + 1) . ")'>Next</button></li></ul>";
                        }
                    }
                    else
                    {
                        //no rows found, so no scores yet
                        echo "<div class='alert alert-secondary text-center'>No scores yet. Play to get a score!</div>";
                    }
                ?>
                
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>