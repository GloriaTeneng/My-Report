<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Admin</title>
</head>
<body>

<h2>Tableau de bord Admin</h2>

<table border ="1">
<tr><th>Client</th><th>Siège</th><th>Statut</th><th>Action</th></tr>
<tbody id="liste"></tbody>
</table>

<script src="script.js">

     let reservations = JSON.parse(localStorage.getItem("reservations")) || [];

function reserver(){
    let siege = document.getElementById("siege").value;

    reservations.push({
        client: "Client",
        siege: siege,
        statut: "EN ATTENTE"
    });

    localStorage.setItem("reservations", JSON.stringify(reservations));

    document.getElementById("message").innerText =
      "Réservation enregistrée. En attente de validation.";
}

function afficherAdmin(){
    let html="";
    reservations.forEach((r,i)=>{
        html+=`
        <tr>
            <td>${r.client}</td>
            <td>${r.siege}</td>
            <td>${r.statut}</td>
            <td>
                ${r.statut==="EN ATTENTE" 
                ? `<button onclick="valider(${i})">Valider</button>` 
                : "✔"}
            </td>
        </tr>`;
    });
    document.getElementById("liste").innerHTML=html;
}

function valider(i){
    reservations[i].statut="CONFIRMÉ";
    localStorage.setItem("reservations",JSON.stringify(reservations));
    afficherAdmin();
}

</script>
<script>afficherAdmin()</script>
</body>
</html>
