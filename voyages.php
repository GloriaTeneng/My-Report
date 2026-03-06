<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion Voyages</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Dashboard.css">

</head>

<body>

<div class="container mt-4">

<h3>Ajouter un voyage</h3>

<form id="voyageForm" class="row g-3">

<div class="col-md-2">
<input type="number" id="trajet" class="form-control" placeholder="ID trajet">
</div>

<div class="col-md-2">
<input type="date" id="date">
</div>

<div class="col-md-2">
<input type="time" id="heure">
</div>

<div class="col-md-2">
<input type="number" id="vip" placeholder="Prix VIP">
</div>

<div class="col-md-2">
<input type="number" id="classique" placeholder="Prix Classique">
</div>

<div class="col-md-2">
<button class="btn btn-primary">Ajouter</button>
</div>

</form>

<hr>

<table class="table table-bordered">

<thead>
<tr>
<th>ID</th>
<th>Trajet</th>
<th>Date</th>
<th>Heure</th>
<th>VIP</th>
<th>Classique</th>
</tr>
</thead>

<tbody id="listeVoyages"></tbody>

</table>

</div>

<script>

async function chargerVoyages(){

const res = await fetch("http://localhost/PROJET/Back-end/api/get_voyages.php");
const voyages = await res.json();

let html="";

voyages.forEach(v=>{

html += `
<tr>
<td>${v.ID_VOYAGE}</td>
<td>${v.ID_TRAJET}</td>
<td>${v.DATEDEPART}</td>
<td>${v.HEUREDEPART}</td>
<td>${v.PRIX_VIP}</td>
<td>${v.PRIX_CLASSIQUE}</td>
</tr>
`;

});

document.getElementById("listeVoyages").innerHTML = html;

}

chargerVoyages();


voyageForm.onsubmit = async (e)=>{

e.preventDefault();

const data = {
trajet: trajet.value,
date: date.value,
heure: heure.value,
vip: vip.value,
classique: classique.value
};

await fetch("http://localhost/PROJET/Back-end/api/add_voyage.php",{

method:"POST",
headers:{"Content-Type":"application/json"},
body:JSON.stringify(data)

});

chargerVoyages();

};

</script>

</body>
</html>