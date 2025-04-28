<?php
session_start();

require 'include/connToDB.php';
require 'include/url-redirect.php';

$Username = '';
$Email = '';
$Password = '';

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDB();

    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Password_retype = $_POST['Password_retype'];

    if (empty($Username) || empty($Email) || empty($Password) || empty($Password_retype)) {
        $_SESSION['error'] = "All fields are required.";
        redirect('/signup.php');
        exit;
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        redirect('/signup.php');
        exit;
    } elseif ($Password !== $Password_retype) {
        $_SESSION['error'] = "Passwords do not match.";
        redirect('/signup.php');
        exit;
    } else {

        $hashed_pass = password_hash($Password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (Username, Email, Password) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt) {
            die("Statement preparation failed: " . mysqli_error($conn));
        } else {

            mysqli_stmt_bind_param($stmt, "sss", $Username, $Email, $hashed_pass);

            if (mysqli_stmt_execute($stmt)) {
                $CustomerID = mysqli_insert_id($conn);
                redirect(path: '/login.php');
                exit;
            } else {
                die("Error: " . mysqli_error($conn));
            }
        };
    }
}

?>
<html>

<head>
    <title>Sign-up</title>
    <link href="form.css" rel="stylesheet">
</head>

<body>
    <form method="post">
        <img src='images/RolsaLogo.png' alt="Logo">
        <h2>Rolsa Technologies</h2>
        <div>
            <label for="Username">
                <p>Username:</p>
            </label>
            <input name="Username" id="Username" required maxlength=100>
        </div>
        <div>
            <label for="Email">
                <p>Email:</p>
            </label>
            <input name="Email" id="Email" type="email" required maxlength=320>
        </div>
        <div>
            <label for="Password">
                <p>Password:</p>
            </label>
            <input name="Password" id="Password" type="password" required maxlength=255>
        </div>
        <div>
            <label for="Password_retype">
                <p>Confirm Password:</p>
            </label>
            <input name="Password_retype" id="Password_retype" type="password" required maxlength=255>
        </div>
        <p>got an amount?: <a href="login.php">Log in</a></p>
        <?php if (!empty($error)) : ?>
            <p><b><?= htmlspecialchars($error); ?></b></p>
        <?php endif; ?>
        <button type="submit">Sign up</button>
    </form>
</body>

</html>