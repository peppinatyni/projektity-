<?php
session_start();

// tarkistetaan, onko käyttäjä sisäänkirjautunut. ohjataan takaisin kirjautumissivulle jos ei ole sisäänkirjautunut
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// muodostetaan yhteys tietokantaan
$servername = "mariadb.vamk.fi";
$username = "e2203229";
$password = "9kgEmcPsdPd";
$dbname = "e2203229_database_four";
try {
    // luodaan yhteys tietokantaan (PDO-luokka)
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // virhetilan asetukset ja virheenkäsittely
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Tietokantayhteys epäonnistui: " . $e->getMessage());
}

// varmistetaan, että lomake on lähetetty hyödyntäen POST-metodia
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

// luodaan lohkoketjutaulukko
$createTableQuery = "
CREATE TABLE IF NOT EXISTS blockchain (
    blockchain_index INTEGER PRIMARY KEY AUTO_INCREMENT,
    timestamp TEXT,
    previous_hash TEXT,
    current_hash TEXT,
    data TEXT)
    ";
$pdo->exec($createTableQuery);

// ladataan olemassa oleva lohkoketju
$selectBlockchainQuery = "SELECT * FROM blockchain";
$stmt = $pdo->query($selectBlockchainQuery);
$blockchain = $stmt->fetchAll(PDO::FETCH_ASSOC);

// luodaan genesis block
if (count($blockchain) == 0) {
    $genesisBlock = array(
        'sender' => 'Genesis',
        'receiver' => 'First Block',
        'amount' => 'Second Block',
        'timestamp' => time(),
        'previous_hash' => null,
        'hash' => '0 (genesis block)'
);

$blockchain[] = $genesisBlock;

}
    // tarkistetaan, että tarvittavat kentät ovat olemassa
    if (isset($_POST["sender"]) && isset($_POST["receiver"]) && isset($_POST["amount"])) {

        // haetaan lomakkeen tiedot
        $sender = htmlspecialchars($_POST["sender"]);
        $receiver = htmlspecialchars($_POST["receiver"]);
        $amount = htmlspecialchars($_POST["amount"]);

        // haetaan edellisen lohkon hash
        $previousBlock = end($blockchain);
        $previousHash = isset($previousBlock['hash']) ? $previousBlock['hash'] : null;

        // luodaan uusi lohko
        $block = array(
            'sender' => $sender,
            'receiver' => $receiver,
            'amount' => $amount,
            'timestamp' => time(),
            'previous_hash' => $previousHash
        );

        // uuden lohkon hash ja lisääminen lohkoketjuun
        $block['hash'] = hash('sha256', json_encode($block));
        $blockchain[] = $block;

// tallennetaan päivitetty lohkoketju tietokantaan
foreach ($blockchain as $block) {
    $sender = $block['sender'];
    $receiver = $block['receiver'];
    $amount = $block['amount'];
    $timestamp = $block['timestamp'];
    $previousHash = $block['previous_hash'];
    $hash = $block['hash'];

    $insertBlockQuery = "INSERT INTO blockchain (timestamp, previous_hash, current_hash, data) 
    VALUES ('$timestamp', '$previousHash', '$hash', '$sender-$receiver-$amount')";

    try {
        $pdo->exec($insertBlockQuery);
    } catch (PDOException $e) {
        echo "Virhe tallennettaessa lohkoa tietokantaan: " . $e->getMessage();
    }
}
        // tulostetaan lohkoketju
        echo '<h2>Financial Transactions</h2>';
        echo '<table border="1">';
        echo '<tr><th>Sender</th><th>Receiver</th><th>Amount</th><th>Timestamp</th><th>Hash</th><th>Previous Hash</th></tr>';

        // tulostetaan lohkot
        for ($i = 1; $i < count($blockchain); $i++) {
            $block = $blockchain[$i];
            echo '<tr>';
            echo '<td>' . $block['sender'] . '</td>';
            echo '<td>' . $block['receiver'] . '</td>';
            echo '<td>' . $block['amount'] . '</td>';
            echo '<td>' . date('Y-m-d H:i:s', $block['timestamp']) . '</td>';
            echo '<td>' . $block['hash'] . '</td>';
            echo '<td>' . $block['previous_hash'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'Virhe: Kaikkia tarvittavia kenttiä ei ole asetettu.';
    }
} else {
    echo 'Virhe: Lomaketta ei ole lähetetty oikealla HTTP-metodilla.';
}

echo "<p><span style='color: grey;'>You are logged in as " . $_SESSION['username'] . ", " . "<a href='logout.php'>logout</a>.</span></p>";

?>

