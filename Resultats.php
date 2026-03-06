<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Résultats - Express Voyage</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="resultat.css">
</head>

<body>

<div class="container mt-5 mb-5">

<h4 class="text-primary mb-4">
<i class="bi bi-search"></i> Voyages disponibles
</h4>

<!-- LES VOYAGES SERONT AJOUTÉS ICI -->
<div id="voyagesContainer"></div>

</div>

<script>

async function chargerVoyages(){

const container = document.getElementById("voyagesContainer");

try{

const res = await fetch("http://localhost/PROJET/Back-end/api/get_voyages.php");
const voyages = await res.json();

container.innerHTML = "";

voyages.forEach(v => {

let type = v.PRIX_VIP ? "VIP" : "Classique";
let prix = v.PRIX_VIP ? v.PRIX_VIP : v.PRIX_CLASSIQUE;

let badgeType = type === "VIP" ? "bg-primary" : "bg-secondary";

let statutBadge = v.STATUT_VOYAGE === "disponible"
? '<span class="badge bg-success">Disponible</span>'
: '<span class="badge bg-danger">Complet</span>';

let bouton = v.STATUT_VOYAGE === "disponible"
? `<a href="details.php?id=${v.ID_VOYAGE}" class="btn btn-outline-primary btn-sm">Voir détails</a>`
: `<button class="btn btn-outline-secondary btn-sm" disabled>Indisponible</button>`;

let carte = `
<div class="card shadow mb-3">
<div class="card-body">

<div class="row align-items-center">

<div class="col-md-4">
<h6 class="mb-1">Trajet ${v.ID_TRAJET}</h6>

<small class="text-muted">
<i class="bi bi-calendar"></i> ${v.DATEDEPART}
<i class="bi bi-clock ms-2"></i> ${v.HEUREDEPART}
</small>
</div>

<div class="col-md-2 text-center">
<span class="badge ${badgeType}">${type}</span>
</div>

<div class="col-md-2 text-center">
<strong>${prix} FCFA</strong>
</div>

<div class="col-md-2 text-center">
${statutBadge}
</div>

<div class="col-md-2 text-end">
${bouton}
</div>

</div>
</div>
</div>
`;

container.innerHTML += carte;

});

}
catch(e){

container.innerHTML = "<p class='text-danger'>Erreur chargement voyages</p>";

console.error(e);

}

}

chargerVoyages();

</script>
</body>
</html>
