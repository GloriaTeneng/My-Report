<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Paiement - Express Voyage</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="container mt-5 mb-5">

  <h4 class="text-primary mb-4">
    <i class="bi bi-credit-card"></i> Paiement sécurisé
    <small class="text-muted">(Secure payment)</small>
  </h4>

  <div class="row">

    <!-- RÉCAPITULATIF -->
    <div class="col-md-5 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Récapitulatif</h5>
          <hr>

          <p><strong>Trajet :</strong> Douala → Yaoundé</p>
          <p><strong>Date :</strong> 20 Juin 2025</p>
          <p><strong>Heure :</strong> 08h00</p>
          <p><strong>Bus :</strong> VIP</p>
          <p><strong>Sièges :</strong> A5, A6, A7</p>

          <hr>
          <h5 class="text-primary">Total : 18 000 FCFA</h5>
        </div>
      </div>
    </div>

    <!-- MOYENS DE PAIEMENT -->
    <div class="col-md-7">
      <div class="card shadow-sm">
        <div class="card-body">

          <h5 class="mb-3">Choisissez un moyen de paiement</h5>
          <hr>

          <form action="ticket.php" method="post">

            <!-- MTN MOMO -->
            <div class="form-check border rounded p-3 mb-3">
              <input class="form-check-input" type="radio" name="payment" id="mtn" checked>
              <label class="form-check-label fw-medium" for="mtn">
                <i class="bi bi-phone text-warning"></i>
                MTN Mobile Money
              </label>
            </div>

            <!-- ORANGE MONEY -->
            <div class="form-check border rounded p-3 mb-3">
              <input class="form-check-input" type="radio" name="payment" id="orange">
              <label class="form-check-label fw-medium" for="orange">
                <i class="bi bi-phone text-danger"></i>
                Orange Money
              </label>
            </div>

            <!-- INFO -->
            <div class="alert alert-info">
              <i class="bi bi-info-circle"></i>
              Le paiement est simulé dans le cadre académique du projet.
            </div>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary btn-lg">
                Payer et confirmer la réservation
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>

</div>

</body>
</html>
