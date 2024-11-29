//public variables
var count;
var time = 5;
var interval;

//start timer, allow clicking
function startGame()
{
    document.getElementById("btn_game_log").classList = "btn btn-danger disabled";

    var counter = document.getElementById("btn_game_counter");

    document.getElementById("p_game_hs").style.visibility = "hidden";

    //testing
    //console.log("Clicked");

    count = counter.innerText = 1;

    counter.setAttribute("onclick", "countClick()");

    //i like timeout more because it only runs once
    setTimeout(timeUp, 5000);

    document.getElementById("p_game_timer").innerText = time;

    //i use interval to show the timer counting down
    interval = setInterval(timer, 1000);
}

//counts down the time left to click
function timer()
{
    time = time - 1;

    document.getElementById("p_game_timer").innerText = time;
}

//counts the clicks
function countClick()
{
    count++;

    document.getElementById("btn_game_counter").innerText = count;

    //console.log(count);
}

//stop timer and clicking, store info
function timeUp()
{
    //stop timer countdown
    clearInterval(interval);

    //calculate clicks per second
    var cps = count/5;

    document.getElementById("btn_game_counter").setAttribute("onclick", "");

    document.getElementById("p_game_caption").innerText = "Submit your score below!";

    document.getElementById("p_game_timer").innerText = "Times up. You clicked " + cps + " times per second!";

    //console.log("Times Up");

    document.getElementById("btn_game_log").classList = "btn btn-danger";

    document.getElementById("btn_game_sub").classList = "btn btn-primary";

    document.getElementById("btn_game_res").classList = "btn btn-success";

    document.getElementById("p_game_hs").style.visibility = "visible";

    //put total and cps into inputs in a form to submit
    document.getElementById("txt_game_total").setAttribute("value",count);
    document.getElementById("txt_game_cps").setAttribute("value",cps);
}

//sets the session variable to automatically sort scores by highest to lowest
function initHighScoresPage()
{
    sessionStorage.setItem("sort","high");
}