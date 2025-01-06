<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Posyandu Desa</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .dashboard-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            border: 2px solid #4CAF50; /* Border added */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .footer {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }

        .dashboard-title {
            margin: 20px 0;
            font-size: 2rem;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #4CAF50; /* Input border */
            border-radius: 5px;
            font-size: 1rem;
        }

        .buttons {
            margin-top: 20px;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <form action="CekLog.php" method="POST" autocomplete="off">
            <a href="index.php">
                <div class="footer">Posyandu Desa</div>
            </a>
            <h1 class="dashboard-title">Login</h1>
            
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>

            <center>
                <div class="buttons">
                    <button type="submit" class="button">Login</button>
                </div>
            </center>
        </form>
    </div>
</body>
</html>