var interval;
var count;

function startGame()
{
    document.getElementById("btn_game_log").classList = "btn btn-danger disabled";

    var counter = document.getElementById("btn_game_counter");

    //console.log("Clicked");

    count = 1;

    counter.innerText = 1;

    counter.setAttribute("onclick", "countClick()");

    interval = setInterval(timeUp, 5000);

    document.getElementById("p_game_timer").innerText = "Time started. Keep clicking!";
}

function countClick()
{
    count++;

    document.getElementById("btn_game_counter").innerText = count;

    //console.log(count);
}

function timeUp()
{
    clearInterval(interval);

    document.getElementById("btn_game_counter").setAttribute("onclick", "");

    document.getElementById("p_game_timer").innerText = "Times up. You clicked 0.00 times per second!";

    //console.log("Times Up");

    document.getElementById("btn_game_log").classList = "btn btn-danger";

    document.getElementById("btn_game_res").classList = "btn btn-success";

    document.getElementById("p_game_hs").style.visibility = "visible";
}