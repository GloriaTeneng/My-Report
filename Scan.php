<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Scan QR Code - Express Voyage</title>

<script src="https://unpkg.com/html5-qrcode"></script>

<style>
body{
  font-family:Arial;
  background:#f4f6f9;
  padding:20px;
}

h2{text-align:center;color:#117a36}

#reader{
  width:300px;
  margin:20px auto;
}

.result{
  max-width:400px;
  margin:auto;
  background:white;
  padding:15px;
  border-radius:8px;
  box-shadow:0 4px 10px rgba(0,0,0,.1);
  display:none;
}

.line{margin:5px 0}
.valid{color:green;font-weight:bold}
.invalid{color:red;font-weight:bold}
</style>
</head>

<body>

<h2>📷 Scanner le QR Code</h2>

<div id="reader"></div>

<div class="result" id="resultBox">
  <h3>Résultat du scan</h3>
  <div class="line"><b>Client :</b> <span id="r_client"></span></div>
  <div class="line"><b>Bus :</b> <span id="r_bus"></span></div>
  <div class="line"><b>Sièges :</b> <span id="r_seats"></span></div>
  <div class="line"><b>Montant :</b> <span id="r_total"></span></div>
  <div class="line"><b>Statut :</b> <span id="r_status"></span></div>

  <div id="etat"></div>
</div>

<script>
function onScanSuccess(decodedText) {
  try {
    const ticket = JSON.parse(decodedText);

    document.getElementById("resultBox").style.display="block";

    document.getElementById("r_client").textContent = ticket.client;
    document.getElementById("r_bus").textContent = ticket.busType.toUpperCase();
    document.getElementById("r_seats").textContent = ticket.seats.join(", ");
    document.getElementById("r_total").textContent = ticket.total + " FCFA";
    document.getElementById("r_status").textContent = ticket.status;

    if(ticket.status === "CONFIRMÉ"){
      document.getElementById("etat").innerHTML =
        "<p class='valid'>✅ Ticket valide – Embarquement autorisé</p>";
    } else {
      document.getElementById("etat").innerHTML =
        "<p class='invalid'>❌ Ticket non valide</p>";
    }

  } catch {
    alert("QR Code invalide");
  }
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: 250 }
);

html5QrcodeScanner.render(onScanSuccess);
</script>

</body>
</html>
