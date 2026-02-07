<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Express Voyage</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <!--  CSS -->
  <link rel="stylesheet" href="Dashboard.css">
</head>

<body>

<div class="d-flex">

  <!-- Sidebar -->
  <div class="sidebar p-3">
    <h4 class="text-white text-center">Express Voyage</h4>
    <hr class="text-light">

    <ul class="nav flex-column">
      <li class="nav-item active"><i class="bi bi-speedometer2"></i> Dashboard</li>
      <li class="nav-item"><i class="bi bi-bus-front"></i> Bus</li>
      <li class="nav-item"><i class="bi bi-geo-alt"></i> Trajets</li>
      <li class="nav-item"><i class="bi bi-calendar-event"></i> Voyages</li>
      <li class="nav-item"><i class="bi bi-ticket"></i> Réservations</li>
      <li class="nav-item"><i class="bi bi-credit-card"></i> Paiements</li>
      <li class="nav-item"><i class="bi bi-qr-code-scan"></i> Scanner QR</li>
      <li class="nav-item"><i class="bi bi-bar-chart"></i> Statistiques</li>
    </ul>
  </div>

  <!-- Main -->
  <div class="main-content flex-fill">

    <!-- Header -->
    <div class="header shadow-sm p-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Tableau de bord</h5>
      <div>
        <span class="me-3"><i class="bi bi-bell"></i></span>
        <span class="fw-bold">Admin</span>
      </div>
    </div>

    <!-- Stats -->
    <div class="container-fluid mt-4">
      <div class="row g-3">

        <div class="col-md-3">
          <div class="card stat-card">
            <h6>Réservations</h6>
            <h2 id="resCount">0</h2>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card stat-card">
            <h6>Recettes</h6>
            <h2 id="moneyCount">0 FCFA</h2>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card stat-card">
            <h6>Voyages</h6>
            <h2 id="tripCount">0</h2>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card stat-card">
            <h6>Places restantes</h6>
            <h2 id="seatCount">0</h2>
          </div>
        </div>

      </div>

      <!-- Reservations -->
      <div class="card mt-4">
        <div class="card-header bg-primary text-white">
          Réservations en attente
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Client</th>
                <th>Trajet</th>
                <th>Sièges</th>
                <th>Paiement</th>
                <th>Statut</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody id="reservationTable">
              <tr>
                <td>Gloria</td>
                <td>Douala → Yaoundé</td>
                <td>A1, A2</td>
                <td><span class="badge bg-success">Payé</span></td>
                <td><span class="badge bg-warning">En attente</span></td>
                <td>
                  <button class="btn btn-success btn-sm" onclick="valider(this)">Valider</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

  </div>
</div>

<script src="script.js">
    // Animation des compteurs
function animateCount(id, start, end, duration) {
  let range = end - start;
  let current = start;
  let increment = end > start ? 1 : -1;
  let stepTime = Math.abs(Math.floor(duration / range));

  let timer = setInterval(() => {
    current += increment;
    document.getElementById(id).innerText = current;
    if (current == end) clearInterval(timer);
  }, stepTime);
}

animateCount("resCount", 0, 128, 1200);
animateCount("tripCount", 0, 16, 1200);
animateCount("seatCount", 0, 230, 1200);
animateCount("moneyCount", 0, 845000, 1200);

// Validation réservation
function valider(btn) {
  let row = btn.closest("tr");
  row.querySelector("td:nth-child(5)").innerHTML =
    '<span class="badge bg-success">Confirmée</span>';
  btn.remove();

  alert("Réservation validée avec succès !");
}

</script>
</body>
</html>
