<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion Bus</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Dashboard.css">
</head>

<body>

<div class="container mt-4">

<h3>Gestion des Bus</h3>

<form id="busForm" class="row g-3">

<div class="col-md-3">
<input type="text" id="numero" class="form-control" placeholder="Numéro Bus" required>
</div>

<div class="col-md-3">
<select id="type" class="form-control">
<option value="VIP">VIP</option>
<option value="Classique">Classique</option>
</select>
</div>

<div class="col-md-3">
<input type="number" id="capacite" class="form-control" placeholder="Capacité">
</div>

<div class="col-md-3">
<button class="btn btn-primary">Ajouter</button>
</div>

</form>

<hr>

<table class="table table-bordered">

<thead>
<tr>
<th>ID</th>
<th>Numero</th>
<th>Type</th>
<th>Capacité</th>
</tr>
</thead>

<tbody id="listeBus"></tbody>

</table>

</div>

<script>

async function chargerBus(){

const res = await fetch("http://localhost/PROJET/Back-end/api/get_bus.php");
const bus = await res.json();

let html = "";

bus.forEach(b=>{

html += `
<tr>
<td>${b.MATRICULE_BUS}</td>
<td>${b.NUMERO_BUS}</td>
<td>${b.TYPE_BUS}</td>
<td>${b.CAPACITE_BUS}</td>
</tr>
`;

});

document.getElementById("listeBus").innerHTML = html;

}

chargerBus();


document.getElementById("busForm").onsubmit = async (e)=>{

e.preventDefault();

const data = {
numero: numero.value,
type: type.value,
capacite: capacite.value
};

await fetch("http://localhost/PROJET/Back-end/api/add_bus.php",{

method:"POST",
headers:{"Content-Type":"application/json"},
body:JSON.stringify(data)

});

chargerBus();

};

</script>

</body>
</html>