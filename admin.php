<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="styles/admin.css">
</head>

<body>

    <h3>Here you can create a new card. Please fill in all the fields!</h3>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Name: <input type="text" name="name"><br>
    Type:<select name="type">
        <option value="type1">fire</option>
        <option value="type2">electric</option>
        <option value="type3">grass</option>
        <option value="type3">normal</option>
        <option value="type3">bug</option>
        <option value="type3">water</option>
        <option value="type3">poison</option>
    </select><br>
    HP: <input type="text" name="hp"><br>
    Attack: <input type="text" name="attack"><br>
    Defense: <input type="text" name="defense"><br>
    Price: <input type="text" name="price"><br>
    Description: <input type="text" name="description"><br>
    Image URL: <input type="text" name="image"><br>
    <input type="submit">

</form>

<div class="container">
    <ul>
    </ul>
</div>

</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $type = $_POST["type"];
    $hp = $_POST["hp"];
    $attack = $_POST["attack"];
    $defense = $_POST["defense"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $image = $_POST["image"];

    $errors = array();

    if (empty($name)) {
        $errors[] = 'The name field is required.';
    }

    if (empty($type)) {
        $errors[] = 'The type field is required to choose.';
    }

    if (!is_numeric($hp)) {
        $errors[] = 'The hp field should be only numbers.';
    }

    if (!is_numeric($attack)) {
        $errors[] = 'The attack field should be only numbers.';
    }

    if (!is_numeric($defense)) {
        $errors[] = 'The defense field should be only numbers.';
    }

    if (!is_numeric($price)) {
        $errors[] = 'The price field should be only numbers.';
    }

    if (strlen($description) > 200) {
        $errors[] = 'The description is too long.';
    }

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        $errors[] = 'The image field should be a valid URL.';
    }

    if (empty($errors)) {
        $json = file_get_contents('data.json');
        $pokemons = json_decode($json, true);
        $newCard = array(
            "name" => $name,
            "type" => $type,
            "hp" => $hp,
            "attack" => $attack,
            "defense" => $defense,
            "price" => $price,
            "description" => $description,
            "image" => $image
        );
        $pokemons[] = $newCard;

        file_put_contents('data.json', json_encode($pokemons));
    } 
    else {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li class='error-message'>$error</li>";
        }
        echo "</ul>";
    }
}
?>
