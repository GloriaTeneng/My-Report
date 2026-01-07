<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Détails du voyage - Express Voyage</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

  <div class="container mt-5 mb-5">

  <h4 class="text-primary mb-4">
    <i class="bi bi-bus-front"></i> Détails du voyage
    <small class="text-muted">(Trip details)</small>
  </h4>

  <div class="card shadow">
    <div class="card-body">

      <!-- Trajet -->
      <div class="section-title">Trajet</div>
      <div class="row">
        <div class="col-md-6 info-box">
          <i class="bi bi-geo-alt-fill text-primary"></i>
          <strong>Départ :</strong> Douala
        </div>
        <div class="col-md-6 info-box">
          <i class="bi bi-flag-fill text-danger"></i>
          <strong>Destination :</strong> Yaoundé
        </div>
      </div>

      <!-- Date & Heure -->
      <div class="section-title mt-3">Horaire</div>
      <div class="row">
        <div class="col-md-6 info-box">
          <i class="bi bi-calendar-event"></i>
          <strong>Date :</strong> 20 Juin 2025
        </div>
        <div class="col-md-6 info-box">
          <i class="bi bi-clock"></i>
          <strong>Heure :</strong> 08h00
        </div>
      </div>

      <!-- Bus -->
      <div class="section-title mt-3">Bus</div>
      <div class="row">
        <div class="col-md-6 info-box">
          <strong>Type :</strong>
          <span class="badge badge-vip text-white">VIP</span>
        </div>
        <div class="col-md-6 info-box">
          <strong>Prix :</strong>
          <div class="price">6 000 FCFA</div>
        </div>
      </div>

      <!-- Conditions -->
      <div class="section-title mt-4">Conditions</div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">🕒 Arriver 30 minutes avant</li>
        <li class="list-group-item">🪪 Pièce d’identité obligatoire</li>
        <li class="list-group-item">🎒 Bagages selon réglementation</li>
      </ul>

      <!-- Actions -->
      <div class="d-flex justify-content-between mt-4">
        <a href="resultats.php" class="btn btn-outline-secondary">
          <i class="bi bi-arrow-left"></i> Retour
        </a>
        <a href="sieges.php" class="btn btn-primary">
          Choisir un siège
        </a>
      </div>

    </div>
  </div>
</div>

</body>
</html>
