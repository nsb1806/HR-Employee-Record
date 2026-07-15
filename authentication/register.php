<?php
    include("../session.php");
    include("../db.php");

    if (isset($_SESSION['user_id'])) {
        header("Location: ../dashboard/index.php");
        exit;
    }

    $error_msg = "";
    $success_msg = "";

    if(isset($_POST["create"]))
    {
        $fname = mysqli_real_escape_string($conn, trim($_POST["fname"]));
        $lname = mysqli_real_escape_string($conn, trim($_POST["lname"]));
        $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
        $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
        $password = $_POST["password"] ?? '';

        if (empty($fname) || empty($lname) || empty($email) || empty($username) || empty($password)) {
            $error_msg = "Please fill in all the required fields.";
        } else {
            $check_query = "SELECT username FROM users WHERE email = '$email' OR username = '$username' LIMIT 1";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                $existing_user = mysqli_fetch_assoc($check_result);
                $error_msg = "An account with that email or username already exists.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $insert_query = "INSERT INTO users (fname, lname, username, email, password) 
                VALUES ('$fname', '$lname', '$username', '$email', '$hashedPassword')";

                if (mysqli_query($conn, $insert_query)) {
                    $success_msg = "Account created successfully! Redirecting to login page...";
                    header("refresh:2; url=../index.php");
                } else {
                    $error_msg = "Error creating account: " . mysqli_error($conn);
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register Account</title>
        <link rel="stylesheet" href="../assets/style.css">
    </head>
    <body>
        <div class = "auth-container">
            <div class = "auth-card">
                <div class = "auth-header">
                    <h2>Register Account</h2>
                </div>
                <?php if (!empty($error_msg)) { ?>
                    <div class="error-message">
                        <?php echo $error_msg; ?>
                    </div>
                <?php } ?>
                <?php if (!empty($success_msg)) { ?>
                    <div class="success-message">
                        <?php echo $success_msg; ?>
                    </div>
                <?php } ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" required placeholder="Enter your first name"><br><br>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" required placeholder="Enter your last name"><br><br>
                    </div>      
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required placeholder="Enter your email address"><br><br>
                    </div>
                    <div class="form-group">
                        <label for="username">Create Username</label>
                        <input type="text" id="username" name="username" required placeholder="Choose a username"><br><br>
                    </div>
                    <div class="form-group">
                        <label for="password">Create Password</label>
                        <input type="password" id="password" name="password" required placeholder="Choose a secure password"><br><br>
                    </div>
                    <button type="submit" name="create" class="submit-button">Create Account</button>
                </form>
                <div class="auth-footer">
                    <p>Already have an admin account? <a href="../index.php">Log in here</a></p>
                </div>
            </div>
        </div>
    </body>
</html>
                        