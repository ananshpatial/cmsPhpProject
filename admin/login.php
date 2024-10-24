<?php
// Start session and include database connection
session_start();
include("../connect.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND role = ?");
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $role;
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'>Invalid login credentials!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .login-container {
            margin-top: 50px;
        }
        .login-box {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="login-box">
            <h3 class="login-title">Login</h3>
            <form action="login.php" method="post">
                <div class="mb-3">
                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <select class="form-control" name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
                </div>
                <p class="text-center">Don't have an account? <a href="register.php">Register Here</a></p>
            </form>
        </div>
    </div>
</body>
</html>
