<?php

    //my thought process behind this is to attempt to secure my data
    //i couldn't think of a better way, so this is a start

    session_start();

    $_SESSION["host"] = "localhost";
    $_SESSION["user"] = "athebolt";
    $_SESSION["pass"] = "0204329";
    $_SESSION["db"] = "clickCounter";

    header('Location: login.php');
?>