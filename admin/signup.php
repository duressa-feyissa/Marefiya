<?php
require_once 'connection/connection.php'; // Include the connection.php file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $confirmPassword = $_POST['cpsw'];

    if ($password !== $confirmPassword) {
        echo "Passwords do not match";
        exit();
    }

    // Check if the admin already exists
    $query = $db->prepare("SELECT * FROM admins WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo "Admin with the provided email already exists";
        exit();
    }

    // Encrypt the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new admin into the admins table
    $query = $db->prepare("INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)");
    $query->bindParam(':name', $name);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $hashedPassword);

    if ($query->execute()) {
        header("Location: login.php"); // Redirect to login.php after successful signup
        exit();
    } else {
        echo "Error creating admin account";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp - Marefiya Hotel</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="page">
    <main class="main page__main">
        <form class="login-form main__login-form" action="signup.php" method="POST">
            <h3 class="login-form__title">Sign Up</h3>
            <label class="login-form__label" for="name">
                <span class="sr-only">Username</span>
                <input class="login-form__input" id="name" type="text" name="name" placeholder="Username"
                    required="required" />
            </label>
            <label class="login-form__label" for="email">
                <span class="sr-only">Email</span>
                <input class="login-form__input" id="email" type="email" name="email" placeholder="Email"
                    required="required" />
            </label>
            <label class="login-form__label" for="psw">
                <span class="sr-only">Password</span>
                <input class="login-form__input" id="psw" type="password" name="psw" placeholder="Password"
                    required="required" />
            </label>
            <label class="login-form__label" for="cpsw">
                <span class="sr-only">Confirm Password</span>
                <input class="login-form__input" id="cpsw" type="password" name="cpsw" placeholder="Confirm Password"
                    required="required" />
            </label>
            <button class="primary-btn" type="submit">Sign Up</button>
            <div class="login-form__footer">
                <a class="login-form__link" href="#">Forget Password?</a>
                <a class="login-form__link" href="login.php">Login</a>
            </div>
        </form>
    </main>
</body>

</html>
