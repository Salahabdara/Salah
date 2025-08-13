<?php
session_start();
require 'db_config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; $password = $_POST['password'];
    $stmt = $mysqli->prepare('SELECT id, password_hash, type FROM users WHERE username=? LIMIT 1');
    $stmt->bind_param('s',$username); $stmt->execute(); $res = $stmt->get_result(); $u = $res->fetch_assoc();
    if ($u && password_verify($password, $u['password_hash'])) {
        $_SESSION['user_id'] = $u['id']; $_SESSION['user_type'] = $u['type']; $_SESSION['username']=$username;
        header('Location: index.php'); exit;
    } else { $err = 'Invalid credentials'; }
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Login</title></head><body>
<h1>Login</h1>
<?php if(isset($err)) echo '<p style="color:red">'.htmlspecialchars($err).'</p>'; ?>
<form method="post">
<input name="username" placeholder="Username"><br>
<input name="password" placeholder="Password" type="password"><br>
<button>Login</button>
</form>
<p><a href="register.php">Register</a></p>
</body></html>