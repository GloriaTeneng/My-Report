<?php
session_start();

$_SESSION = [];
if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(
    session_name(),
    "",
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
  );
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Déconnexion</title>
</head>
<body>
  <script>
    localStorage.removeItem("user");
    localStorage.removeItem("reservationDraft");
    localStorage.removeItem("selectedVoyage");
    localStorage.removeItem("ticket");
    window.location.href = "Accueil.html";
  </script>
</body>
</html>