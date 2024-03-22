<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles/admin.css">
</head>
<body>
    <h3>Please fill all the required fields to successfully register and make pokemon card purchases! </h3>

  
    <form action="register.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password"><br>
        <input type="submit" value="Register">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];
        
        $errors = array();
    
        if (empty($username)) {
            $errors[] = 'The username field is required.';
        }
    
        if (empty($email)) {
            $errors[] = 'The email is required.';
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'The format of the email is incorrect!';
        }
        if (empty($password)) {
            $errors[] = 'The password is required';
        }
    
        if ($password != $confirmPassword) {
            $errors[] = 'The password should match!';
        }
        if (empty($errors)) {
            $json = file_exists('users.json') ? file_get_contents('users.json') : '';
            $data = $json ? json_decode($json, true) : array();
    
            $newUser = array(
                'username' => $username,
                'email' => $email,
                'password' => $password,  
                'money' => 100
            );
    
            foreach ($data as $user) {
                if ($user['username'] === $username) {
                    $errors[] = 'Username already exists Please login here:
                    <a href="login.php">Login</a>';
                    break;
                }
            }
            if (empty($errors)) {
                $data[] = $newUser;
                $json = json_encode($data, JSON_PRETTY_PRINT);
                file_put_contents('users.json', $json);
            }
        } 
        if (!empty($errors)) {
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li class='error-message'>$error</li>";
            }
            echo "</ul>";
        }
    }
    

?>
   

    
</body>
</html>