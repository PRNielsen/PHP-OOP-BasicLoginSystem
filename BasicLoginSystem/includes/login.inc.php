<?php

if(isset($_POST["submit"])){

    // Grabbing the data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    //Instantiate SignupController class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-controller.classes.php";
    $login = new LoginController($uid, $pwd);

    // Running error handlers and user signup
    $login->loginUser();

    // Going back to front page
    header("location: ../index.php?errors=none");

}