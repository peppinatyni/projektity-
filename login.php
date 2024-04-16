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
        <h1>Login to Web App</h1>
    </div>
    <div class="form-container">
        <form action="logs.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Email address" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="login">Login</button>
        </form>
        <p><span style="color:gray">Login or <a href="signup.php">create new account</a></span></p>
    </div>
    <div>
        <h4>Please Login</h4>
    </div>
</body>

</html>