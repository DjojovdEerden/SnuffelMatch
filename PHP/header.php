<?php
session_start();
?>
<header>
    <nav class="container">
        <div class="logo"><i class="fas fa-paw"></i> SnuffelMatch</div>
        <div class="nav-links">
            <a href="index.php"><i class="fas fa-star"></i> Features</a>
            <a href="animals.php"><i class="fas fa-paw"></i> Dieren</a>
            <a href="#how-it-works"><i class="fas fa-info-circle"></i> Hoe het werkt</a>
            <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="profile.php"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Uitloggen</a>
            <?php else: ?>
                <a href="login.php"><i class="fas fa-sign-in-alt"></i> Inloggen</a>
            <?php endif; ?>
        </div>
    </nav>
</header> 