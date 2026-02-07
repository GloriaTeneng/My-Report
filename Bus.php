<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion des bus</title>
<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
}
.container{
    max-width:900px;
    margin:auto;
    background:#fff;
    padding:20px;
    border-radius:8px;
}
input,select,button{
    padding:10px;
    margin:5px 0;
    width:100%;
}
table{
    width:100%;
    border-collapse: collapse;
    margin-top:20px;
}
th,td{
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}
th{
    background:#2563eb;
    color:white;
}
button{
    background:#2563eb;
    color:white;
    border:none;
    border-radius:5px;
}
</style>
</head>
<body>

<div class="container">
<h2>Gestion des bus</h2>

<form id="busForm">
    <input type="text" id="numero" placeholder="Numéro du bus" required>

    <select id="type" required>
        <option value="">-- Type du bus --</option>
        <option value="VIP">VIP</option>
        <option value="CLASSIQUE">Classique</option>
    </select>

    <input type="number" id="rangees" placeholder="Nombre de rangées" required>

    <button>Ajouter</button>
</form>

<table>
<thead>
<tr>
<th>N°</th>
<th>Type</th>
<th>Rangées</th>
<th>Config</th>
<th>Capacité</th>
<th>Action</th>
</tr>
</thead>
<tbody id="busTable"></tbody>
</table>

</div>

<script>
let busList = [];

document.getElementById("busForm").addEventListener("submit", e => {
    e.preventDefault();

    let numero = numero.value;
    let type = type.value;
    let rangees = parseInt(rangees.value);

    let config = type === "VIP" ? "2-2" : "3-2";
    let capacite = type === "VIP" ? rangees * 4 : rangees * 5;

    busList.push({numero, type, rangees, config, capacite});

    afficherBus();
    e.target.reset();
});

function afficherBus(){
    let html="";
    busList.forEach((b,i)=>{
        html+=`
        <tr>
            <td>${b.numero}</td>
            <td>${b.type}</td>
            <td>${b.rangees}</td>
            <td>${b.config}</td>
            <td>${b.capacite}</td>
            <td><button onclick="supprimer(${i})">🗑</button></td>
        </tr>`;
    })
    busTable.innerHTML = html;
}

function supprimer(i){
    if(confirm("Supprimer ce bus ?")){
        busList.splice(i,1);
        afficherBus();
    }
}

function genererSieges(bus){
    let sieges = [];
    let lettre = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    for(let r=0; r<bus.rangees; r++){
        let ligne = lettre[r];

        let nb = bus.type==="VIP" ? [2,2] : [3,2];

        let compteur = 1;

        nb.forEach(n=>{
            for(let i=0;i<n;i++){
                sieges.push({
                    numero: ligne+compteur,
                    reserve:false
                });
                compteur++;
            }
        });
    }

    return sieges;
}

</script>

</body>
</html>
