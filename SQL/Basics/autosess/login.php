<?php
session_start();
require_once "pdo.php";

if (isset($_POST['cancel'])) {
    header("Location: index.php");
    return;
}

if (isset($_POST['email']) && isset($_POST['pass'])) {
    if (strpos($_POST['email'], '@') == false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    }


    $stored_hash = 'php123'; // pw: php123

    $check = $_POST['pass'];
    if ($check == $stored_hash) {
        error_log("Login success ".$_POST['email']);
        $_SESSION['name'] = $_POST['email'];
        header("Location: view.php");
        return;
    } else {
        error_log("Login fail ".$_POST['email']." $check");
        $_SESSION['error'] = "Incorrect password";
        header("Location: login.php");
        return;
    }
}
?>
<html>
<head><title>YAmani Tlili - Login Page</title></head>
<body>
<h1>Please Log In</h1>
<?php
if (isset($_SESSION['error'])) {
    echo('<p style="color:red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
?>
<form method="post">
Email <input type="text" name="email"><br>
Password <input type="password" name="pass"><br>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
For a password hint, view source and find an account and password hint
in the HTML comments.
</body>
</html>
