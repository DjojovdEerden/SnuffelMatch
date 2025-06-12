<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);

require_once 'PHP/config.php';

$animals = [];
$db_ok = false;

// Use PDO for database connection
try {
    $stmt = $pdo->query("SELECT * FROM dier");
    $animals = $stmt->fetchAll();
    if (count($animals) > 0) {
        $db_ok = true;
    }
} catch (Exception $e) {
    $db_ok = false;
}

if (!$db_ok) {
    $animals = [
        [
            'naam' => 'Max',
            'ras' => 'Labrador Retriever',
            'leeftijd' => 2,
            'beschrijving' => 'Energieke en vriendelijke labrador die dol is op wandelen en spelen. Goed met kinderen en andere honden.',
            'afbeelding' => 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80'
        ],
        [
            'naam' => 'Luna',
            'ras' => 'Siamese',
            'leeftijd' => 1,
            'beschrijving' => 'Mooie Siamese kat met opvallende blauwe ogen. Zeer aanhankelijk en dol op knuffelen.',
            'afbeelding' => 'https://images.unsplash.com/photo-1518717758536-85ae29035b6d?auto=format&fit=crop&w=1000&q=80'
        ],
        [
            'naam' => 'Charlie',
            'ras' => 'Parkiet',
            'leeftijd' => 3,
            'beschrijving' => 'Kleurrijke papegaai die graag zingt en geluiden nadoet. Geweldige metgezel voor vogelliefhebbers.',
            'afbeelding' => 'https://images.unsplash.com/photo-1508672019048-805c876b67e2?auto=format&fit=crop&w=1000&q=80'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SnuffelMatch - Swipe</title>
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

        /* Swipe Container */
        .swipe-container {
            margin-top: 100px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-container {
            position: relative;
            width: 100%;
            max-width: 400px;
            height: 600px;
            margin: 0 auto;
        }

        .card {
            position: absolute;
            width: 100%;
            height: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            cursor: grab;
        }

        .card:active {
            cursor: grabbing;
        }

        .card-image {
            width: 100%;
            height: 70%;
            object-fit: cover;
        }

        .card-info {
            padding: 20px;
        }

        .card-info h2 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .card-info .details {
            color: #666;
            margin-bottom: 10px;
        }

        .card-info p {
            font-size: 14px;
            color: #333;
            line-height: 1.4;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .action-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: none;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .action-button:hover {
            transform: scale(1.1);
        }

        .action-button i {
            font-size: 24px;
        }

        .dislike-button {
            color: #FF6B6B;
        }

        .like-button {
            color: #4CAF50;
        }

        /* Match Animation */
        .match-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .match-content {
            background: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
        }

        .match-content h2 {
            color: #FF6B6B;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-container {
                height: 500px;
            }

            .nav-links {
                display: none;
            }
        }

        .reject-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }
    </style>
</head>
<body>
    <?php include 'PHP/header.php'; ?>

    <main class="swipe-container">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <div style="text-align:center; margin-top:100px; font-size:1.2em;">Log in om te kunnen swipen en liken!</div>
        <?php elseif ($db_ok): ?>
        <div class="card-container">
            <?php foreach ($animals as $index => $animal): ?>
                <div class="card" data-id="<?= htmlspecialchars($animal['id']) ?>" style="<?= $index === 0 ? '' : 'display:none;' ?>">
                    <img src="<?= htmlspecialchars($animal['afbeelding']) ?>" alt="<?= htmlspecialchars($animal['naam']) ?>" class="card-image">
                    <div class="card-info">
                        <h2><?= htmlspecialchars($animal['naam']) ?></h2>
                        <div class="details">
                            <span><?= htmlspecialchars($animal['ras']) ?></span> • <span><?= htmlspecialchars($animal['leeftijd']) ?> jaar</span>
                        </div>
                        <p><?= htmlspecialchars($animal['beschrijving']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="action-buttons">
            <button class="action-button dislike-button">
                <i class="fas fa-times"></i>
            </button>
            <button class="action-button like-button">
                <i class="fas fa-heart"></i>
            </button>
        </div>
        <?php endif; ?>
    </main>

    <div class="match-overlay" style="display:none;">
        <div class="match-content">
            <h2>Je hebt dit dier geliked! ❤️</h2>
        </div>
    </div>
    <div class="reject-overlay" style="display:none;">
        <div class="match-content">
            <h2>Je hebt dit dier afgewezen!</h2>
        </div>
    </div>

    <?php if (isset($_SESSION['user_id']) && $db_ok): ?>
    <script>
    const cards = document.querySelectorAll('.card');
    let current = 0;
    const matchOverlay = document.querySelector('.match-overlay');
    const rejectOverlay = document.querySelector('.reject-overlay');
    function likePet() {
        if (current >= cards.length) return;
        const card = cards[current];
        const dierId = card.getAttribute('data-id');
        fetch('like_pet.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'dier_id=' + dierId
        }).then(response => response.text()).then(result => {
            if (result === 'NOT_LOGGED_IN') {
                alert('Je bent niet ingelogd!');
                return;
            }
            // Animate card swipe right
            card.style.transition = 'transform 0.5s ease, opacity 0.5s ease';
            card.style.transform = 'translateX(200%) rotate(20deg)';
            card.style.opacity = '0';
            // Show overlay
            matchOverlay.style.display = 'flex';
            setTimeout(() => {
                matchOverlay.style.display = 'none';
                card.style.display = 'none';
                current++;
                if (current < cards.length) {
                    cards[current].style.display = '';
                }
            }, 1000);
        });
    }
    function dislikePet() {
        if (current >= cards.length) return;
        const card = cards[current];
        const dierId = card.getAttribute('data-id');
        fetch('like_pet.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'dier_id=' + dierId + '&richting=DISLIKE'
        }).then(response => response.text()).then(result => {
            if (result === 'NOT_LOGGED_IN') {
                alert('Je bent niet ingelogd!');
                return;
            }
            // Animate card swipe left
            card.style.transition = 'transform 0.5s ease, opacity 0.5s ease';
            card.style.transform = 'translateX(-200%) rotate(-20deg)';
            card.style.opacity = '0';
            // Show reject overlay
            rejectOverlay.style.display = 'flex';
            setTimeout(() => {
                rejectOverlay.style.display = 'none';
                card.style.display = 'none';
                current++;
                if (current < cards.length) {
                    cards[current].style.display = '';
                }
            }, 1000);
        });
    }
    document.querySelector('.like-button').addEventListener('click', likePet);
    document.querySelector('.dislike-button').addEventListener('click', dislikePet);
    </script>
    <?php endif; ?>
</body>
</html> 