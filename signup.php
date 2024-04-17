<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

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
            font-family: Arial;
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
        <h1>Create New Account</h1>
    </div>
    <div class="form-container">
        <form action="accounts.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Email address" required>
            </div>
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" placeholder="New password" required>
            </div>
            <button type="submit">Sign Up</button>
        </form>
        <p><span style="color:gray">Create new account or <a href="login.php">login</a></span></p>
    </div>
    <div>
        <h4>Please Create New Account</h4>
    </div>
</body>

</html>