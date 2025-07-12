<?php
session_start();
$error = "";
require 'includes/db.php'; 

// Kontrollo nëse përdoruesi është i kyçur
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Kur dërgohet formulari
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $mosha = intval($_POST['mosha']);
    $tipi = $_POST['tipi']; // duhet të jetë '1', '2', ose 'G'
    $aktiviteti = $_POST['aktiviteti']; // duhet të jetë 'i_ulet', 'mesatar', ose 'i_larte'

    $stmt = $conn->prepare("INSERT INTO user_data (user_id, age, tipi_diabetit, aktiviteti) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $mosha, $tipi, $aktiviteti);

    if ($stmt->execute()) {
        header("Location: rekomandime.php");
        exit();
    } else {
        $error = "Gabim gjatë ruajtjes: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Personalizo Këshillat – Shëndeti</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <script>
    function validateForm() {
      const mosha = document.forms["personalizeForm"]["mosha"].value;
      const tipi = document.forms["personalizeForm"]["tipi"].value;
      const aktiviteti = document.forms["personalizeForm"]["aktiviteti"].value;

      if (!mosha || mosha < 1 || mosha > 120) {
        alert("Ju lutem shkruani një moshë të vlefshme.");
        return false;
      }
      if (!tipi) {
        alert("Zgjidhni tipin e diabetit.");
        return false;
      }
      if (!aktiviteti) {
        alert("Zgjidhni nivelin e aktivitetit.");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <nav class="navbar">
    <div class="container">
      <h1 class="logo">Shëndeti</h1>
      <ul class="nav-links">
        <li><a href="index.php">Kryefaqja</a></li>
        <li><a href="personalize.php" class="active">Personalizo</a></li>
      </ul>
    </div>
  </nav>

  <main class="container" style="max-width: 500px; margin: 3rem auto;">
    <h2>Fusni të dhënat tuaja</h2>

    <?php if (!empty($error)): ?>
      <div style="color: red; margin-bottom: 15px;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form name="personalizeForm" action="personalize.php" method="POST" onsubmit="return handleSubmit();">
      <label for="mosha">Mosha:</label>
      <input type="number" id="mosha" name="mosha" min="1" max="120" required placeholder="Shkruani moshën tuaj" />

      <label for="tipi">Tipi i diabetit:</label>
      <select id="tipi" name="tipi" required>
        <option value="" disabled selected>Zgjidh tipin</option>
        <option value="1">Tipi 1</option>
        <option value="2">Tipi 2</option>
        <option value="G">Gestacional</option>
      </select>

      <label for="aktiviteti">Aktiviteti ditor:</label>
      <select id="aktiviteti" name="aktiviteti" required>
        <option value="" disabled selected>Zgjidh nivelin e aktivitetit</option>
        <option value="i_ulet">I ulët</option>
        <option value="mesatar">Mesatar</option>
        <option value="i_larte">I lartë</option>
      </select>

      <button type="submit" class="btn-primary" style="margin-top: 20px; width: 100%;">Vazhdo</button>
      <div id="loading" style="display: none; text-align: center; margin-bottom: 10px;">
      <div class="spinner"></div>
      </div>
    </form>
  </main>
</body>
</html>
