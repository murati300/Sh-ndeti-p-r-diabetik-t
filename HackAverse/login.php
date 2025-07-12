<?php
require 'includes/db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: personalize.php");
            exit();
        } else {
            $error = "Fjalëkalimi është i pasaktë.";
        }
    } else {
        $error = "Email-i nuk ekziston.";
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8" />
  <title>Kyçu në llogari</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 400px;
      margin: 80px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: 500;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
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
    }
    button:hover {
      background-color: #125ecf;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
    p {
      text-align: center;
      margin-top: 20px;
    }
    a {
      color: #2b7de9;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Kyçu në llogari</h2>
    <?php if (!empty($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="login.php" method="POST">
      <label for="email">Email-i:</label>
      <input type="email" name="email" id="email" required placeholder="Shkruani email-in tuaj" />

      <label for="password">Fjalëkalimi:</label>
      <input type="password" name="password" id="password" required placeholder="Shkruani fjalëkalimin" />

      <button type="submit">Kyçu</button>
    </form>
    <p>Nuk keni llogari? <a href="sign-up.php">Regjistrohu</a></p>
  </div>
</body>
</html>
