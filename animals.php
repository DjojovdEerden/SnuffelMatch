<?php
require_once 'PHP/animals.php';

// Get filter from URL parameter
$soort = isset($_GET['soort']) ? $_GET['soort'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;

// Get dieren based on filter
if ($search) {
    $dieren = searchDieren($search);
} elseif ($soort) {
    $dieren = getDierenBySoort($soort);
} else {
    $dieren = getAllDieren();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beschikbare Dieren - SnuffelMatch</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .animals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .animal-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .animal-card:hover {
            transform: translateY(-5px);
        }

        .animal-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .animal-info {
            padding: 1.5rem;
        }

        .animal-name {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .animal-type {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .animal-description {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .adopt-btn {
            background: #4CAF50;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .adopt-btn:hover {
            background: #45a049;
        }

        .filters {
            padding: 2rem;
            background: #f8f9fa;
            margin-bottom: 2rem;
        }

        .filter-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #4CAF50;
            border-radius: 20px;
            background: transparent;
            color: #4CAF50;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover, .filter-btn.active {
            background: #4CAF50;
            color: white;
        }

        .search-bar {
            margin-bottom: 1rem;
        }

        .search-input {
            width: 100%;
            max-width: 500px;
            padding: 0.8rem;
            border: 2px solid #ddd;
            border-radius: 25px;
            font-size: 1rem;
        }

        .search-input:focus {
            outline: none;
            border-color: #4CAF50;
        }
    </style>
</head>
<body>
    <?php include 'PHP/header.php'; ?>

    <main>
        <section class="filters">
            <div class="search-bar">
                <form action="animals.php" method="GET">
                    <input type="text" name="search" class="search-input" placeholder="Zoek dieren..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
                </form>
            </div>
            <div class="filter-buttons">
                <a href="animals.php" class="filter-btn <?php echo !$soort && !$search ? 'active' : ''; ?>">Alle</a>
                <a href="animals.php?soort=hond" class="filter-btn <?php echo $soort === 'hond' ? 'active' : ''; ?>">Honden</a>
                <a href="animals.php?soort=kat" class="filter-btn <?php echo $soort === 'kat' ? 'active' : ''; ?>">Katten</a>
                <a href="animals.php?soort=vogel" class="filter-btn <?php echo $soort === 'vogel' ? 'active' : ''; ?>">Vogels</a>
                <a href="animals.php?soort=klein" class="filter-btn <?php echo $soort === 'klein' ? 'active' : ''; ?>">Kleine Dieren</a>
            </div>
        </section>

        <section class="animals-grid">
            <?php foreach ($dieren as $dier): ?>
            <div class="animal-card">
                <img src="<?php echo htmlspecialchars($dier['afbeelding'] ?: 'images/default.png'); ?>" alt="<?php echo htmlspecialchars($dier['naam']); ?>" class="animal-image">
                <div class="animal-info">
                    <h3 class="animal-name"><?php echo htmlspecialchars($dier['naam']); ?></h3>
                    <p class="animal-type"><?php echo htmlspecialchars(ucfirst($dier['soort']) . ' - ' . $dier['ras']); ?></p>
                    <p class="animal-description"><?php echo htmlspecialchars($dier['beschrijving']); ?></p>
                    <a href="adopt.php?id=<?php echo $dier['id']; ?>" class="adopt-btn">Adopteer Nu</a>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Email: info@snuffelmatch.com</p>
                <p>Telefoon: (123) 456-7890</p>
            </div>
            <div class="footer-section">
                <h3>Volg Ons</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 SnuffelMatch. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</body>
</html> 