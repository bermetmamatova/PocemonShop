
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="styles/details.css">
</head>

</head>
<body>
    <?php include 'header.php'; ?>
    
</body>
</html>
<?php
    $json = file_get_contents('data.json');
    $pokemons = json_decode($json, true);
    $name = $_GET['name'];
    $json = file_get_contents('data.json');
        $pokemons = json_decode($json, true);
        $name = $_GET['name'];

        foreach ($pokemons as $pokemon) {
            if ($pokemon["name"] == $name) {
                echo '<div class="pokemonD ' . $pokemon["type"] . '">';
                echo '<img src="' . $pokemon["image"] . '" alt="' . $pokemon["name"] . '">';
                echo '<h1>' . $pokemon["name"] . '</h1>';
                echo '<p>❤️ ' . $pokemon["hp"] . '</p>';
                echo '<p>Description: ' . $pokemon["description"] . '</p>';
                echo '<p>🏷️ ' . $pokemon["type"] . '</p>';
                echo '</div>';
                break;
            }
        }

    

?>
