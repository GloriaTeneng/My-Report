
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reservations - Express Voyage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="Dashboard.css">
</head>
<body>
<div class="d-flex">
  <div class="sidebar p-3">
    <h4 class="text-white text-center">Express Voyage</h4>
    <hr class="text-light">
    <ul class="nav flex-column">
      <li class="nav-item"><a href="Dashboard.php" class="nav-link text-white"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
      <li class="nav-item"><a href="Bus.php" class="nav-link text-white"><i class="bi bi-bus-front"></i> Bus</a></li>
      <li class="nav-item"><a href="Trajets.php" class="nav-link text-white"><i class="bi bi-geo-alt"></i> Trajets</a></li>
      <li class="nav-item"><a href="voyages.php" class="nav-link text-white"><i class="bi bi-calendar-event"></i> Voyages</a></li>
      <li class="nav-item"><a href="reservations.php" class="nav-link text-white active"><i class="bi bi-ticket"></i> Reservations</a></li>
      <li class="nav-item"><a href="Paiements.php" class="nav-link text-white"><i class="bi bi-credit-card"></i> Paiements</a></li>
      <li class="nav-item"><a href="Scan.php" class="nav-link text-white"><i class="bi bi-qr-code-scan"></i> Scanner QR</a></li>
      <li class="nav-item"><a href="Stats.php" class="nav-link text-white"><i class="bi bi-bar-chart"></i> Statistiques</a></li>
    </ul>
  </div>

  <div class="main-content flex-fill">
    <div class="header shadow-sm p-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Gestion des reservations</h5>
      <span class="fw-bold">Admin</span>
    </div>

    <div class="container-fluid mt-4">
      <div class="card">
        <div class="card-header bg-primary text-white">Reservations en attente</div>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>ID reservation</th>
                <th>ID voyage</th>
                <th>Trajet</th>
                <th>Point depart</th>
                <th>Sieges</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="listeReservations"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
const API_BASE = "http://localhost/PROJET/Back-end/api";

function formatFCFA(value) {
  return Number(value || 0).toLocaleString("fr-FR") + " FCFA";
}

async function chargerReservations() {
  try {
    const res = await fetch(API_BASE + "/reservations_attente.php");
    const data = await res.json();
    const tbody = document.getElementById("listeReservations");

    if (!data.success || !Array.isArray(data.reservations) || data.reservations.length === 0) {
      tbody.innerHTML = '<tr><td colspan="8" class="text-center py-3">Aucune reservation en attente.</td></tr>';
      return;
    }

    tbody.innerHTML = data.reservations.map((r) => {
      const reservationId = String(r.ID_RESERVATION ?? "").replace(/'/g, "\\'");
      return `
      <tr>
        <td>${r.ID_RESERVATION}</td>
        <td>${r.ID_VOYAGE}</td>
        <td>${r.TRAJET ?? "-"}</td>
        <td>${r.POINT_DEPART ?? "-"}</td>
        <td>${r.SIEGES_RESERVATION ?? "-"}</td>
        <td>${formatFCFA(r.MONTANT_TOTAL)}</td>
        <td><span class="badge bg-warning text-dark">En attente</span></td>
        <td><button class="btn btn-sm btn-success" onclick="valider('${reservationId}')">Valider</button></td>
      </tr>
    `;
    }).join("");
  } catch (error) {
    console.error("Erreur chargement reservations:", error);
  }
}

async function valider(id) {
  try {
    const res = await fetch(API_BASE + "/valider_reservation.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id: id })
    });
    const data = await res.json();
    if (data.success) {
      alert("Reservation validee.");
      chargerReservations();
      return;
    }
    alert("La reservation n'a pas pu etre validee.");
  } catch (error) {
    console.error("Erreur validation:", error);
  }
}

chargerReservations();
</script>
</body>
</html>
