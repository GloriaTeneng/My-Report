
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion Bus - Express Voyage</title>
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
      <li class="nav-item"><a href="Bus.php" class="nav-link text-white active"><i class="bi bi-bus-front"></i> Bus</a></li>
      <li class="nav-item"><a href="Trajets.php" class="nav-link text-white"><i class="bi bi-geo-alt"></i> Trajets</a></li>      <li class="nav-item"><a href="voyages.php" class="nav-link text-white"><i class="bi bi-calendar-event"></i> Voyages</a></li>
      <li class="nav-item"><a href="reservations.php" class="nav-link text-white"><i class="bi bi-ticket"></i> Reservations</a></li>
      <li class="nav-item"><a href="Paiements.php" class="nav-link text-white"><i class="bi bi-credit-card"></i> Paiements</a></li>
      <li class="nav-item"><a href="Scan.php" class="nav-link text-white"><i class="bi bi-qr-code-scan"></i> Scanner QR</a></li>
      <li class="nav-item"><a href="Stats.php" class="nav-link text-white"><i class="bi bi-bar-chart"></i> Statistiques</a></li>
    </ul>
  </div>

  <div class="main-content flex-fill">    <div class="header shadow-sm p-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Gestion des bus</h5>
      <span class="fw-bold">Admin</span>
    </div>

    <div class="container-fluid mt-4">
      <div class="card">
        <div class="card-header bg-primary text-white">Ajouter un bus</div>
        <div class="card-body">
          <form id="busForm" class="row g-3">
            <div class="col-md-4">
              <input type="number" id="matricule" class="form-control" placeholder="Matricule bus" required>
            </div>
            <div class="col-md-4">
              <input type="text" id="numero" class="form-control" placeholder="Numero bus" required>
            </div>
            <div class="col-md-4">
              <select id="type" class="form-select" required>
                <option value="VIP">VIP</option>
                <option value="Classique">Classique</option>
              </select>
            </div>
            <div class="col-md-4">
              <input type="number" id="capacite" class="form-control" placeholder="Capacite" required>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-header bg-primary text-white">Liste des bus</div>
       <div class="table-responsive">
         <table class="table table-bordered table-hover align-middle mb-0">
           <thead class="table-light">
             <tr>               <th>ID</th>
                <th>Numero</th>
                <th>Type</th>
                <th>Capacite</th>
                <th>Voyage</th>
              </tr>
            </thead>
            <tbody id="listeBus"></tbody>
          </table>        </div>
      </div>
    </div>
  </div>
</div>

<script>
const API_BASE = "http://localhost/PROJET/Back-end/api";

async function chargerBus() {
  try {
    const res = await fetch(API_BASE + "/get_bus.php");
    const bus = await res.json();
    const tbody = document.getElementById("listeBus");

    if (!Array.isArray(bus) || bus.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" class="text-center py-3">Aucun bus trouve.</td></tr>';
      return;
    }

    tbody.innerHTML = bus.map((b) => `
      <tr>
        <td>${b.MATRICULE_BUS ?? "-"}</td>
        <td>${b.NUMERO_BUS ?? "-"}</td>
        <td>${b.TYPE_BUS ?? "-"}</td>
        <td>${b.CAPACITE_BUS ?? "-"}</td>
        <td>${b.ID_VOYAGE ?? "-"}</td>
      </tr>
    `).join("");
  } catch (error) {
    console.error("Erreur chargement bus:", error);
  }
}
document.getElementById("busForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const data = {
    type: document.getElementById("type").value,
    matricule: document.getElementById("matricule").value,
    numero: document.getElementById("numero").value,
    type: document.getElementById("type").value,
    capacite: document.getElementById("capacite").value,
  };
  try {
   await fetch(API_BASE + "/add_bus.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    });
    e.target.reset();
    chargerBus();
  } catch (error) {
    console.error("Erreur ajout bus:", error);
  }
});

chargerBus();
</script>
</body>
</html>
