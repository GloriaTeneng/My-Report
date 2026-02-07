<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Réservation</title>
</head>
<body>

<h2>Réserver votre siège</h2>

<select id="siege">
  <option>A1</option>
  <option>A2</option>
  <option>A3</option>
</select>

<button onclick="reserver()">Réserver</button>

<p id="message"></p>

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



</script>
</body>
</html>
