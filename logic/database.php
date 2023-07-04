<?php

require "../models/User.php";

$host = "db.3wa.io";
$port = "3306";
$dbname = "kevincorvaisier_phpj6";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname";

$user = "kevincorvaisier";
$password = "04646b679a4ab0a202f8007ea81fe675";

$db = new PDO(
    $connexionString,
    $user,
    $password
);

function loadUser(string $email) : User
{
    if (isset($_GET['email'])) {
        $query = $db->prepare('SELECT * FROM users WHERE email = :email');
        $parameters = [
            'email' => $_GET['email']
        ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
    }
}

function saveUser(User $user) : User
{
    $newUser = new User($user);
    return $newUser;
}

?>