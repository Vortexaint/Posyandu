<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Posyandu Desa</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
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
            border: 2px solid #4CAF50;
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
        .dashboard-title { margin: 20px 0; font-size: 2rem; color: #333; }
        .form-control {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #4CAF50;
            border-radius: 5px;
            font-size: 1rem;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
            font-size: 0.9rem;
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
        .button:hover { background-color: #388E3C; }
    </style>
    <script>
        function validateForm() {
            const username = document.forms["loginForm"]["username"].value;
            const password = document.forms["loginForm"]["password"].value;
            const emailPattern = /^[\w.-]+@[\w.-]+\.(com|co\.id|net|org)$/;
            const passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])/;

            if (!emailPattern.test(username)) {
                alert("Username harus berupa email yang valid (misal: user@example.com)");
                return false;
            }
            if (!passwordPattern.test(password)) {
                alert("Password harus memiliki minimal 1 angka dan 1 simbol.");
                return false;
            }
            return true;
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('showPassword');
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

</head>
<body>
    <div class="dashboard-container">
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form name="loginForm" action="CekLog.php" method="POST" autocomplete="off" onsubmit="return validateForm()">
            <a href="index.php">
                <div class="footer">Posyandu Desa</div>
            </a>
            <h1 class="dashboard-title">Login</h1>
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <div style="text-align: left; margin: 10px 0;">
                <input type="checkbox" id="showPassword" onclick="togglePassword()"> Show Password
            </div>
            <div class="buttons">
                <button type="submit" class="button">Login</button>
            </div>
        </form>
        <p>Belum punya akun? <a href="Daftar(ViaVort).php">Daftar di sini</a></p>
    </div>
</body>
</html>
