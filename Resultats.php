<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Résultats - Express Voyage</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="resultat.css">
</head>

<body>

<div class="container mt-5 mb-5">

  <h4 class="text-primary mb-4">
    <i class="bi bi-search"></i> Voyages disponibles
  </h4>

  <!-- Carte voyage -->
  <div class="card shadow mb-3">
    <div class="card-body">

      <div class="row align-items-center">
        <div class="col-md-4">
          <h6 class="mb-1">Douala → Yaoundé</h6>
          <small class="text-muted">
            <i class="bi bi-calendar"></i> 20 Juin 2025  
            <i class="bi bi-clock ms-2"></i> 08h00
          </small>
        </div>

        <div class="col-md-2 text-center">
          <span class="badge bg-primary">VIP</span>
        </div>

        <div class="col-md-2 text-center">
          <strong>6 000 FCFA</strong>
        </div>

        <div class="col-md-2 text-center">
          <span class="badge bg-success">Disponible</span>
        </div>

        <div class="col-md-2 text-end">
          <a href="details.php" class="btn btn-outline-primary btn-sm">
            Voir détails
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- Carte voyage -->
  <div class="card shadow mb-3">
    <div class="card-body">

      <div class="row align-items-center">
        <div class="col-md-4">
          <h6 class="mb-1">Douala → Bafoussam</h6>
          <small class="text-muted">
            <i class="bi bi-calendar"></i> 20 Juin 2025  
            <i class="bi bi-clock ms-2"></i> 09h30
          </small>
        </div>

        <div class="col-md-2 text-center">
          <span class="badge bg-secondary">Classique</span>
        </div>

        <div class="col-md-2 text-center">
          <strong>5 000 FCFA</strong>
        </div>

        <div class="col-md-2 text-center">
          <span class="badge bg-danger">Complet</span>
        </div>

        <div class="col-md-2 text-end">
          <button class="btn btn-outline-secondary btn-sm" disabled>
            Indisponible
          </button>
        </div>
      </div>

    </div>
    

  </div>

</div>

</body>
</html>
