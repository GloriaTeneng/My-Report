<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Details du voyage - Express Voyage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <div class="container mt-5 mb-5">

  <h4 class="text-primary mb-4">
    <i class="bi bi-bus-front"></i> Details du voyage
    <small class="text-muted">(Trip details)</small>
  </h4>

  <div class="card shadow">
    <div class="card-body">

      <!-- Trajet -->
      <div class="section-title">Trajet</div>
      <div class="row">
        <div class="col-md-6 info-box">
          <i class="bi bi-geo-alt-fill text-primary"></i>
          <strong>Depart :</strong> <span id="detailDepart">-</span>
        </div>
        <div class="col-md-6 info-box">
          <i class="fa-solid fa-location-dot text-danger"></i>
          <strong>Destination :</strong> <span id="detailDestination">-</span>
        </div>
      </div>

      <!-- Date & Heure -->
      <div class="section-title mt-3">Horaire</div>
      <div class="row">
        <div class="col-md-6 info-box">
          <i class="bi bi-calendar-event"></i>
          <strong>Date :</strong> <span id="detailDate">-</span>
        </div>
        <div class="col-md-6 info-box">
          <i class="bi bi-clock"></i>
          <strong>Heure :</strong> <span id="detailHeure">-</span>
        </div>
      </div>

      <!-- Bus -->
      <div class="section-title mt-3">Bus</div>
      <div class="row">
        <div class="col-md-6 info-box">
          <strong>Type :</strong>
          <span id="detailType" class="badge badge-vip text-white">-</span>
        </div>
        <div class="col-md-6 info-box">
          <strong>Prix :</strong>
          <div id="detailPrix" class="price">-</div>
        </div>
      </div>

      <!-- Conditions -->
      <div class="section-title mt-4">Conditions</div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <i class="fa-regular fa-clock text-primary me-2"></i>
          Arriver 30 minutes avant
        </li>
        <li class="list-group-item">
          <i class="fa-regular fa-id-card text-primary me-2"></i>
          Piece d'identite obligatoire
        </li>
        <li class="list-group-item">
          <i class="fa-solid fa-suitcase text-primary me-2"></i>
          Bagages selon reglementation
        </li>
      </ul>

      <!-- Actions -->
      <div class="d-flex justify-content-between mt-4">
        <a href="resultats.php" class="btn btn-outline-secondary">
          <i class="bi bi-arrow-left"></i> Retour
        </a>
        <a href="sieges.php" id="btnSieges" class="btn btn-primary">
          Choisir un siege
        </a>
      </div>

    </div>
  </div>
</div>

<script>
  const params = new URLSearchParams(window.location.search);
  const voyageId = params.get("id");

  const depEl = document.getElementById("detailDepart");
  const destEl = document.getElementById("detailDestination");
  const dateEl = document.getElementById("detailDate");
  const heureEl = document.getElementById("detailHeure");
  const typeEl = document.getElementById("detailType");
  const prixEl = document.getElementById("detailPrix");
  const btnSieges = document.getElementById("btnSieges");

  async function chargerDetails() {
    if (!voyageId) {
      btnSieges.setAttribute("disabled", true);
      btnSieges.classList.add("disabled");
      return;
    }

    try {
      const res = await fetch("http://localhost/PROJET/Back-end/api/get_voyages.php");
      const voyages = await res.json();
      const v = Array.isArray(voyages) ? voyages.find(x => String(x.ID_VOYAGE) === String(voyageId)) : null;

      if (!v) {
        btnSieges.setAttribute("disabled", true);
        btnSieges.classList.add("disabled");
        return;
      }

      depEl.textContent = v.VILLE_DEPART || "-";
      destEl.textContent = v.VILLE_ARRIVE || "-";
      dateEl.textContent = v.DATEDEPART || "-";
      heureEl.textContent = v.HEUREDEPART || "-";
      const typeBus = v.TYPE_BUS || v.CATEGORIE || "CLASSIQUE";
      typeEl.textContent = String(typeBus).toUpperCase();
      prixEl.textContent = Number(v.COUT || 0).toLocaleString("fr-FR") + " FCFA";

      const selectedVoyage = {
        id: v.ID_VOYAGE,
        depart: v.VILLE_DEPART,
        destination: v.VILLE_ARRIVE,
        date: v.DATEDEPART,
        heure: v.HEUREDEPART,
        categorie: v.CATEGORIE,
        prix: v.COUT,
        busType: v.TYPE_BUS || v.CATEGORIE,
        capacite: v.CAPACITE_BUS
      };
      localStorage.setItem("selectedVoyage", JSON.stringify(selectedVoyage));

      btnSieges.href = "sieges.php?id=" + encodeURIComponent(v.ID_VOYAGE);
    } catch (e) {
      btnSieges.setAttribute("disabled", true);
      btnSieges.classList.add("disabled");
      console.error(e);
    }
  }

  chargerDetails();
</script>

</body>
</html>
