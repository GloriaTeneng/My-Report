<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion des trajets - Express Voyage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="Dashboard.css">
  <style>
    .action-btn {
      width: 36px;
      height: 36px;
      padding: 0;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
<body>
<div class="d-flex">
  <div class="sidebar p-3">
    <h4 class="text-white text-center">Express Voyage</h4>
    <hr class="text-light">
    <ul class="nav flex-column">
      <li class="nav-item"><a href="Dashboard.php" class="nav-link text-white"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
      <li class="nav-item"><a href="Bus.php" class="nav-link text-white"><i class="bi bi-bus-front"></i> Bus</a></li>
      <li class="nav-item"><a href="Trajets.php" class="nav-link text-white active"><i class="bi bi-geo-alt"></i> Trajets</a></li>
      <li class="nav-item"><a href="voyages.php" class="nav-link text-white"><i class="bi bi-calendar-event"></i> Voyages</a></li>
      <li class="nav-item"><a href="reservations.php" class="nav-link text-white"><i class="bi bi-ticket"></i> Reservations</a></li>
      <li class="nav-item"><a href="Paiements.php" class="nav-link text-white"><i class="bi bi-credit-card"></i> Paiements</a></li>
      <li class="nav-item"><a href="Scan.php" class="nav-link text-white"><i class="bi bi-qr-code-scan"></i> Scanner QR</a></li>
      <li class="nav-item"><a href="Stats.php" class="nav-link text-white"><i class="bi bi-bar-chart"></i> Statistiques</a></li>
    </ul>
  </div>

  <div class="main-content flex-fill">
    <div class="header shadow-sm p-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Gestion des trajets</h5>
      <span class="fw-bold">Admin</span>
    </div>

    <div class="container-fluid mt-4">
      <div class="card">
        <div class="card-header bg-primary text-white">Ajouter / Modifier un trajet</div>
        <div class="card-body">
          <form id="trajetForm" class="row g-3">
            <div class="col-md-4">
              <input type="text" id="depart" class="form-control" placeholder="Ville de depart" required>
            </div>
            <div class="col-md-4">
              <input type="text" id="arrivee" class="form-control" placeholder="Ville d'arrivee" required>
            </div>
            <div class="col-md-4">
              <input type="text" id="distance" class="form-control" placeholder="Distance (ex: 300km)">
            </div>
            <div class="col-md-4">
              <input type="time" id="duree" class="form-control" placeholder="Duree estimee">
            </div>
            <div class="col-md-4">
              <input type="number" id="cout" class="form-control" placeholder="Cout" required>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary" id="submitBtn">Ajouter le trajet</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-header bg-primary text-white">Liste des trajets</div>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Depart</th>
                <th>Arrivee</th>
                <th>Distance</th>
                <th>Duree</th>
                <th>Cout</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="trajetTable"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
const API_BASE = "http://localhost/PROJET/Back-end/api";
let editId = null;

const trajetForm = document.getElementById("trajetForm");
const submitBtn = document.getElementById("submitBtn");

function formatFCFA(value) {
  return Number(value || 0).toLocaleString("fr-FR") + " FCFA";
}

async function chargerTrajets() {
  try {
    const res = await fetch(API_BASE + "/get_trajets.php");
    const trajets = await res.json();
    const tbody = document.getElementById("trajetTable");

    if (!Array.isArray(trajets) || trajets.length === 0) {
      tbody.innerHTML = '<tr><td colspan="7" class="text-center py-3">Aucun trajet pour le moment.</td></tr>';
      return;
    }

    tbody.innerHTML = trajets.map((t) => `
      <tr>
        <td>${t.ID_TRAJET ?? "-"}</td>
        <td>${t.VILLE_DEPART ?? "-"}</td>
        <td>${t.VILLE_ARRIVE ?? "-"}</td>
        <td>${t.DISTANCE_TRAJET ?? "-"}</td>
        <td>${t.DUREE_ESTIMEE ? String(t.DUREE_ESTIMEE).slice(0,5) : "-"}</td>
        <td>${formatFCFA(t.COUT)}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary action-btn" onclick="modifier('${t.ID_TRAJET}')" title="Modifier">
            <i class="bi bi-pencil"></i>
          </button>
          <button class="btn btn-sm btn-outline-danger action-btn" onclick="supprimer('${t.ID_TRAJET}')" title="Supprimer">
            <i class="bi bi-trash"></i>
          </button>
        </td>
      </tr>
    `).join("");
  } catch (error) {
    console.error("Erreur chargement trajets:", error);
  }
}

trajetForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  const data = {
    id: editId,
    depart: document.getElementById("depart").value,
    arrivee: document.getElementById("arrivee").value,
    distance: document.getElementById("distance").value,
    duree: document.getElementById("duree").value,
    cout: document.getElementById("cout").value
  };

  try {
    const url = editId ? "/update_trajet.php" : "/add_trajet.php";
    const res = await fetch(API_BASE + url, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    });
    const result = await res.json();

    if (result.success) {
      trajetForm.reset();
      editId = null;
      submitBtn.textContent = "Ajouter le trajet";
      chargerTrajets();
      return;
    }
    alert(result.message || "Erreur");
  } catch (error) {
    console.error("Erreur ajout/modif trajet:", error);
  }
});

async function modifier(id) {
  try {
    const res = await fetch(API_BASE + "/get_trajets.php");
    const trajets = await res.json();
    const t = trajets.find((x) => x.ID_TRAJET === id);
    if (!t) return;

    document.getElementById("depart").value = t.VILLE_DEPART ?? "";
    document.getElementById("arrivee").value = t.VILLE_ARRIVE ?? "";
    document.getElementById("distance").value = t.DISTANCE_TRAJET ?? "";
    document.getElementById("duree").value = t.DUREE_ESTIMEE ? String(t.DUREE_ESTIMEE).slice(0,5) : "";
    document.getElementById("cout").value = t.COUT ?? "";
    editId = id;
    submitBtn.textContent = "Mettre a jour le trajet";
  } catch (error) {
    console.error("Erreur modification trajet:", error);
  }
}

async function supprimer(id) {
  if (!confirm("Supprimer ce trajet ?")) return;
  try {
    const res = await fetch(API_BASE + "/delete_trajet.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id })
    });
    const result = await res.json();
    if (result.success) {
      if (editId === id) {
        editId = null;
        trajetForm.reset();
        submitBtn.textContent = "Ajouter le trajet";
      }
      chargerTrajets();
      return;
    }
    alert(result.message || "Erreur suppression");
  } catch (error) {
    console.error("Erreur suppression trajet:", error);
  }
}

chargerTrajets();
</script>
</body>
</html>
