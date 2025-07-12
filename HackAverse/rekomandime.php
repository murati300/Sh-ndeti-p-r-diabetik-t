<?php
$dataFile = __DIR__ . '/data.json';
$data = json_decode(file_get_contents($dataFile), true);

$allowedFoods = $data['allowed_foods'] ?? [];
$notAllowedFoods = $data['not_allowed_foods'] ?? [];
$allowedDrinks = $data['allowed_drinks'] ?? [];
$notAllowedDrinks = $data['not_allowed_drinks'] ?? [];
?>

<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Rekomandimet për Ushqim dhe Pije</title>
<style>
  /* Reset dhe font */
  * {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
      Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    background: #f9fafb;
    display: flex;
    height: 100vh;
    color: #333;
  }

  /* Sidebar */
  .sidebar {
    width: 72px;
    background: #2c3e50;
    color: #ecf0f1;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 30px 0;
    box-shadow: 2px 0 12px rgba(0,0,0,0.15);
  }
  .account-icon {
    font-size: 42px;
    margin-bottom: auto;
    user-select: none;
    cursor: default;
    line-height: 1;
    transition: color 0.3s ease;
  }
  .account-icon:hover {
    color: #3498db;
  }
  .logout-btn {
    background: #e74c3c;
    border: none;
    color: white;
    padding: 12px;
    font-size: 14px;
    border-radius: 9999px;
    cursor: pointer;
    width: 50px;
    margin-bottom: 20px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }
  .logout-btn:hover {
    background: #c0392b;
    box-shadow: 0 6px 12px rgba(0,0,0,0.3);
  }

  /* Main content */
  main {
    flex-grow: 1;
    padding: 40px 50px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    background: white;
  }

  /* Toggles */
  .toggles {
    margin-bottom: 30px;
  }
  .toggle-btn {
    background: #3498db;
    color: white;
    border: none;
    padding: 12px 26px;
    border-radius: 9999px;
    cursor: pointer;
    font-weight: 600;
    font-size: 15px;
    margin-right: 14px;
    box-shadow: 0 4px 8px rgba(52,152,219,0.4);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }
  .toggle-btn:hover {
    background: #2980b9;
    box-shadow: 0 6px 14px rgba(41,128,185,0.5);
  }

  /* Cards grid */
  .cards-container {
    display: grid;
    grid-template-columns: repeat(auto-fill,minmax(220px,1fr));
    gap: 26px;
  }

  /* Card style */
  .card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    padding: 20px 18px 26px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    word-wrap: break-word;
    overflow-wrap: break-word;
    transition: transform 0.25s cubic-bezier(0.4,0,0.2,1), box-shadow 0.25s cubic-bezier(0.4,0,0.2,1);
    cursor: default;
  }
  .card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 36px rgba(0,0,0,0.12);
  }
  .card img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    border-radius: 14px;
    margin-bottom: 16px;
    user-select: none;
  }
  .card h4 {
    margin: 0 0 12px;
    font-weight: 700;
    color: #2c3e50;
    font-size: 20px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }
  .card p {
    font-size: 15px;
    color: #666f7a;
    margin: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
    line-height: 1.4;
  }

  /* Tooltip */
  .tooltip-container {
    cursor: help;
  }
  .tooltip-text {
    visibility: hidden;
    width: 210px;
    background-color: rgba(44, 62, 80, 0.9);
    color: #ecf0f1;
    text-align: center;
    border-radius: 8px;
    padding: 10px 14px;
    position: absolute;
    z-index: 15;
    bottom: 135%;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s ease;
    font-size: 14px;
    line-height: 1.3;
    pointer-events: none;
    box-shadow: 0 3px 6px rgba(0,0,0,0.25);
  }
  .tooltip-container:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
  }
</style>
</head>
<body>

<div class="sidebar" aria-label="Sidebar navigation">
  <div class="account-icon" title="Llogaria juaj">👤</div>
  <button class="logout-btn" onclick="logout()" title="Dil nga llogaria">Dil</button>
</div>

<main>
  <div class="toggles" role="group" aria-label="Ndrysho shfaqjen e ushqimeve dhe pijëve">
    <button class="toggle-btn" id="toggleFoodsBtn" aria-pressed="false">Trego Ushqimet Jo të Lejuara</button>
    <button class="toggle-btn" id="toggleDrinksBtn" aria-pressed="false">Trego Pijet Jo të Lejuara</button>
  </div>

  <div class="cards-container" id="cardsContainer" aria-live="polite" aria-atomic="true"></div>
</main>

<script>
  const cardsContainer = document.getElementById('cardsContainer');
  const toggleFoodsBtn = document.getElementById('toggleFoodsBtn');
  const toggleDrinksBtn = document.getElementById('toggleDrinksBtn');

  const allowedFoods = <?= json_encode($allowedFoods, JSON_HEX_TAG); ?>;
  const notAllowedFoods = <?= json_encode($notAllowedFoods, JSON_HEX_TAG); ?>;
  const allowedDrinks = <?= json_encode($allowedDrinks, JSON_HEX_TAG); ?>;
  const notAllowedDrinks = <?= json_encode($notAllowedDrinks, JSON_HEX_TAG); ?>;

  let showingAllowedFoods = true;
  let showingAllowedDrinks = true;

  function renderCards(items, isNotAllowedDrinks = false) {
    cardsContainer.innerHTML = '';
    if (items.length === 0) {
      cardsContainer.innerHTML = '<p style="color:#555; font-size:16px;">Nuk ka ushqime/pije për tu shfaqur.</p>';
      return;
    }
    items.forEach(item => {
      const card = document.createElement('div');
      card.className = 'card';

      if (isNotAllowedDrinks && item.advice) {
        card.classList.add('tooltip-container');
      }

      const img = document.createElement('img');
      img.src = item.img;
      img.alt = item.name;

      const title = document.createElement('h4');
      title.textContent = item.name;

      const desc = document.createElement('p');
      desc.textContent = item.desc;

      card.appendChild(img);
      card.appendChild(title);
      card.appendChild(desc);

      if (isNotAllowedDrinks && item.advice) {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip-text';
        tooltip.textContent = item.advice;
        card.appendChild(tooltip);
      }

      cardsContainer.appendChild(card);
    });
  }

  // Fillimisht shfaq ushqimet e lejuara
  renderCards(allowedFoods);

  toggleFoodsBtn.addEventListener('click', () => {
    if (showingAllowedFoods) {
      renderCards(notAllowedFoods);
      toggleFoodsBtn.textContent = 'Trego Ushqimet e Lejuara';
      toggleFoodsBtn.setAttribute('aria-pressed', 'true');
    } else {
      renderCards(allowedFoods);
      toggleFoodsBtn.textContent = 'Trego Ushqimet Jo të Lejuara';
      toggleFoodsBtn.setAttribute('aria-pressed', 'false');
    }
    showingAllowedFoods = !showingAllowedFoods;
  });

  toggleDrinksBtn.addEventListener('click', () => {
    if (showingAllowedDrinks) {
      renderCards(notAllowedDrinks, true);
      toggleDrinksBtn.textContent = 'Trego Pijet e Lejuara';
      toggleDrinksBtn.setAttribute('aria-pressed', 'true');
    } else {
      renderCards(allowedDrinks);
      toggleDrinksBtn.textContent = 'Trego Pijet Jo të Lejuara';
      toggleDrinksBtn.setAttribute('aria-pressed', 'false');
    }
    showingAllowedDrinks = !showingAllowedDrinks;
  });

  function logout() {
    alert('Po del nga llogaria...');
    window.location.href = 'logout.php';
  }
</script>

</body>
</html>
