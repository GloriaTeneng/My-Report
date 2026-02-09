<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mon Ticket - Express Voyage</title>
<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

<style>
body{
  font-family: Arial;
  background:#f4f6f9;
  padding:20px;
}

.ticket{
  max-width:420px;
  margin:auto;
  background:white;
  border-radius:10px;
  padding:20px;
  box-shadow:0 4px 10px rgba(0,0,0,.1);
}

h2{text-align:center;color:#003366}

.line{
  margin:6px 0;
  font-size:15px;
}

#qrcode{
  display:flex;
  justify-content:center;
  margin-top:15px;
}

button{
  margin-top:15px;
  width:100%;
  padding:10px;
  border:none;
  border-radius:6px;
  background:#003366;
  color:white;
  font-size:15px;
  cursor:pointer;
}
</style>
</head>

<body>

<div class="ticket" id="ticket">
  <h2>🎫 Ticket électronique</h2>

  <div class="line"><b>Client :</b> <span id="client"></span></div>
  <div class="line"><b>Bus :</b> <span id="bus"></span></div>
  <div class="line"><b>Sièges :</b> <span id="seats"></span></div>
  <div class="line"><b>Montant :</b> <span id="total"></span></div>
  <div class="line"><b>Statut :</b> <span id="status"></span></div>

  <div id="qrcode"></div>

  <button onclick="window.print()">🖨 Imprimer le ticket</button>
</div>

<script>
let ticket = JSON.parse(localStorage.getItem("ticket"));

if(ticket){
  document.getElementById("client").textContent = ticket.client;
  document.getElementById("bus").textContent = ticket.busType.toUpperCase();
  document.getElementById("seats").textContent = ticket.seats.join(", ");
  document.getElementById("total").textContent = ticket.total.toLocaleString() + " FCFA";
  document.getElementById("status").textContent = ticket.status;

  new QRCode(document.getElementById("qrcode"), {
    text: JSON.stringify(ticket),
    width: 140,
    height: 140
  });
}
</script>

</body>
</html>
