<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/views/css/stylenav.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/main.php">
                <img src="/2.png" alt="Logo" style="width: 80px; height: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($main) ? "active" : "" ?>" href="/main.php"><i class="fas fa-home"></i> Accueil</a>
                    </li>
                    <?php if(isset($_SESSION['profil']) && $_SESSION['profil'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($annonce) ? "active" : "" ?>" href="/views/annonce/Annonce.php"><i class="fas fa-bullhorn"></i> Annonces</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($utilisateur) ? "active" : "" ?>" href="/views/user/utilisateur.php"><i class="fas fa-users"></i> Utilisateurs</a>
                    </li>
                    <?php endif ?>
                    <?php if(isset($_SESSION['profil']) && $_SESSION['profil'] == 2): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($espace) ? "active" : "" ?>" href="/views/espace/espace.php"><i class="fas fa-user-circle"></i> Mon espace</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($Profil) ? "active" : "" ?>" href="/views/profil/profil.php"><i class="fas fa-id-card"></i> Profil</a>
                    </li>
                    <?php endif ?>
                </ul>
                <?php if(isset($_SESSION['profil'])): ?>
                <form class="d-flex" role="search">
                <a href="/views/profil/contact.php" class="btn btn-outline-light"><i class="fas fa-envelope"></i> Contactez-nous</a>
                 <a href="../../actions/auth/logoutAction.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                </form>
                <?php else: ?>
                <form class="d-flex">
                    <a href="/views/auth/login.php" class="btn btn-outline-light"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
                </form>
                <?php endif ?>
            </div>
        </div>
    </nav>
</header>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>
</html>