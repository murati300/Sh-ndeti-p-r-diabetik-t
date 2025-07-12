<?php
require 'includes/db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Kontrollo nëse email ekziston
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Ky email është i zënë, përdorni një tjetër.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            header("Location: login.php");
            exit();
        } else {
            $error = "Ndodhi një gabim gjatë regjistrimit: " . $stmt->error;
        }
    }
    $check->close();
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8" />
  <title>Regjistrohu</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      margin: 0; padding: 0;
    }
    .container {
      max-width: 420px;
      margin: 80px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 { text-align: center; margin-bottom: 20px; color: #333; }
    label { display: block; margin-top: 15px; font-weight: 500; }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    button {
      width: 100%;
      margin-top: 25px;
      padding: 12px;
      background-color: #2b7de9;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover { background-color: #125ecf; }
    p { text-align: center; margin-top: 20px; }
    a { color: #2b7de9; text-decoration: none; }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Krijo një llogari</h2>
    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="sign-up.php" method="POST">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required placeholder="Shkruani email-in tuaj" />


      <label for="password">Fjalëkalimi:</label>
      <input type="password" id="password" name="password" required placeholder="Fjalëkalim" />

      <button type="submit">Sign Up</button>
    </form>
    <p>Keni llogari? <a href="login.php">Kyçu këtu</a></p>
  </div>
</body>
</html>
