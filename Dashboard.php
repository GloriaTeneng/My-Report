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
  <li class="nav-item">
    <a href="Dashboard.php" class="nav-link text-white active">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>
  </li>

  <li class="nav-item">
    <a href="Bus.php" class="nav-link text-white">
      <i class="bi bi-bus-front"></i> Bus
    </a>
  </li>

  <li class="nav-item">
    <a href="Trajets.php" class="nav-link text-white">
      <i class="bi bi-geo-alt"></i> Trajets
    </a>
  </li>

  <li class="nav-item">
    <a href="voyages.php" class="nav-link text-white">
      <i class="bi bi-calendar-event"></i> Voyages
    </a>
  </li>

  <li class="nav-item">
    <a href="reservations.php" class="nav-link text-white">
      <i class="bi bi-ticket"></i> Réservations
    </a>
  </li>

  <li class="nav-item">
    <a href="Paiements.php" class="nav-link text-white">
      <i class="bi bi-credit-card"></i> Paiements
    </a>
  </li>

  <li class="nav-item">
    <a href="Scan.php" class="nav-link text-white">
      <i class="bi bi-qr-code-scan"></i> Scanner QR
    </a>
  </li>

  <li class="nav-item">
    <a href="Stats.php" class="nav-link text-white">
      <i class="bi bi-bar-chart"></i> Statistiques
    </a>
  </li>
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
            <h2 id="totalReservations">0</h2>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card stat-card">
            <h6>Recettes</h6>
            <h2 id="totalRecettes">0 FCFA</h2>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card stat-card">
            <h6>Voyages</h6>
            <h2 id="totalVoyages">0</h2>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card stat-card">
            <h6>Places restantes</h6>
            <h2 id="totalPlaces">0</h2>
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

            <tbody id="listeReservations">
              <!-- Les réservations en attente seront injectées ici via JS -->
            </tbody>
          </table>
        </div>
      </div>

    </div>

  </div>
</div>

<script>
fetch("http://localhost/PROJET/Back-end/api/dashboard_stats.php")
.then(res => res.json())
.then(data => {
  if(data.success){
    document.getElementById("totalReservations").textContent = data.reservations;
    document.getElementById("totalRecettes").textContent = 
        data.recettes.toLocaleString() + " FCFA";
    document.getElementById("totalVoyages").textContent = data.voyages;
    document.getElementById("totalPlaces").textContent = data.places;
  }
});

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="recetteChart" width="400" height="150"></canvas>

</script>

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

animateCount("totalReservations", 0, 128, 1200);
animateCount("totalRecettes", 0, 16, 1200);
animateCount("totalVoyages", 0, 16, 1200);
animateCount("totalPlaces", 0, 230, 1200);

// Validation réservation
function valider(btn) {
  let row = btn.closest("tr");
  row.querySelector("td:nth-child(5)").innerHTML =
    '<span class="badge bg-success">Confirmée</span>';
  btn.remove();

  alert("Réservation validée avec succès !");
}

</script>

<script>
fetch("http://localhost/PROJET/Back-end/api/reservations_attente.php")
.then(res => res.json())
.then(data => {
  if(data.success){

    let html = "";

    data.reservations.forEach(r => {
      html += `
        <tr>
          <td>${r.ID_RESERVATION}</td>
          <td>${r.TRAJET}</td>
          <td>${r.SIEGES_RESERVATION}</td>
          <td>${r.MONTANT_TOTAL.toLocaleString()} FCFA</td>
          <td><span style="color:orange;">En attente</span></td>
          <td>
            <button onclick="valider(${r.ID_RESERVATION})">
              Valider
            </button>
          </td>
        </tr>
      `;
    });

    document.getElementById("listeReservations").innerHTML = html;
  }
});
</script>

<!-- script de la fonction valider -->
<script>
function valider(id){
  fetch("http://localhost/PROJET/Back-end/api/valider_reservation.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: id })
  })
  .then(res => res.json())
  .then(data => {
    if(data.success){
      alert("Réservation validée !");
      location.reload();
    } else {
      alert("Erreur !");
    }
  });
}

fetch("http://localhost/PROJET/Back-end/api/stats_mensuelles.php")
.then(res=>res.json())
.then(data=>{

  const labels = data.map(d=>"Mois "+d.mois);
  const totals = data.map(d=>d.total);

  new Chart(document.getElementById("recetteChart"), {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: "Recettes mensuelles",
        data: totals
      }]
    }
  });

});
</script>
</body>
</html>
