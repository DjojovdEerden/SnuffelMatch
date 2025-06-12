<?php
session_start();
require_once 'PHP/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    if (!empty($email) && !empty($wachtwoord)) {
        $stmt = $pdo->prepare("SELECT * FROM gebruiker WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($wachtwoord, $user['wachtwoord'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['voornaam'];
            header('Location: index.php');
            exit();
        } else {
            $error = 'Ongeldige email of wachtwoord';
        }
    } else {
        $error = 'Vul alle velden in';
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen - SnuffelMatch</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 120px auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: 500;
            color: #333;
        }

        .form-group input {
            padding: 0.8rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-group input:focus {
            outline: none;
            border-color: #FF6B6B;
        }

        .login-btn {
            background: #FF6B6B;
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-btn:hover {
            background: #ff5252;
        }

        .error-message {
            color: #ff0000;
            margin-bottom: 1rem;
            text-align: center;
        }

        .register-link {
            text-align: center;
            margin-top: 1rem;
        }

        .register-link a {
            color: #FF6B6B;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo"><i class="fas fa-paw"></i> SnuffelMatch</div>
            <div class="nav-links">
                <a href="index.html"><i class="fas fa-star"></i> Features</a>
                <a href="animals.php"><i class="fas fa-paw"></i> Dieren</a>
                <a href="#how-it-works"><i class="fas fa-info-circle"></i> Hoe het werkt</a>
                <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
            </div>
        </nav>
    </header>

    <main>
        <div class="login-container">
            <h2 style="text-align: center; margin-bottom: 2rem;">Inloggen</h2>
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form class="login-form" method="POST" action="login.php">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="wachtwoord">Wachtwoord</label>
                    <input type="password" id="wachtwoord" name="wachtwoord" required>
                </div>
                <button type="submit" class="login-btn">Inloggen</button>
            </form>
            <div class="register-link">
                Nog geen account? <a href="register.php">Registreer hier</a>
            </div>
        </div>
    </main>
</body>
</html> 