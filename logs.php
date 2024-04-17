<?php
// muodostetaan yhteys tietokantaan
$servername = "mariadb.vamk.fi";
$username = "e2203229";
$password = "9kgEmcPsdPd";
$dbname = "e2203229_database_four";

$error = ""; // alustetaan virheilmoitusmuuttuja tyhjäksi

try {
    // luodaan yhteys tietokantaan (PDO-luokka)
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // tarkistetaan, onko lomake lähetetty
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // lomakkeen tiedot
        $email = $_POST['email'];
        $password = $_POST['password'];

        // haetaan käyttäjän tiedot tietokannasta
        $query = "SELECT * FROM users WHERE email = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$email]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // tarkistetaan, onko käyttäjä olemassa, ja että salasana on oikein
        if ($user && password_verify($password, $user['password_hash'])) {
            // ohjataan etusivulle, jos kirjautumistiedot täsmäävät
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            // asetetaan virheilmoitusmuuttujaan viesti, jos kirjautuminen epäonnistui
            $error = "Access denied";
        }
    }
} catch(PDOException $e) {
    // asetetaan virheilmoitusmuuttujaan PDO-virheen viesti
    $error = "Virhe: " . $e->getMessage();
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            background-color: #f4f4f4;
            border-radius: 8px;
            padding: 20px;
            width: 800px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: gray;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        h1 {
            color: gray;
        }

        h4 {
            color:  gray;
        }
    </style>
</head>

<body>
    <div>    
        <h1>Login to Web App</h1>
    </div>
    <div class="form-container">
        <form action="logs.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="login">Login</button>
        </form>
        <p><span style="color:gray">Login or <a href="signup.php">create new account</a></span></p>
    </div>
    <div>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    </div>
</body>

</html>