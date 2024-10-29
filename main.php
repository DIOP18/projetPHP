<?php
$main = true;

require('Database/db_connection.php');
include 'Database/annonce_db.php';
include_once './header.php';
include_once 'navbar.php';

$category = isset($_GET['category']) ? $_GET['category'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;
$annonces = getAllAnnonce(true, $search, $category);
$categories = getCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Annonces</title>
    <style>
        body {
           background-image: url('lom.jpg') ;
        }

        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }

        .card {
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .custom-class {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>
</head>
<body>
<br><br><br><br><br><br><br>

<form action="main.php" method="get">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="input-group mb-3">
                    <select id="category" name="category" class="form-control">
                        <option value="">Sélectionnez une catégorie...</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['designation']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i> Rechercher</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div id="loading" style="display: none;">
    <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

<div id="annonces">
    <?php if (empty($annonces)) : ?>
        <?php if (!empty($search) || !empty($category)) : ?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="alert alert-warning" role="alert">
                            Aucune annonce trouvée pour votre recherche.
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="alert alert-info" role="alert">
                            Aucune annonce disponible.
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="container">
            <h2>Annonces</h2>
            <div class="row">
                <?php foreach ($annonces as $annonce) : ?>
                    <div class="col-sm-4 mb-4">
                        <div class="card h-100">
                            <img src="<?php echo is_array($annonce) ? $annonce['image'] : $annonce->image; ?>" class="card-img-top img-fluid" alt="Image de l'annonce">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo is_array($annonce) ? $annonce['titre'] : $annonce->titre; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo "Auteur: " . (is_array($annonce) ? $annonce['prenom_utilisateur'] : $annonce->prenom_utilisateur) . ' ' . (is_array($annonce) ? $annonce['nom_utilisateur'] : $annonce->nom_utilisateur); ?></h6>
                                <p class="card-text"><?php echo "Date de création: " . (is_array($annonce) ? $annonce['date_creation'] : $annonce->date_creation); ?></p>
                                <p class="card-text"><?php echo "Catégorie: " . (is_array($annonce) ? $annonce['nom_categorie'] : $annonce->nom_categorie); ?></p>
                                <button type="button" class="btn btn-primary btn-sm" onclick="showDetails(
                                    '<?php echo is_array($annonce) ? $annonce['titre'] : $annonce->titre; ?>',
                                    '<?php echo is_array($annonce) ? $annonce['description'] : $annonce->description; ?>',
                                    '<?php echo is_array($annonce) ? $annonce['date_creation'] : $annonce->date_creation; ?>',
                                    '<?php echo is_array($annonce) ? $annonce['date_update'] : $annonce->date_update; ?>',
                                    '<?php echo is_array($annonce) ? $annonce['etat'] : $annonce->etat; ?>',
                                    '<?php echo is_array($annonce) ? $annonce['validate'] : $annonce->validate; ?>',
                                    '<?php echo is_array($annonce) ? $annonce['image'] : $annonce->image; ?>'
                                    )"><i class="fas fa-eye"></i> Voir détails</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>


<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailsModalBody"></div>
        </div>
    </div>
</div>

<script>
function showDetails(titre, description, date_creation, date_update, etat, validate, image) {
    var modalTitle = document.getElementById('detailsModalLabel');
    var modalBody = document.getElementById('detailsModalBody');

    modalTitle.textContent = titre;
    modalBody.innerHTML = `
        <img src="${image}" class="img-fluid mb-3" alt="Image de l'annonce">
        <p><strong>Description:</strong> ${description}</p>
        <p><strong>Date de création:</strong> ${date_creation}</p>
        <p><strong>Date de mise à jour:</strong> ${date_update}</p>
        <p><strong>État:</strong> ${etat}</p>
        <p><strong>Validé:</strong> ${validate}</p>
    `;

    $('#detailsModal').modal('show');
}
</script>

<?php
include_once './footer.php';
?>
