<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin - Express Voyage</title>
<style>
  body{font-family:Arial;background:#f4f6f9;padding:20px}
  h2{text-align:center;margin-bottom:20px}
  table{width:100%;border-collapse:collapse;background:#fff}
  th,td{padding:12px;border:1px solid #ddd;text-align:center}
  th{background:#003366;color:#fff}
  button{padding:6px 12px;border:none;border-radius:4px;cursor:pointer}
  .valider{background:green;color:#fff}
</style>
</head>

<body>

<h2>Tableau de bord - Réservations</h2>

<table>
<tr>
  <th>Client</th>
  <th>Sièges</th>
  <th>Bus</th>
  <th>Montant</th>
  <th>Statut</th>
  <th>Action</th>
</tr>
<tbody id="liste"></tbody>
</table>

<script>
let reservations = JSON.parse(localStorage.getItem("reservations")) || [];
let seatStatus   = JSON.parse(localStorage.getItem("seatStatus")) || {};

function afficherAdmin(){
  let html="";

  if(reservations.length === 0){
    html = `<tr><td colspan="6">Aucune réservation</td></tr>`;
  }

  reservations.forEach((r,i)=>{
    html += `
      <tr>
        <td>${r.client}</td>
        <td>${r.seats.join(', ')}</td>
        <td>${r.busType.toUpperCase()}</td>
        <td>${r.total.toLocaleString()} FCFA</td>
        <td>${r.status}</td>
        <td>
          ${r.status === "EN ATTENTE" 
          ? `<button class="valider" onclick="valider(${i})">Valider</button>` 
          : "✔ Confirmé"}
        </td>
      </tr>
    `;
  });

  document.getElementById("liste").innerHTML = html;
}

function valider(i){
  reservations[i].status = "CONFIRMÉ";

  reservations[i].seats.forEach(seat => {
    seatStatus[seat] = "reserved";
  });

  localStorage.setItem("reservations", JSON.stringify(reservations));
  localStorage.setItem("seatStatus", JSON.stringify(seatStatus));

  afficherAdmin();
}

afficherAdmin();
</script>

</body>
</html>
