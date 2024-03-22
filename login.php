<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/admin.css">
</head>
<body>
<h3>Welcome back! Please log in to contunue further:)</h3>

    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
    

   
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $errors = array();

    if (empty($username)) {
        $errors[] = 'The username field is required.';
    }

    if (empty($password)) {
        $errors[] = 'The password field is required';
    }

    if (empty($errors)) {
        $json = file_get_contents('users.json');
        $users = json_decode($json, true);

        $userExists = false;
        foreach ($users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                $userExists = true;
                break;
            }
        }

        if (!$userExists) {
            $errors[] = 'Invalid username or password';
        } else {
            $_SESSION['username'] = $username;  
            $_SESSION['money'] = $user['money'];
        }
    }

    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li class='error-message'>$error</li>";
        }
        echo "</ul>";
    } else {
        header('Location: index.php');
        exit;
    }
}
?>
    
</body>
</html>