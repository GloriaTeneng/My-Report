<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mon Ticket - Express Voyage</title>

<!-- QR CODE -->
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

h2{text-align:center;color:#117a36}

.line{
  margin:6px 0;
  font-size:15px;
}

#qrcode{
  display:flex;
  justify-content:center;
  margin-top:15px;
}

.actions{
  display:flex;
  gap:10px;
}
button{
  margin-top:15px;
  width:100%;\r\n  flex:1;
  padding:10px;
  border:none;
  border-radius:6px;
  background:#117a36;
  color:white;
  font-size:15px;
  cursor:pointer;
}
</style>
</head>

<body>

<div class="ticket" id="ticket">
  <h2>Ticket électronique</h2>

  <div class="line"><b>Client :</b> <span id="client"></span></div>
  <div class="line"><b>Téléphone :</b> <span id="phone"></span></div>
  <div class="line"><b>Bus :</b> <span id="bus"></span></div>
  <div class="line"><b>Point de depart :</b> <span id="point_depart"></span></div>
  <div class="line"><b>Sièges :</b> <span id="seats"></span></div>
  <div class="line"><b>Montant :</b> <span id="total"></span></div>
  <div class="line"><b>Statut :</b> <span id="status"></span></div>

  <div id="qrcode"></div>

  <div class="actions">
    <button id="refreshBtn" type="button">Actualiser</button>
    <button onclick="window.print()" type="button">Imprimer le ticket</button>
  </div>
</div>

<script>
      const ticket = JSON.parse(localStorage.getItem("ticket"));

  if(!ticket){
    alert("Aucun ticket trouvé !");
    window.location.href = "accueil.html";
  }

  // On affiche les infos
  document.getElementById("client").textContent = ticket.client;
  document.getElementById("phone").textContent = ticket.telephone || "-";
  document.getElementById("bus").textContent = ticket.busType.toUpperCase();
  document.getElementById("point_depart").textContent = ticket.pointDepart || "-";
  document.getElementById("seats").textContent = ticket.seats.join(", ");
  document.getElementById("total").textContent = ticket.total.toLocaleString() + " FCFA";
  document.getElementById("status").textContent = ticket.status;

  function mapStatus(raw) {
    const value = String(raw || "").toLowerCase();
    if (value === "validee") return "CONFIRME";
    if (value === "utilisee") return "UTILISEE";
    return "EN ATTENTE";
  }

  const refreshBtn = document.getElementById("refreshBtn");
  if (refreshBtn) {
    refreshBtn.addEventListener("click", () => {
      loadReservationStatus();
    });
  }
  function renderQr(url) {
    if (!url) return;
    document.getElementById("qrcode").innerHTML = `<img src="${url}" width="140">`;
  }

  let statusPolling = null;

  async function loadReservationStatus() {
    try {
      const res = await fetch(`http://localhost/PROJET/Back-end/api/reservation.php?id=${encodeURIComponent(ticket.id)}`);
      const data = await res.json();

      if (!data || !data.success || !data.reservation) {
        return;
      }

      const reservation = data.reservation;
      const statusLabel = mapStatus(reservation.STATUT_RESERVATION);
      document.getElementById("status").textContent = statusLabel;
      ticket.status = statusLabel;
      localStorage.setItem("ticket", JSON.stringify(ticket));
      if (statusLabel !== "EN ATTENTE" && statusPolling) {
        clearInterval(statusPolling);
        statusPolling = null;
      }

      if (reservation.POINT_DEPART) {
        document.getElementById("point_depart").textContent = reservation.POINT_DEPART;
        ticket.pointDepart = reservation.POINT_DEPART;
        localStorage.setItem("ticket", JSON.stringify(ticket));
      }

      if (reservation.QR_RESERVATION) {
        renderQr(`http://localhost/PROJET/Back-end/qrcodes/${reservation.QR_RESERVATION}`);
        return;
      }

      if (reservation.STATUT_RESERVATION === "validee" || reservation.STATUT_RESERVATION === "utilisee") {
        const qrRes = await fetch("http://localhost/PROJET/Back-end/api/generate_qr.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            reservation: ticket.id,
            client: ticket.client,
            voyage: ticket.voyage
          })
        });
        const qrData = await qrRes.json();
        if (qrData.success) {
          renderQr(qrData.qr_url);
        }
        return;
      }

      document.getElementById("qrcode").textContent = "QR disponible apres validation.";
    } catch (e) {
      console.error(e);
    }
  }

  loadReservationStatus();
  statusPolling = setInterval(loadReservationStatus, 5000);

</script>

</body>
</html>






