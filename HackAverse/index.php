<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Shëndeti – Kujdesi për Diabetin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background: #f7f9fb;
      color: #333;
    }
    nav.navbar {
      background: #ffffffff;
      padding: 15px 0;
    }
    nav.navbar .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1000px;
      margin: 0 auto;
      padding: 0 20px;
    }
    nav.navbar .logo {
      color: green;
      font-weight: 700;
      font-size: 24px;
      margin: 0;
    }
    nav.navbar ul.nav-links {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      gap: 25px;
    }
    nav.navbar ul.nav-links li a {
      color: white;
      text-decoration: none;
      font-weight: 600;
      font-size: 16px;
      transition: color 0.2s ease;
      color: green;
    }
    nav.navbar ul.nav-links li a:hover {
      color: #27ae60;
    }

    header.hero {
      background: #27ae60;
      color: white;
      padding: 60px 20px;
      text-align: center;
    }
    header.hero h2 {
      font-size: 36px;
      margin-bottom: 10px;
    }
    header.hero p {
      font-size: 18px;
      margin-bottom: 25px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }
    .btn-primary {
      background: white;
      color: #27ae60;
      padding: 12px 30px;
      border-radius: 6px;
      font-weight: 700;
      font-size: 16px;
      text-decoration: none;
      transition: background-color 0.3s ease, color 0.3s ease;
      display: inline-block;
    }
    .btn-primary:hover {
      background: #1e8747;
      color: white;
    }

    section.cards.container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 0 20px;
      display: flex;
      gap: 30px;
      justify-content: space-between;
      flex-wrap: wrap;
    }
    article.card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.1);
      padding: 25px;
      width: 30%;
      box-sizing: border-box;
      color: #2c3e50;
    }
    article.card h3 {
      margin-top: 0;
      margin-bottom: 15px;
      font-size: 22px;
    }
    article.card p, article.card ul {
      font-size: 15px;
      line-height: 1.5;
      color: #555;
    }
    article.card ul {
      padding-left: 20px;
    }
    article.card ul li {
      margin-bottom: 8px;
    }

    /* PAKOT */
    .packages-container {
      max-width: 700px;
      margin: 50px auto 40px auto;
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .package {
      background: white;
      padding: 25px 20px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      width: 300px;
      text-align: center;
      color: #2c3e50;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .package h3 {
      margin-bottom: 18px;
      font-weight: 700;
      font-size: 22px;
    }

    .package p {
      font-size: 16px;
      margin-bottom: 20px;
      color: #555;
      flex-grow: 1;
    }

    .package .price {
      font-size: 26px;
      font-weight: 700;
      color: #27ae60;
      margin-bottom: 20px;
    }

    .package button {
      background: #27ae60;
      border: none;
      color: white;
      padding: 12px 0;
      font-weight: 700;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .package button:hover {
      background: #1e8747;
    }

    footer.footer {
      background: green;
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 14px;
      font-weight: 600;
      margin-top: 50px;
    }

    /* Responsive */
    @media (max-width: 900px) {
      section.cards.container {
        flex-direction: column;
        gap: 25px;
      }
      article.card {
        width: 100%;
      }
      .packages-container {
        flex-direction: column;
        max-width: 400px;
      }
      .package {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="container">
      <h1 class="logo">Shëndeti</h1>
      <ul class="nav-links">
        <li><a href="#">Kryefaqja</a></li>
        <li><a href="#edukim">Edukimi</a></li>
        <li><a href="sign-up.php">Sign up</a></li>
      </ul>
    </div>
  </nav>

  <header class="hero">
    <div class="container">
      <h2>Jeto shëndetshëm me diabet</h2>
      <p>Informacione të besueshme dhe këshilla praktike për të përmirësuar jetën tuaj.</p>
      <a href="personalize.php" class="btn-primary btn-large">Personalizo këshillat e mia</a>
    </div>
  </header>

  <section id="edukim" class="cards container">
    <article class="card">
      <h3>Çfarë është Diabeti?</h3>
      <p>Diabeti është një sëmundje kronike që ndikon në mënyrën se si trupi përpunon sheqerin në gjak. Ekzistojnë tipet 1, 2 dhe gestacional.</p>
    </article>
    <article class="card">
      <h3>Kujdesi ditor</h3>
      <ul>
        <li>Ushqehu shëndetshëm dhe balancuar</li>
        <li>Mbaj aktivitet fizik të rregullt</li>
        <li>Kontrollo rregullisht sheqerin në gjak</li>
      </ul>
    </article>
    <article class="card">
      <h3>Fakte të rëndësishme</h3>
      <p>Njohja e simptomave dhe parandalimi janë çelësi për menaxhimin e diabetit në mënyrë efektive.</p>
    </article>
  </section>

  <section class="packages-container">
    <div class="package">
      <h3>Pako Bazë</h3>
      <p>12 euro në muaj për dietë të personalizuar dhe këshilla ushqimore.</p>
      <p class="price">12 €/muaj</p>
      <button type="button" onclick="alert('Falenderojmë për zgjedhjen e Pakos Bazë!')">Blej</button>
    </div>
    <div class="package">
      <h3>Pako Premium</h3>
      <p>20 euro në muaj për dietë, monitorim dhe mbështetje të vazhdueshme nga specialistë.</p>
      <p class="price">20 €/muaj</p>
      <button type="button" onclick="alert('Falenderojmë për zgjedhjen e Pakos Premium!')">Blej</button>
    </div>
  </section>

  <footer class="footer">
    <p>&copy; 2025 Shëndeti. Të drejtat e rezervuara.</p>
  </footer>
</body>
</html>
