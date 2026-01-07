<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Express Voyage - Réservation de tickets</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="accueil.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="#">
      <i class="bi bi-bus-front"></i> Express Voyage
    </a>
    <div class="ms-auto">
      <a href="#" class="btn btn-outline-primary btn-sm">Connexion</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="search-card shadow">
          <h4 class="mb-3 text-center">
            Réservez votre voyage en toute simplicité
          </h4>

          <form action="resultats.php" method="get">

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Départ</label>
                   <select class="form-select">
                      <option>Yaoundé</option>
                      <option>Bafoussam</option>
                      <option>Douala</option>
                   </select>
                <!-- <input type="text" class="form-control" placeholder="Ex : Douala"> -->
              </div>

              <div class="col-md-4">
                <label class="form-label">Destination</label>
                <select class="form-select">
                      <option>Yaoundé</option>
                      <option>Bafoussam</option>
                      <option>Douala</option>
                   </select>
                <!-- <input type="text" class="form-control" placeholder="Ex : Yaoundé"> -->
              </div>

              <div class="col-md-4">
                <label class="form-label">Date</label>
                <input type="date" class="form-control">
              </div>
            </div>

            <div class="d-grid mt-4">
              <button class="btn btn-primary btn-lg">
                <i class="bi bi-search"></i> Rechercher un voyage
              </button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- AVANTAGES -->
<section class="container mt-5">
  <div class="row text-center">
    <div class="col-md-4">
      <i class="bi bi-clock-history icon"></i>
      <h6>Rapide</h6>
      <p>Réservation en quelques clics</p>
    </div>
    <div class="col-md-4">
      <i class="bi bi-shield-check icon"></i>
      <h6>Sécurisé</h6>
      <p>Paiement et ticket fiables</p>
    </div>
    <div class="col-md-4">
      <i class="bi bi-phone icon"></i>
      <h6>Accessible</h6>
      <p>Web & Mobile</p>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer mt-5">
  <p> 2026 Express Voyage – Le plaisir de voyager</p>
</footer>

</body>
</html>
