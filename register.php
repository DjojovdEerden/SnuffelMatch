<?php
session_start();
require_once 'PHP/config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $wachtwoord = $_POST['wachtwoord'] ?? '';
    $voornaam = $_POST['voornaam'] ?? '';
    $achternaam = $_POST['achternaam'] ?? '';
    
    // Combine first and last name for the 'naam' column
    $naam = trim($voornaam . ' ' . $achternaam);

    if (!empty($email) && !empty($wachtwoord) && !empty($naam)) {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM gebruiker WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'Dit email adres is al geregistreerd';
        } else {
            // Hash password and insert user
            $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);
            
            // Insert only columns that exist in the gebruiker table based on your SQL
            $stmt = $pdo->prepare("INSERT INTO gebruiker (naam, email, wachtwoord) VALUES (?, ?, ?)");
            
            try {
                $stmt->execute([$naam, $email, $hashed_password]);
                $success = 'Registratie succesvol! U kunt nu inloggen.';
            } catch(PDOException $e) {
                // Log the actual error for debugging (optional, but good practice during development)
                // error_log("Registration error: " . $e->getMessage());
                $error = 'Er is een fout opgetreden bij het registreren';
            }
        }
    } else {
        $error = 'Vul alle verplichte velden in (Voornaam, Achternaam, Email, Wachtwoord)';
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren - SnuffelMatch</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .register-container {
            max-width: 600px;
            margin: 120px auto 40px auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .register-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group.full-width {
            grid-column: auto;
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

        .register-btn {
            background: #FF6B6B;
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            grid-column: 1 / -1;
        }

        .register-btn:hover {
            background: #ff5252;
        }

        .error-message {
            color: #ff0000;
            margin-bottom: 1rem;
            text-align: center;
            grid-column: 1 / -1;
        }

        .success-message {
            color: #4CAF50;
            margin-bottom: 1rem;
            text-align: center;
            grid-column: 1 / -1;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
            grid-column: 1 / -1;
        }

        .login-link a {
            color: #FF6B6B;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .register-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include 'PHP/header.php'; ?>

    <main>
        <div class="register-container">
            <h2 style="text-align: center; margin-bottom: 2rem;">Registreren</h2>
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <form class="register-form" method="POST" action="register.php">
                <div class="form-group">
                    <label for="voornaam">Voornaam *</label>
                    <input type="text" id="voornaam" name="voornaam" required>
                </div>
                <div class="form-group">
                    <label for="achternaam">Achternaam *</label>
                    <input type="text" id="achternaam" name="achternaam" required>
                </div>
                <div class="form-group full-width">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group full-width">
                    <label for="wachtwoord">Wachtwoord *</label>
                    <input type="password" id="wachtwoord" name="wachtwoord" required>
                </div>
                
                <!-- Removed fields not in the current SQL schema -->
                <?php /*
                <div class="form-group">
                    <label for="telefoon">Telefoon</label>
                    <input type="tel" id="telefoon" name="telefoon">
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode</label>
                    <input type="text" id="postcode" name="postcode">
                </div>
                <div class="form-group full-width">
                    <label for="adres">Adres</label>
                    <input type="text" id="adres" name="adres">
                </div>
                <div class="form-group">
                    <label for="stad">Stad</label>
                    <input type="text" id="stad" name="stad">
                </div>
                */ ?>

                <button type="submit" class="register-btn">Registreren</button>
            </form>
            <div class="login-link">
                Heeft u al een account? <a href="login.php">Log hier in</a>
            </div>
        </div>
    </main>
</body>
</html> 