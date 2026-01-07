<?php
// Génération d'un ID de réservation unique (simulation)
$reservation_id = "EV-RES-" . rand(100000, 999999);

// Contenu du QR Code
$qr_data = $reservation_id;

// Génération du QR Code via API
$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($qr_data);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ticket - Express Voyage</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">

<div class="container mt-5 mb-5">

  <div class="card shadow-lg p-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-primary">
        <i class="bi bi-ticket-perforated"></i> Ticket de voyage
      </h4>
      <span class="badge bg-success">Réservation confirmée</span>
    </div>

    <hr>

    <div class="row">

      <!-- INFOS VOYAGE -->
      <div class="col-md-7">
        <h5 class="mb-3">Informations du voyage</h5>

        <p><strong>Référence :</strong> <?= $reservation_id ?></p>
        <p><strong>Client :</strong> Gloria</p>
        <p><strong>Trajet :</strong> Douala → Yaoundé</p>
        <p><strong>Date :</strong> 20 Juin 2025</p>
        <p><strong>Heure :</strong> 08h00</p>
        <p><strong>Type de bus :</strong> VIP</p>
        <p><strong>Sièges :</strong> A5, A6, A7</p>
        <p><strong>Montant payé :</strong> <span class="text-primary fw-bold">18 000 FCFA</span></p>
      </div>

      <!-- QR CODE -->
      <div class="col-md-5 text-center">
        <h6 class="mb-3">QR Code</h6>
        <img src="<?= $qr_code_url ?>" alt="QR Code Ticket" class="img-fluid mb-2">
        <p class="text-muted small">
          Présentez ce QR Code à l’embarquement
        </p>
      </div>

    </div>

    <hr>

    <!-- ACTIONS -->
    <div class="d-flex justify-content-end gap-2">
      <button onclick="window.print()" class="btn btn-outline-primary">
        <i class="bi bi-printer"></i> Imprimer
      </button>
      <a href="Accueil.php" class="btn btn-primary">
        <i class="bi bi-house"></i> Accueil
      </a>
    </div>

  </div>

</div>

</body>
</html>
