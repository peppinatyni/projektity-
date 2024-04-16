<?php
session_start();

// tarkistetaan, onko käyttäjä sisäänkirjautunut. ohjataan takaisin kirjautumissivulle jos ei ole sisäänkirjautunut
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>

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
            background-color: mediumslateblue;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        h1 {
            color: mediumslateblue;
        }

        h4 {
            color:  mediumslateblue;
        }
    </style>
</head>

<body>
    <div>    
        <h1>Money Transfer Blockchain Web App</h1>
    </div>
    <div class="form-container">
        <form action="add_block.php" method="post">
            <div class="form-group">
                <label for="sender">Sender:</label>
                <input type="text" id="sender" name="sender" placeholder="Sender's name" required>
            </div>
            <div class="form-group">
                <label for="receiver">Receiver:</label>
                <input type="text" id="receiver" name="receiver" placeholder="Receiver's name" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount" placeholder="Euros" required>
            </div>
            <button type="submit">Submit</button>
            <p><span style="color:gray">You are logged in as <?php echo $_SESSION['username']; ?>, <a href="logout.php">logout.</a></span></p>
        </form>
    </div>
</body>

</html>