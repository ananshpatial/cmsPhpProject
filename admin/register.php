<?php
include("../connect.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'user';  // Default role for new users

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (name, age, mobile, email, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $name, $age, $mobile, $email, $username, $password, $role);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Registration successful! <a href='login.php'>Click here to login</a></div>";
    } else {
        echo "<div class='alert alert-danger'>Error in registration!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .register-container {
            margin-top: 50px;
        }
        .register-box {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .register-title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="register-box">
            <h3 class="register-title">Register</h3>
            <form action="register.php" method="post">
                <div class="mb-3">
                    <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="number" name="age" placeholder="Age" required>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="mobile" placeholder="Mobile Number" required>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100" name="register">Register</button>
                </div>
                <p class="text-center">Already have an account? <a href="login.php">Click here to login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
