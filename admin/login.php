<?php
session_start();

require_once 'connection/connection.php'; // Include the connection.php file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    // Check if the admin exists
    $query = $db->prepare("SELECT * FROM admins WHERE name = :username");
    $query->bindParam(':username', $username);
    $query->execute();

    if ($query->rowCount() === 1) {
        $admin = $query->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if (password_verify($password, $admin['password'])) {
            // Set session variables
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            // username
            $_SESSION['username'] = $admin['username'];

            session_write_close();

            // Redirect to index.php after successful login
            header("Location: index.php");
            exit();
        }
    }

    // If login fails, display an error message
    echo "Invalid username or password";
} 
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <link rel="stylesheet" href="assets/css/login.css"> 
    </head>
<body>
    <div class="wrapper">

        <div class="sct brand"><h3>Marefiya Hotel</h3><br>
    </div>
        <div class="sct login">
            <form action="login.php" method="POST">
                <h3>Admin Login</h3>
                <input type="text" name="uname" placeholder="username">
                <input type="password" name="psw" placeholder="Password">
                <div class="forgot-remember">
                        <label class="control control-checkbox">
                                Remember me
                                    <input type="checkbox" />
                                <div class="control_indicator"></div>
                            </label>
                    <div class="forgot">
                            <a href="#">Forgot Password?</a>
                    </div> 
                </div>
                <input type="submit" name="Login" value="Login">
               
            </form>
        </div>  
    </div> 
</body>
</html>