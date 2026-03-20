<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Statistiques - Express Voyage</title>
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
      <li class="nav-item"><a href="reservations.php" class="nav-link text-white"><i class="bi bi-ticket"></i> Reservations</a></li>
      <li class="nav-item"><a href="Paiements.php" class="nav-link text-white"><i class="bi bi-credit-card"></i> Paiements</a></li>
      <li class="nav-item"><a href="Scan.php" class="nav-link text-white"><i class="bi bi-qr-code-scan"></i> Scanner QR</a></li>
      <li class="nav-item"><a href="Stats.php" class="nav-link text-white active"><i class="bi bi-bar-chart"></i> Statistiques</a></li>
    </ul>
  </div>

  <div class="main-content flex-fill">
    <div class="header shadow-sm p-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Statistiques</h5>
      <span class="fw-bold">Admin</span>
    </div>

    <div class="container-fluid mt-4">
      <div class="row g-3">
        <div class="col-md-3"><div class="card stat-card"><h6>Reservations</h6><h2 id="sReservations">0</h2></div></div>
        <div class="col-md-3"><div class="card stat-card"><h6>Recettes</h6><h2 id="sRecettes">0 FCFA</h2></div></div>
        <div class="col-md-3"><div class="card stat-card"><h6>Voyages</h6><h2 id="sVoyages">0</h2></div></div>
        <div class="col-md-3"><div class="card stat-card"><h6>Places restantes</h6><h2 id="sPlaces">0</h2></div></div>
      </div>

      <div class="row mt-4 g-3">
        <div class="col-lg-8">
          <div class="card h-100">
            <div class="card-header bg-primary text-white">Evolution des recettes mensuelles</div>
            <div class="card-body">
              <canvas id="monthlyChart" height="120"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card h-100">
            <div class="card-header bg-primary text-white">Top mois</div>
            <div class="card-body">
              <ul class="list-group" id="topMois"></ul>
            </div>
          </div>
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

async function chargerStatsGlobales() {
  try {
    const res = await fetch(API_BASE + "/dashboard_stats.php");
    const data = await res.json();
    if (!data.success) return;

    document.getElementById("sReservations").textContent = Number(data.reservations || 0).toLocaleString("fr-FR");
    document.getElementById("sRecettes").textContent = formatFCFA(data.recettes);
    document.getElementById("sVoyages").textContent = Number(data.voyages || 0).toLocaleString("fr-FR");
    document.getElementById("sPlaces").textContent = Number(data.places || 0).toLocaleString("fr-FR");
  } catch (error) {
    console.error("Erreur stats globales:", error);
  }
}

async function chargerStatsMensuelles() {
  try {
    const res = await fetch(API_BASE + "/stats_mensuelles.php");
    const data = await res.json();
    if (!Array.isArray(data) || data.length === 0) {
      return;
    }

    const normalized = data.map((d) => ({
      mois: Number(d.mois || 0),
      total: Number(d.total || 0)
    }));

    const labels = normalized.map((d) => "Mois " + d.mois);
    const totals = normalized.map((d) => d.total);

    new Chart(document.getElementById("monthlyChart"), {
      type: "line",
      data: {
        labels: labels,
        datasets: [{
          label: "Recettes (FCFA)",
          data: totals,
          borderColor: "#1ba84b",
          backgroundColor: "rgba(13, 110, 253, 0.2)",
          tension: 0.3,
          fill: true
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: true } }
      }
    });

    const topMois = [...normalized].sort((a, b) => b.total - a.total).slice(0, 5);
    document.getElementById("topMois").innerHTML = topMois.map((item, index) => `
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>${index + 1}. Mois ${item.mois}</span>
        <span class="badge text-bg-primary">${formatFCFA(item.total)}</span>
      </li>
    `).join("");
  } catch (error) {
    console.error("Erreur stats mensuelles:", error);
  }
}

chargerStatsGlobales();
chargerStatsMensuelles();
</script>
</body>
</html>

