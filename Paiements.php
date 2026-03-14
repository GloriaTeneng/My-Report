<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Paiements - Express Voyage</title>
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
      <li class="nav-item"><a href="Paiements.php" class="nav-link text-white active"><i class="bi bi-credit-card"></i> Paiements</a></li>
      <li class="nav-item"><a href="Scan.php" class="nav-link text-white"><i class="bi bi-qr-code-scan"></i> Scanner QR</a></li>
      <li class="nav-item"><a href="Stats.php" class="nav-link text-white"><i class="bi bi-bar-chart"></i> Statistiques</a></li>
    </ul>
  </div>

  <div class="main-content flex-fill">
    <div class="header shadow-sm p-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Historique des paiements</h5>
      <span class="fw-bold">Admin</span>
    </div>

    <div class="container-fluid mt-4">
      <div class="row g-3">
        <div class="col-md-4"><div class="card stat-card"><h6>Total paiements</h6><h2 id="countPaiements">0</h2></div></div>
        <div class="col-md-4"><div class="card stat-card"><h6>Montant total</h6><h2 id="sumPaiements">0 FCFA</h2></div></div>
        <div class="col-md-4"><div class="card stat-card"><h6>Moyenne paiement</h6><h2 id="avgPaiements">0 FCFA</h2></div></div>
      </div>

      <div class="card mt-4">
        <div class="card-header bg-primary text-white">Liste des paiements</div>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Reference</th>
                <th>Reservation</th>
                <th>Moyen</th>
                <th>Date</th>
                <th>Montant</th>
              </tr>
            </thead>
            <tbody id="listePaiements"></tbody>
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

function formatDate(dateValue) {
  if (!dateValue) return "-";
  const date = new Date(dateValue);
  if (Number.isNaN(date.getTime())) return dateValue;
  return date.toLocaleDateString("fr-FR");
}

async function chargerPaiements() {
  try {
    const res = await fetch(API_BASE + "/paiements_list.php");
    const data = await res.json();
    const tbody = document.getElementById("listePaiements");

    if (!data.success || !Array.isArray(data.paiements) || data.paiements.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" class="text-center py-3">Aucun paiement trouve.</td></tr>';
      return;
    }

    let total = 0;
    tbody.innerHTML = data.paiements.map((p) => {
      const montant = Number(p.MONTANT_PAIEMENT || 0);
      total += montant;
      return `
        <tr>
          <td>${p.REFERENCE_PAIEMENT}</td>
          <td>${p.RES_ID_RESERVATION ?? "-"}</td>
          <td>${p.MOYEN_PAIEMENT ?? "-"}</td>
          <td>${formatDate(p.DATE_PAIEMENT)}</td>
          <td>${formatFCFA(montant)}</td>
        </tr>
      `;
    }).join("");

    const count = data.paiements.length;
    document.getElementById("countPaiements").textContent = count.toLocaleString("fr-FR");
    document.getElementById("sumPaiements").textContent = formatFCFA(total);
    document.getElementById("avgPaiements").textContent = formatFCFA(count ? total / count : 0);
  } catch (error) {
    console.error("Erreur paiements:", error);
  }
}

chargerPaiements();
</script>
</body>
</html>
