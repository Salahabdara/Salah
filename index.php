<?php
session_start();
require '../db_config.php';
if (isset($_POST['username'])) {
    $username = $_POST['username']; $password = $_POST['password'];
    $stmt = $mysqli->prepare('SELECT id, password_hash FROM users WHERE username=? AND type="admin" LIMIT 1');
    $stmt->bind_param('s',$username); $stmt->execute(); $res = $stmt->get_result(); $u = $res->fetch_assoc();
    if ($u && password_verify($password, $u['password_hash'])) { $_SESSION['admin_logged']=true; header('Location: dashboard.php'); exit; } else { $err='Invalid credentials'; }
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Admin Login</title><link rel="stylesheet" href="../asset/style.css"></head><body>
<div class="header"><h1>Andrew Yemen - Admin</h1></div>
<div class="container"><h2>Admin Login</h2><?php if(isset($err)) echo '<p style="color:red">'.htmlspecialchars($err).'</p>'; ?>
<form method="post"><input name="username" placeholder="Username"><br><input name="password" placeholder="Password" type="password"><br><button>Login</button></form></div></body></html>