<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion des voyages - Express Voyage</title>
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
      <li class="nav-item"><a href="voyages.php" class="nav-link text-white active"><i class="bi bi-calendar-event"></i> Voyages</a></li>
      <li class="nav-item"><a href="reservations.php" class="nav-link text-white"><i class="bi bi-ticket"></i> Reservations</a></li>
      <li class="nav-item"><a href="Paiements.php" class="nav-link text-white"><i class="bi bi-credit-card"></i> Paiements</a></li>
      <li class="nav-item"><a href="Scan.php" class="nav-link text-white"><i class="bi bi-qr-code-scan"></i> Scanner QR</a></li>
      <li class="nav-item"><a href="Stats.php" class="nav-link text-white"><i class="bi bi-bar-chart"></i> Statistiques</a></li>
    </ul>
  </div>

  <div class="main-content flex-fill">
    <div class="header shadow-sm p-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Gestion des voyages</h5>
      <span class="fw-bold">Admin</span>
    </div>

    <div class="container-fluid mt-4">
      <div class="card">
        <div class="card-header bg-primary text-white">Ajouter un voyage</div>
        <div class="card-body">
          <form id="voyageForm" class="row g-3">
            <div class="col-md-4">
              <select id="trajet" class="form-select" required>
                <option value=""> Choisir un trajet </option>
              </select>
            </div>
            <div class="col-md-4">
              <select id="bus" class="form-select" required>
                <option value="">-- Choisir un bus --</option>
              </select>
            </div>
            <div class="col-md-4">
              <input type="number" id="chauffeur" class="form-control" placeholder="CNI chauffeur" required>
            </div>
            <div class="col-md-3">
              <input type="date" id="date" class="form-control" required>
            </div>
            <div class="col-md-3">
              <input type="time" id="heure_depart" class="form-control" required>
            </div>
            <div class="col-md-3">
              <input type="time" id="heure_arrivee" class="form-control">
            </div>
            <div class="col-md-3">
              <select id="categorie" class="form-select">
                <option value="">-- Categorie --</option>
                <option value="VIP">VIP</option>
                <option value="CLASSIQUE">Classique</option>
              </select>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-header bg-primary text-white">Liste des voyages</div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Trajet</th>
                <th>Date</th>
                <th>Depart</th>
                <th>Arrivee</th>
                <th>Bus</th>
                <th>Chauffeur</th>
                <th>Categorie</th>
                <th>Statut</th>
              </tr>
            </thead>
            <tbody id="listeVoyages"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
const API_BASE = "http://localhost/PROJET/Back-end/api";
const voyageForm = document.getElementById("voyageForm");
const trajetSelect = document.getElementById("trajet");
const busSelect = document.getElementById("bus");

async function chargerTrajets() {
  try {
    const res = await fetch(API_BASE + "/get_trajets.php");
    const trajets = await res.json();
    trajetSelect.innerHTML = '<option value="">-- Choisir un trajet --</option>';
    if (!Array.isArray(trajets)) return;

    trajetSelect.innerHTML += trajets.map((t) => {
      const label = `${t.ID_TRAJET} | ${t.VILLE_DEPART ?? "-"} - ${t.VILLE_ARRIVE ?? "-"} | ${Number(t.COUT || 0).toLocaleString("fr-FR")} FCFA`;
      return `<option value="${t.ID_TRAJET}">${label}</option>`;
    }).join("");
  } catch (error) {
    console.error("Erreur chargement trajets:", error);
  }
}

async function chargerBus() {
  try {
    const res = await fetch(API_BASE + "/get_bus.php");
    const bus = await res.json();
    busSelect.innerHTML = '<option value="">-- Choisir un bus --</option>';
    if (!Array.isArray(bus)) return;
  const disponibles = bus.filter((b) => {
      return b.ID_VOYAGE === null || b.ID_VOYAGE === "" || b.ID_VOYAGE === "0" || b.ID_VOYAGE === 0;
    });
    busSelect.innerHTML += disponibles.map((b) => {
      const label = `${b.MATRICULE_BUS} | ${b.NUMERO_BUS ?? "-"} ${b.TYPE_BUS ? "(" + b.TYPE_BUS + ")" : ""}`;
      return `<option value="${b.MATRICULE_BUS}">${label}</option>`;
    }).join("");
  } catch (error) {
    console.error("Erreur chargement bus:", error);
  }
}

async function chargerVoyages() {
  try {
    const res = await fetch(API_BASE + "/get_voyages.php");
    const voyages = await res.json();
    const tbody = document.getElementById("listeVoyages");

    if (!Array.isArray(voyages) || voyages.length === 0) {
      tbody.innerHTML = '<tr><td colspan="9" class="text-center py-3">Aucun voyage trouve.</td></tr>';
      return;
    }

    tbody.innerHTML = voyages.map((v) => {
      const trajetLabel = v.VILLE_DEPART && v.VILLE_ARRIVE
        ? `${v.VILLE_DEPART} - ${v.VILLE_ARRIVE}`
        : (v.ID_TRAJET ?? "-");
      const busLabel = v.NUMERO_BUS ? `${v.NUMERO_BUS} (${v.TYPE_BUS ?? "-"})` : (v.MATRICULE_BUS ?? "-");
      return `
        <tr>
          <td>${v.ID_VOYAGE ?? "-"}</td>
          <td>${trajetLabel}</td>
          <td>${v.DATEDEPART ?? "-"}</td>
          <td>${v.HEUREDEPART ?? "-"}</td>
          <td>${v.HEURE_ARRIVEE ?? "-"}</td>
          <td>${busLabel}</td>
          <td>${v.NUMCNI_CHAUFFEUR ?? "-"}</td>
          <td>${v.CATEGORIE ?? "-"}</td>
          <td>${v.STATUT_VOYAGE ?? "-"}</td>
        </tr>
      `;
    }).join("");
  } catch (error) {
    console.error("Erreur chargement voyages:", error);
  }
}

voyageForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const data = {
    trajet: trajetSelect.value,
    bus: busSelect.value,
    chauffeur: document.getElementById("chauffeur").value,
    date: document.getElementById("date").value,
    heure_depart: document.getElementById("heure_depart").value,
    heure_arrivee: document.getElementById("heure_arrivee").value,
    categorie: document.getElementById("categorie").value
  };

  try {
    const res = await fetch(API_BASE + "/add_voyage.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    });
    const result = await res.json();

    if (result.success) {
      alert("Voyage ajoute.");
      voyageForm.reset();
       await Promise.all([chargerVoyages(), chargerBus()]);
      return;
    }
    alert(result.message || "Erreur ajout.");
  } catch (error) {
    console.error("Erreur ajout voyage:", error);
  }
});

chargerTrajets();
chargerBus();
chargerVoyages();
</script>
</body>
</html>