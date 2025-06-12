<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'PHP/config.php';

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$sql_user = "SELECT * FROM gebruiker WHERE id = ?";
$stmt_user = $pdo->prepare($sql_user);
$stmt_user->execute([$user_id]);
$user = $stmt_user->fetch();

// Fetch matches from the database
$sql_matches = "SELECT d.* FROM matchresult m JOIN dier d ON m.dier_id = d.id WHERE m.gebruiker_id = ?";
$stmt_matches = $pdo->prepare($sql_matches);
$stmt_matches->execute([$user_id]);
$matches = $stmt_matches->fetchAll();

// Fetch likes from the database
$sql_likes = "SELECT d.* FROM favoriet f JOIN dier d ON f.dier_id = d.id WHERE f.gebruiker_id = ?";
$stmt_likes = $pdo->prepare($sql_likes);
$stmt_likes->execute([$user_id]);
$likes = $stmt_likes->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Profiel - SnuffelMatch</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #FF6B6B;
            text-decoration: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            margin-left: 30px;
            font-weight: 500;
        }

        /* Profile Section */
        .profile-section {
            margin-top: 100px;
            padding: 40px 0;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-header h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
        }

        .profile-header p {
            font-size: 18px;
            color: #666;
        }

        .profile-content {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
        }

        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
            flex: 1;
            min-width: 300px;
        }

        .profile-card h2 {
            font-size: 24px;
            color: #FF6B6B;
            margin-bottom: 20px;
        }

        .profile-card p {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        /* Matches Section */
        .matches-section {
            margin-top: 40px;
        }

        .matches-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .match-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .match-card:hover {
            transform: translateY(-5px);
        }

        .match-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .match-info {
            padding: 20px;
        }

        .match-info h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 5px;
        }

        .match-info p {
            font-size: 14px;
            color: #666;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 50px 0;
            text-align: center;
            margin-top: auto;
        }

        .footer-links {
            margin: 20px 0;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            color: white;
            font-size: 24px;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #FF6B6B;
        }

        @media (max-width: 768px) {
            .profile-content {
                flex-direction: column;
            }

            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <?php include 'PHP/header.php'; ?>

    <main class="profile-section">
        <div class="container">
            <div class="profile-header">
                <h1>Mijn Profiel</h1>
                <p>Welkom, <?php echo htmlspecialchars($user['naam']); ?>!</p>
            </div>

            <div class="profile-content">
                <div class="profile-card">
                    <h2>Persoonlijke Informatie</h2>
                    <p><strong>Naam:</strong> <?php echo htmlspecialchars($user['naam']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                </div>

                <div class="profile-card">
                    <h2>Mijn Matches</h2>
                    <div class="matches-grid">
                        <?php if (empty($matches)): ?>
                            <p>Geen matches</p>
                        <?php else: ?>
                            <?php foreach ($matches as $match): ?>
                                <div class="match-card">
                                    <img src="<?php echo htmlspecialchars($match['afbeelding']); ?>" alt="<?php echo htmlspecialchars($match['naam']); ?>" class="match-image">
                                    <div class="match-info">
                                        <h3><?php echo htmlspecialchars($match['naam']); ?></h3>
                                        <p><?php echo htmlspecialchars($match['ras']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="profile-card">
                    <h2>Mijn Likes</h2>
                    <div class="matches-grid">
                        <?php if (empty($likes)): ?>
                            <p>Geen likes</p>
                        <?php else: ?>
                            <?php foreach ($likes as $like): ?>
                                <div class="match-card">
                                    <img src="<?php echo htmlspecialchars($like['afbeelding']); ?>" alt="<?php echo htmlspecialchars($like['naam']); ?>" class="match-image">
                                    <div class="match-info">
                                        <h3><?php echo htmlspecialchars($like['naam']); ?></h3>
                                        <p><?php echo htmlspecialchars($like['ras']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <h3><i class="fas fa-paw"></i> SnuffelMatch</h3>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
            <div class="footer-links">
                <a href="#">Over ons</a>
                <a href="#">Privacy</a>
                <a href="#">Voorwaarden</a>
                <a href="#">Contact</a>
            </div>
            <p>&copy; 2024 SnuffelMatch. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</body>
</html> 