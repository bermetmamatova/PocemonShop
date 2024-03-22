
<!DOCTYPE html>
<html>
<head>
    <title>Pokemon shop</title>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>


<?php include 'header.php'; ?>

<div class="welcome-message">
<?php
session_start();  

if (isset($_SESSION['username'])) {
    echo '<h3>Welcome, <a href="userDetails.php">' . $_SESSION['username'] . '</a>!</h3>';
    echo '<h3>Your balance: ' . $_SESSION['money'] . ' USD</h3>';
} else {
    echo '<h3>You are not logged in.</h3>';
}
?>
</div>

<div class="pokemon-cards">
    <?php
    $json = file_get_contents('data.json');
    $pokemons = json_decode($json, true);

    foreach ($pokemons as $pokemon) {
        echo '<div class="pokemon">';
        echo '<a href="details.php?name=' . urlencode($pokemon["name"]) . '">';
        echo '<div class="pokemon-image ' . $pokemon["type"] . '">';
        echo '<img src="' . $pokemon["image"] . '" alt="' . $pokemon["name"] . '">';
        echo '</div>';
        echo '<div class="pokemon-info">';
        echo '<h2>' . $pokemon["name"] . '</h2>';
        echo '</a>';
        echo '<p>🏷️ ' . $pokemon["type"] . '</p>';
        echo '<p>❤️' . $pokemon["hp"] . '⚔️ ' . $pokemon["attack"] . '🛡️' . $pokemon["defense"] . '</p>';
        echo '<p id="price">💰  ' . $pokemon["price"] . '</p>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

</body>
</html>
