<?php

require "logic/router.php";
require "logic/database.php";
require "models/User.php";

if(isset($_GET["route"])){
    checkRoute($_GET["route"]);
}else{
    checkRoute("");
}

if(isset($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"], $_POST["confirm_password"]))
{
    if($_POST["password"] === $_POST["confirm_password"]){
        $newUser = new User($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
        saveUser($newUser);
    }
}

?>