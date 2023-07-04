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
    if (isset($_POST['email'])) {
        $query = $db->prepare('SELECT * FROM users WHERE email = :email');
        $parameters = [
            'email' => $_POST['email']
        ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
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
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $query = $db->prepare('INSERT INTO users(first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password)');
        $parameters = [
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
    }
    if (isset($_GET['id'])) {
        $query = $db->prepare('SELECT * FROM users WHERE id = :id');
        $parameters = [
            'id' => $_GET['id']
        ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        print_r($user->getFirstName());
    }
    return $user;
}

?>