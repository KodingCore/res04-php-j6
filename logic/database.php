<?php

function loadUser(string $email) : User
{
    $host = "db.3wa.io";
    $port = "3306";
    $dbname = "kevincorvaisier_phpj6";
    $connexionString = "mysql:host=$host;port=$port;dbname=$dbname";
    
    $log = "kevincorvaisier";
    $password = "04646b679a4ab0a202f8007ea81fe675";
    
    $db = new PDO(
        $connexionString,
        $log,
        $password
    );
    if (isset($_POST['login'])) {
        $query = $db->prepare('SELECT * FROM users WHERE email = :email');
        $parameters = [
            'email' => $_POST['login']
        ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return new User($user['first_name'], $user['last_name'], $user['email'], $user['password']);
    }
}

function saveUser(User $user) : User
{
    $host = "db.3wa.io";
    $port = "3306";
    $dbname = "kevincorvaisier_phpj6";
    $connexionString = "mysql:host=$host;port=$port;dbname=$dbname";
    
    $log = "kevincorvaisier";
    $password = "04646b679a4ab0a202f8007ea81fe675";
    
    $db = new PDO(
        $connexionString,
        $log,
        $password
    );
    
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])) {
        
        $query = $db->prepare('INSERT INTO users(first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password)');
        $parameters = [
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ];
        $query->execute($parameters);

        if (isset($_POST['firstname'])) {
            $query = $db->prepare('SELECT * FROM `users` WHERE first_name = :first_name LIMIT 1');
            $parameters = [
                'first_name' => $_POST['firstname']
            ];
            $query->execute($parameters);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            return new User($user['first_name'], $user['last_name'], $user['email'], $user['password']);
        }
    }
}

?>