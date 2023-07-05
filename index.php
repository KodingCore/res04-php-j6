<?php
require "models/User.php";
require "logic/router.php";
require "logic/database.php";


if(isset($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"], $_POST["confirm_password"]))
{
    if($_POST["password"] === $_POST["confirm_password"])
    {
        $newUser = new User($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
        $passHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $newUser->setPassword($passHash);
        saveUser($newUser);
        checkRoute('');
    }
    else
    {
        checkRoute("creer-un-compte");
        $color = 'red';
        $text = 'Mot de passe de confirmation, différent du mot de passe.';
        echo '<span style="color: ' . $color . '; margin-left: 1rem;">' . $text . '</span>';
    }
}
else if(isset($_POST["login"], $_POST["log-password"]))
{
    $user = loadUser($_POST["login"]);
    $hash = $user->getPassword();
    if(password_verify($_POST['log-password'], $hash))
    {
        session_start();
        $_SESSION["user"] = $user;
        checkRoute("mon-compte");
    }
    else
    {
        checkRoute("connexion");
        $color = 'red';
        $badmdp = "Identifiant ou mot de passe incorrect.";
        echo '<span style="color: ' . $color . '; margin-left: 1rem;">' . $badmdp . '</span>';
    }
}
else if(isset($_GET["route"]))
{
    checkRoute($_GET["route"]);
}
else
{
    checkRoute("");
}






?>