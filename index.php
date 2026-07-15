<?php

    include("db.php");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['user_id'])) {
        header("Location: dashboard/index.php");
        exit;
    }

    $error_msg = $_SESSION['login_error'] ?? "";
    unset($_SESSION['login_error']);

    if (isset($_POST["login"])) {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $postedPassword = $_POST["password"] ?? '';

        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            $passwordMatches = password_verify($postedPassword, $user['password']);

            if (!$passwordMatches && hash_equals($user['password'], $postedPassword)) {
                $passwordMatches = true;
                $newHash = password_hash($postedPassword, PASSWORD_BCRYPT);
                $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
                $updateStmt->bind_param("si", $newHash, $user['user_id']);
                $updateStmt->execute();
            }

            if ($passwordMatches) {
                $_SESSION["user_id"] = $user['user_id'];
                $_SESSION["username"] = $user['username'];
                header("Location: dashboard/index.php");
                exit;
            } else {
                $_SESSION['login_error'] = "Wrong Username or Password!";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        } else {
            $_SESSION['login_error'] = "Wrong Username or Password!";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>

    <body>
        <div class = "auth-container">
            <div class = "auth-card">
                <div class = "auth-header">
                    <h2>Welcome to EmployEase!</h2>
                    <h3> Sign in to manage employee directory</h3>
                </div>
                <?php if (!empty($error_msg)) { ?>
                    <div class="error-message">
                        <?php echo $error_msg; ?>
                    </div>
                <?php } ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="username" name="username" required><br><br>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" required><br><br>
                    </div>
                    <button type="submit" name= "login" class="submit-button" >Log In</button>
                    <div class="auth-footer">
                        <p>Don't have an account? <a href="authentication/register.php"> Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
