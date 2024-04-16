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
        <h1>Anonymous Member Feedback on the Volume Organization's Event</h1>
    </div>
    <div class="form-container">
        <form action="add_block.php" method="post">
            <div class="form-group">
                <label for="title">Feedback Title:</label>
                <input type="text" id="title" name="title" placeholder="Title of your feedback" required>
            </div>
            <div class="form-group">
                <label for="message">Your Feedback:</label>
                <textarea id="message" name="message" placeholder="Your feedback" required></textarea>
            </div>
            <div class="form-group">
                <label for="gender">Your Gender:</label>
                <input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked";?>>Female
                <input type="radio" name="gender" value="male" <?php if (isset($gender) && $gender=="male") echo "checked";?>>Male
                <input type="radio" name="gender" value="other" <?php if (isset($gender) && $gender=="other") echo "checked";?>>Other
            </div>
            <div class="form-group">
                <label for="age">Your Age:</label>
                <input type="number" id="age" name="age" placeholder="Your age" required>
            </div>
            <button type="submit">Submit</button>
            <p><span style="color:gray">You are logged in as <?php echo $_SESSION['username']; ?>, <a href="logout.php">logout.</a></span></p>
        </form>
    </div>
</body>

</html>