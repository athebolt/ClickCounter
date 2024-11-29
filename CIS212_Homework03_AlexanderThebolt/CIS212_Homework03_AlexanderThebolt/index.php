<?php
    #====================================
    #Name: Alexander Thebolt
    #Date: 11-29-2024
    #Desc: CIS212_Homework03_ClickCounter
    #====================================

    //my thought process behind this is to attempt to secure my data
    //i couldn't think of a better way, so this is a start

    session_start();

    //here is the db login info, stored in a session variable
    //at the beginning of every page, i start a new connection and call these session variables
    $_SESSION["host"] = "localhost";
    $_SESSION["user"] = "athebolt";
    $_SESSION["pass"] = "0204329";
    $_SESSION["db"] = "clickCounter";

    //using W3Schools, this is a way to change pages using php.
    header('Location: login.php');

    //this webpage is the first one that loads upon opening the website, but it redirects to login
?>