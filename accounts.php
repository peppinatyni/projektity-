<?php

// muodostetaan yhteys tietokantaan
$servername = "mariadb.vamk.fi";
$username = "e2203229";
$password = "9kgEmcPsdPd";
$dbname = "e2203229_database_two";

try {
// yhdistetään tietokantaan
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// luodaan users-taulu
$createUsersTableQuery = "
CREATE TABLE IF NOT EXISTS users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(255) NOT NULL,
     email VARCHAR(255) NOT NULL,
     password_hash VARCHAR(255) NOT NULL
    )
";
$pdo->exec($createUsersTableQuery);

// lomakkeen tiedot
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// hashataan salasana
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// lisätään käyttäjä tietokantaan
$query = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
$statement = $pdo->prepare($query);
$statement->execute([$name, $email, $hashed_password]);

// ohjataan käyttäjä sisäänkirjautumissivulle
header("Location: login.php");
exit();

// virheilmoitus
} catch(PDOException $e) {
    echo "Virhe: " . $e->getMessage();
}

?>