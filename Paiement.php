<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Paiement - Express Voyage</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="container mt-5 mb-5">

  <h4 class="text-primary mb-4">
    <i class="bi bi-credit-card"></i> Paiement securise
    <small class="text-muted">(Secure payment)</small>
  </h4>

  <div class="row">

    <!-- RECAPITULATIF -->
    <div class="col-md-5 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Recapitulatif</h5>
          <hr>

          <p><strong>Trajet :</strong> <span id="recapTrajet">-</span></p>
          <p><strong>Point de depart :</strong> <span id="recapPointDepart">-</span></p>
          <p><strong>Date :</strong> <span id="recapDate">-</span></p>
          <p><strong>Heure :</strong> <span id="recapHeure">-</span></p>
          <p><strong>Bus :</strong> <span id="recapBus">-</span></p>
          <p><strong>Sieges :</strong> <span id="recapSeats">-</span></p>

          <hr>
          <h5 class="text-primary">Total : <span id="recapTotal">0</span> FCFA</h5>
        </div>
      </div>
    </div>

    <!-- MOYENS DE PAIEMENT -->
    <div class="col-md-7">
      <div class="card shadow-sm">
        <div class="card-body">

          <h5 class="mb-3">Choisissez un moyen de paiement</h5>
          <hr>

          <form id="paymentForm">

            <!-- MTN MOMO -->
            <div class="form-check border rounded p-3 mb-3">
              <input class="form-check-input" type="radio" name="payment" id="mtn" checked>
              <label class="form-check-label fw-medium" for="mtn">
                <i class="bi bi-phone text-warning"></i>
                MTN Mobile Money
              </label>
            </div>

            <!-- ORANGE MONEY -->
            <div class="form-check border rounded p-3 mb-3">
              <input class="form-check-input" type="radio" name="payment" id="orange">
              <label class="form-check-label fw-medium" for="orange">
                <i class="bi bi-phone text-danger"></i>
                Orange Money
              </label>
            </div>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary btn-lg">
                Payer et confirmer la reservation
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>

</div>

<script>
  const draft = JSON.parse(localStorage.getItem("reservationDraft") || "null");
  const user = JSON.parse(localStorage.getItem("user") || "null");

  const trajetEl = document.getElementById("recapTrajet");
  const pointDepartEl = document.getElementById("recapPointDepart");
  const dateEl = document.getElementById("recapDate");
  const heureEl = document.getElementById("recapHeure");
  const busEl = document.getElementById("recapBus");
  const seatsEl = document.getElementById("recapSeats");
  const totalEl = document.getElementById("recapTotal");
  const paymentForm = document.getElementById("paymentForm");

  if (!draft) {
    alert("Aucune reservation en cours.");
    window.location.href = "resultats.php";
  }

  if (!user || !user.id) {
    alert("Veuillez vous connecter avant de payer.");
    window.location.href = "Accueil.html";
  }

  if (draft) {
    trajetEl.textContent = (draft.depart && draft.destination) ? (draft.depart + " -> " + draft.destination) : "-";
    pointDepartEl.textContent = draft.pointDepart || "-";
    dateEl.textContent = draft.dateVoyage || "-";
    heureEl.textContent = draft.heure || "-";
    busEl.textContent = draft.busType ? draft.busType.toUpperCase() : "-";
    seatsEl.textContent = Array.isArray(draft.seats) ? draft.seats.join(", ") : "-";
    totalEl.textContent = Number(draft.total || 0).toLocaleString("fr-FR");
  }

  paymentForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (!draft || !user) return;

    const payload = {
      id_voyage: draft.voyageId,
      numcni_client: user.id,
      sieges: Array.isArray(draft.seats) ? draft.seats.join(",") : "",
      point_depart: draft.pointDepart || "",
      montant_total: draft.total,
      date: new Date().toISOString().split("T")[0]
    };

    try {
      const res = await fetch("http://localhost/PROJET/Back-end/api/reservation.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
      });

      const data = await res.json();

      if (!data.success) {
        alert(data.message || "Erreur reservation");
        return;
      }

      const clientName = [user.nom, user.prenom].filter(Boolean).join(" ");

      const ticket = {
        id: data.id_reservation,
        client: clientName || user.id,
        telephone: user.telephone || "",
        busType: draft.busType || "classique",
        pointDepart: draft.pointDepart || "",
        seats: draft.seats || [],
        total: draft.total || 0,
        status: "EN ATTENTE",
        voyage: draft.voyageId
      };

      localStorage.setItem("ticket", JSON.stringify(ticket));
      localStorage.removeItem("reservationDraft");

      window.location.href = "ticket.php";
    } catch (err) {
      console.error(err);
      alert("Erreur serveur");
    }
  });
</script>

</body>
</html>
