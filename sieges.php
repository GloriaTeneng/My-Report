<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Choix du siège - Express Voyage</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="siege.css">
</head>

<body>
  <!-- Message d'alerte -->
  <div id="message" class="alert alert-warning d-none"></div>


<div class="container mt-5 mb-5">

  <h4 class="text-primary mb-4">
    <i class="bi bi-person-seat"></i> Choisir un siège
    <small class="text-muted">(Select seat)</small>
  </h4>

  <!-- ================= BUS VIP ================= -->
  <div class="card shadow mb-4">
    <div class="card-body" style="justify-items: center;">
      <h5 class="mb-3 text-danger">Bus VIP</h5>

      <div class="bus">
        <div class="row-seat">
          <div class="seat reserved" data-bus="vip">01</div>
          <div class="seat reserved" data-bus="vip">02</div>
          <div class="aisle"></div>
          <div class="seat reserved" data-bus="vip">03</div>
          <div class="seat available" data-bus="vip">04</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">05</div>
          <div class="seat reserved" data-bus="vip">06</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">07</div>
          <div class="seat available" data-bus="vip">08</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">09</div>
          <div class="seat available" data-bus="vip">10</div>
          <div class="aisle"></div>
          <div class="seat reserved" data-bus="vip">11</div>
          <div class="seat available" data-bus="vip">12</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">13</div>
          <div class="seat reserved" data-bus="vip">14</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">15</div>
          <div class="seat available" data-bus="vip">16</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">17</div>
          <div class="seat available" data-bus="vip">18</div>
          <div class="aisle"></div>
          <div class="seat reserved" data-bus="vip">19</div>
          <div class="seat available" data-bus="vip">20</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">21</div>
          <div class="seat reserved" data-bus="vip">22</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">23</div>
          <div class="seat available" data-bus="vip">24</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">25</div>
          <div class="seat available" data-bus="vip">26</div>
          <div class="aisle"></div>
          <div class="seat reserved" data-bus="vip">27</div>
          <div class="seat available" data-bus="vip">28</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">29</div>
          <div class="seat reserved" data-bus="vip">30</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">31</div>
          <div class="seat available" data-bus="vip">32</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">33</div>
          <div class="seat available" data-bus="vip">34</div>
          <div class="aisle"></div>
          <div class="seat reserved" data-bus="vip">35</div>
          <div class="seat available" data-bus="vip">36</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">37</div>
          <div class="seat reserved" data-bus="vip">38</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">39</div>
          <div class="seat available" data-bus="vip">40</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">41</div>
          <div class="seat available" data-bus="vip">42</div>
          <div class="aisle"></div>
          <div class="seat reserved" data-bus="vip">43</div>
          <div class="seat available" data-bus="vip">44</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">45</div>
          <div class="seat reserved" data-bus="vip">46</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">47</div>
          <div class="seat available" data-bus="vip">48</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">49</div>
          <div class="seat available" data-bus="vip">50</div>
          <div class="aisle"></div>
          <div class="seat reserved" data-bus="vip">51</div>
          <div class="seat available" data-bus="vip">52</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">53</div>
          <div class="seat reserved" data-bus="vip">54</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">55</div>
          <div class="seat available" data-bus="vip">56</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">57</div>
          <div class="seat reserved" data-bus="vip">58</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">59</div>
          <div class="seat available" data-bus="vip">60</div>
        </div>
        <div class="row-seat">
          <div class="seat available" data-bus="vip">61</div>
          <div class="seat reserved" data-bus="vip">62</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">63</div>
          <div class="seat available" data-bus="vip">64</div>
        </div>

        <div class="row-seat">
          <div class="seat available" data-bus="vip">65</div>
          <div class="seat reserved" data-bus="vip">66</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="vip">67</div>
          <div class="seat available" data-bus="vip">68</div>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= BUS CLASSIQUE ================= -->
  <div class="card shadow mb-4">
    
    <div class="card-body" style="justify-items: center;">
      <h5 class="mb-3 text-primary">Bus Classique</h5>

      <div class="bus">
        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">01</div>
          <div class="seat reserved" data-bus="classique">02</div>
          <div class="seat reserved" data-bus="classique">03</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">04</div>
          <div class="seat available" data-bus="classique">05</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">06</div>
          <div class="seat available" data-bus="classique">07</div>
          <div class="seat reserved" data-bus="classique">08</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">09</div>
          <div class="seat reserved" data-bus="classique">10</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">11</div>
          <div class="seat reserved" data-bus="classique">12</div>
          <div class="seat reserved" data-bus="classique">13</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">14</div>
          <div class="seat available" data-bus="classique">15</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">16</div>
          <div class="seat available" data-bus="classique">17</div>
          <div class="seat available" data-bus="classique">18</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">19</div>
          <div class="seat reserved" data-bus="classique">20</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">21</div>
          <div class="seat available" data-bus="classique">22</div>
           <div class="seat available" data-bus="classique">23</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">24</div>
          <div class="seat reserved" data-bus="classique">25</div>
      </div>

      <div class="row-seat">
          <div class="seat reserved" data-bus="classique">26</div>
          <div class="seat reserved" data-bus="classique">27</div>
          <div class="seat reserved" data-bus="classique">28</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">29</div>
          <div class="seat available" data-bus="classique">30</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">31</div>
          <div class="seat available" data-bus="classique">32</div>
          <div class="seat available" data-bus="classique">33</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">34</div>
          <div class="seat reserved" data-bus="classique">35</div>
        </div><div class="row-seat">
          <div class="seat reserved" data-bus="classique">36</div>
          <div class="seat reserved" data-bus="classique">37</div>
          <div class="seat reserved" data-bus="classique">38</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">39</div>
          <div class="seat available" data-bus="classique">40</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">41</div>
          <div class="seat available" data-bus="classique">42</div>
           <div class="seat available" data-bus="classique">43</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">44</div>
          <div class="seat reserved" data-bus="classique">45</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">46</div>
          <div class="seat reserved" data-bus="classique">47</div>
          <div class="seat reserved" data-bus="classique">48</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">49</div>
          <div class="seat available" data-bus="classique">50</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">51</div>
          <div class="seat available" data-bus="classique">52</div>
          <div class="seat available" data-bus="classique">53</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">54</div>
          <div class="seat reserved" data-bus="classique">55</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">56</div>
          <div class="seat reserved" data-bus="classique">57</div>
          <div class="seat reserved" data-bus="classique">58</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">59</div>
          <div class="seat available" data-bus="classique">60</div>
        </div>

        <div class="row-seat">
          <div class="seat reserved" data-bus="classique">61</div>
          <div class="seat available" data-bus="classique">62</div>
           <div class="seat available" data-bus="classique">63</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">64</div>
          <div class="seat reserved" data-bus="classique">65</div>
        </div>

         <div class="row-seat">
          <div class="seat reserved" data-bus="classique">66</div>
          <div class="seat available" data-bus="classique">67</div>
          <div class="seat available" data-bus="classique">68</div>
          <div class="aisle"></div>
          <div class="seat available" data-bus="classique">69</div>
          <div class="seat reserved" data-bus="classique">70</div>
        </div>
    </div>
  </div>

  <!-- ================= RÉSUMÉ ================= -->
  <div class="card shadow">
    <div class="card-body">
      <h5>Résumé de la réservation</h5>

      <p>Sièges sélectionnés : <strong id="selectedSeat">Aucun</strong></p>
      <p>Type de bus : <strong id="busType">—</strong></p>
      <p>Prix total : <strong id="totalPrice">0 FCFA</strong></p>

      <div class="d-flex justify-content-end">
        <a href="paiement.php" class="btn btn-primary" id="continueBtn" disabled>
             Continuer vers paiement
        </a>
</div>

      
    </div>
  </div>

</div>

<script>
  // ====== Récupération des éléments ======
  const allSeats = document.querySelectorAll('.seat');
  const messageBox = document.getElementById('message');
  const selectedSeatText = document.getElementById('selectedSeat');
  const continueBtn = document.getElementById('continueBtn');
  const totalPriceText = document.getElementById('totalPrice');
  const busTypeText = document.getElementById('busType');

  // ====== Prix ======
  const PRICES = {
    vip: 10000,
    classique: 5000
  };

  let selectedSeats = [];
  let selectedBusType = null;

  // ====== Simulation base de données (statut sièges) ======
  let seatStatus = JSON.parse(localStorage.getItem("seatStatus")) || {};

  // ====== Appliquer les statuts enregistrés ======
  allSeats.forEach(seat => {
    const num = seat.textContent;

    if (seatStatus[num] === "reserved") {
      seat.classList.add("reserved");
    }
    if (seatStatus[num] === "pending") {
      seat.classList.add("pending");
    }
  });

  // ====== Message ======
  function showMessage(text) {
    messageBox.textContent = text;
    messageBox.classList.remove('d-none');
    setTimeout(() => messageBox.classList.add('d-none'), 3000);
  }

  // ====== Mise à jour du résumé ======
  function updateSummary() {
    if (selectedSeats.length === 0) {
      selectedSeatText.textContent = "Aucun";
      busTypeText.textContent = "—";
      totalPriceText.textContent = "0 FCFA";
      continueBtn.setAttribute('disabled', true);
      return;
    }

    const price = PRICES[selectedBusType] * selectedSeats.length;
    selectedSeatText.textContent = selectedSeats.join(', ');
    busTypeText.textContent = selectedBusType.toUpperCase();
    totalPriceText.textContent = price.toLocaleString() + " FCFA";
    continueBtn.removeAttribute('disabled');
  }

  // ====== Sélection des sièges ======
  allSeats.forEach(seat => {
    seat.addEventListener('click', () => {

      // Si déjà réservé
      if (seat.classList.contains('reserved') || seat.classList.contains('pending')) {
        showMessage("Ce siège est déjà réservé ou en attente de validation.");
        return;
      }

      const seatNumber = seat.textContent;
      const busType = seat.dataset.bus;

      // Empêcher mélange VIP / Classique
      if (selectedBusType && busType !== selectedBusType) {
        showMessage("Veuillez choisir des sièges du même type de bus.");
        return;
      }

      // Désélection
      if (seat.classList.contains('selected')) {
        seat.classList.remove('selected');
        selectedSeats = selectedSeats.filter(s => s !== seatNumber);

        if (selectedSeats.length === 0) {
          selectedBusType = null;
        }
      }
      // Sélection
      else {
        seat.classList.add('selected');
        selectedSeats.push(seatNumber);
        selectedBusType = busType;
      }

      updateSummary();
    });
  });

  // ====== Validation réservation client ======
  continueBtn.addEventListener('click', () => {
    if (selectedSeats.length === 0) return;

    selectedSeats.forEach(seat => {
      seatStatus[seat] = "pending";
    });

    localStorage.setItem("seatStatus", JSON.stringify(seatStatus));

    showMessage("Réservation envoyée. En attente de validation par l'agence.");

    setTimeout(() => {
      location.reload();
    }, 1500);
  });
</script>

</body>
</html>
