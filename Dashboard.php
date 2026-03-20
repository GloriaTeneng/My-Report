
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin - Express Voyage</title>
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
      <li class="nav-item"><a href="Dashboard.php" class="nav-link text-white active"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
      <li class="nav-item"><a href="Bus.php" class="nav-link text-white"><i class="bi bi-bus-front"></i> Bus</a></li>
      <li class="nav-item"><a href="Trajets.php" class="nav-link text-white"><i class="bi bi-geo-alt"></i> Trajets</a></li>
      <li class="nav-item"><a href="voyages.php" class="nav-link text-white"><i class="bi bi-calendar-event"></i> Voyages</a></li>
      <li class="nav-item"><a href="reservations.php" class="nav-link text-white"><i class="bi bi-ticket"></i> Reservations</a></li>
      <li class="nav-item"><a href="Paiements.php" class="nav-link text-white"><i class="bi bi-credit-card"></i> Paiements</a></li>
      <li class="nav-item"><a href="Scan.php" class="nav-link text-white"><i class="bi bi-qr-code-scan"></i> Scanner QR</a></li>
      <li class="nav-item"><a href="Stats.php" class="nav-link text-white"><i class="bi bi-bar-chart"></i> Statistiques</a></li>
    </ul>
  </div>

  <div class="main-content flex-fill">
    <div class="header shadow-sm p-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Tableau de bord</h5>      <span class="fw-bold">Admin</span>
    </div>

    <div class="container-fluid mt-4">
      <div class="row g-3">
        <div class="col-md-3"><div class="card stat-card"><h6>Reservations</h6><h2 id="totalReservations">0</h2></div></div>
        <div class="col-md-3"><div class="card stat-card"><h6>Recettes</h6><h2 id="totalRecettes">0 FCFA</h2></div></div>
        <div class="col-md-3"><div class="card stat-card"><h6>Voyages</h6><h2 id="totalVoyages">0</h2></div></div>
        <div class="col-md-3"><div class="card stat-card"><h6>Places restantes</h6><h2 id="totalPlaces">0</h2></div></div>
      </div>

      <div class="card mt-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <span>Reservations en attente</span>
          <button class="btn btn-sm btn-light" type="button" onclick="resetAllSeats()">Reinitialiser tous les sieges</button>
        </div>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Trajet</th>
                <th>Point depart</th>
                <th>Sieges</th>
                <th>Paiement</th>
                <th>Statut</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="listeReservations"></tbody>
          </table>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-header bg-primary text-white">Recettes mensuelles</div>
        <div class="card-body">
          <canvas id="recetteChart" height="90"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const API_BASE = "http://localhost/PROJET/Back-end/api";

function formatFCFA(value) {
  return Number(value || 0).toLocaleString("fr-FR") + " FCFA";
}

async function chargerStatsDashboard() {
  try {
    const res = await fetch(API_BASE + "/dashboard_stats.php");
    const data = await res.json();
    if (!data.success) {
      return;
    }
    document.getElementById("totalReservations").textContent = data.reservations ?? 0;
    document.getElementById("totalRecettes").textContent = formatFCFA(data.recettes);
    document.getElementById("totalVoyages").textContent = data.voyages ?? 0;
    document.getElementById("totalPlaces").textContent = data.places ?? 0;
  } catch (error) {
    console.error("Erreur stats dashboard:", error);
  }
}

async function chargerReservationsAttente() {
  try {
    const res = await fetch(API_BASE + "/reservations_attente.php");
    const data = await res.json();
    if (!data.success || !Array.isArray(data.reservations)) {
      return;
    }

    const rows = data.reservations.map((r) => {
      const reservationId = String(r.ID_RESERVATION ?? "").replace(/'/g, "\\'");
      return `
      <tr>
        <td>${r.ID_RESERVATION}</td>
        <td>${r.TRAJET ?? "-"}</td>
        <td>${r.POINT_DEPART ?? "-"}</td>
        <td>${r.SIEGES_RESERVATION ?? "-"}</td>
        <td>${formatFCFA(r.MONTANT_TOTAL)}</td>
        <td><span class="badge bg-warning text-dark">En attente</span></td>
        <td><button class="btn btn-sm btn-success" onclick="valider('${reservationId}')">Valider</button></td>
      </tr>
    `;
    }).join("");

    document.getElementById("listeReservations").innerHTML = rows || `
      <tr><td colspan="7" class="text-center py-3">Aucune reservation en attente.</td></tr>
    `;
  } catch (error) {
    console.error("Erreur reservations en attente:", error);
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
      await Promise.all([chargerStatsDashboard(), chargerReservationsAttente()]);
      alert("Reservation validee.");
      return;
    }
    alert("Echec de la validation.");
  } catch (error) {
    console.error("Erreur validation:", error);
    alert("Erreur serveur.");
  }
}

async function chargerRecettesMensuelles() {
  try {
    const res = await fetch(API_BASE + "/stats_mensuelles.php");
    const data = await res.json();
    if (!Array.isArray(data)) {
      return;
    }

    const labels = data.map((d) => "Mois " + d.mois);
    const totals = data.map((d) => Number(d.total || 0));

   new Chart(document.getElementById("recetteChart"), {
    type: "bar",
      data: {
        labels: labels,
        datasets: [{
          label: "Recettes mensuelles (FCFA)",
        data: totals,
        backgroundColor: "#1ba84b"
        }]
     },
      options: {
        responsive: true,
        plugins: { legend: { display: true } }
      }
    });
  } catch (error) {
    console.error("Erreur stats mensuelles:", error);
  }
}

async function resetAllSeats() {
  if (!confirm("Reinitialiser tous les sieges ?")) return;
  try {
    const res = await fetch(API_BASE + "/reset_seats.php", { method: "POST" });
    const data = await res.json();
    if (data.success) {
      localStorage.removeItem("seatStatus");
      alert("Sieges reinitialises.");
      await Promise.all([chargerStatsDashboard(), chargerReservationsAttente()]);
      return;
    }
    alert(data.message || "Echec de la reinitialisation.");
  } catch (error) {
    console.error("Erreur reinitialisation:", error);
    alert("Erreur serveur.");
  }
}

chargerStatsDashboard();
chargerReservationsAttente();
chargerRecettesMensuelles();
</script>
</body>
</html>

