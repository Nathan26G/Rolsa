<?php

require 'include/connToDB.php';
require 'include/url-redirect.php';

session_start();

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = getDB();

    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM users WHERE Username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        error_log(mysqli_error($conn));
        $_SESSION['error'] = "An error has occurred";
        return;
    }

    mysqli_stmt_bind_param($stmt, "s", $Username);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $users = mysqli_fetch_assoc($result);

    if ($users && password_verify($Password, $users['Password'])) {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
        $_SESSION['Username'] = $users['Username'];
        $_SESSION['CustomerID'] = $users['CustomerID'];
        redirect('/index.php');
    } else {
        $_SESSION['error'] = "Login incorrect";
        redirect('/login.php');
    }
    exit;
}
?>
<html>

<head>
    <title>Login</title>
    <link href="form.css" rel="stylesheet">
</head>

<body>
    <form method="post">
        <img src='images/RolsaLogo.png' alt="Logo">
        <h2>Rolsa Technologies</h2>
        <div>
            <label for="username">
                <p>Username:</p>
            </label>
            <input name="Username" id="Username" required maxlength=100>
        </div>
        <div>
            <label for="Password">
                <p>Password:</p>
            </label>
            <input name="Password" id="Password" type="password" required maxlength=255>
        </div>
        <p>Haven't got an amount?: <a href="signup.php">Sign up</a></p>
        <?php if (!empty($error)) : ?>
            <p><b><?= htmlspecialchars($error); ?></b></p>
        <?php endif; ?>
        <button>Log in</button>
    </form>
</body>

</html>