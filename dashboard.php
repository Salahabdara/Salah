<?php
session_start();
require '../db_config.php';
if (!isset($_SESSION['admin_logged'])) { header('Location: index.php'); exit; }
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id=(int)$_GET['id']; $action=$_GET['action'];
    if ($action==='approve') { $stmt=$mysqli->prepare("UPDATE jobs SET status='approved' WHERE id=?"); $stmt->bind_param('i',$id); $stmt->execute(); }
    if ($action==='reject') { $stmt=$mysqli->prepare("UPDATE jobs SET status='rejected' WHERE id=?"); $stmt->bind_param('i',$id); $stmt->execute(); }
    header('Location: dashboard.php'); exit;
}
$res = $mysqli->query('SELECT * FROM jobs ORDER BY created_at DESC');
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Dashboard</title><link rel="stylesheet" href="../asset/style.css"></head><body>
<div class="header"><h1>Admin Dashboard</h1></div>
<div class="container"><p><a href="index.php">Back</a></p><h2>Jobs</h2><table border="1" cellpadding="6"><tr><th>ID</th><th>Title</th><th>Company</th><th>Status</th><th>Actions</th></tr><?php while($r=$res->fetch_assoc()): ?><tr><td><?php echo $r['id']; ?></td><td><?php echo htmlspecialchars($r['title']); ?></td><td><?php echo htmlspecialchars($r['company']); ?></td><td><?php echo $r['status']; ?></td><td><a href="dashboard.php?action=approve&id=<?php echo $r['id']; ?>">Approve</a> | <a href="dashboard.php?action=reject&id=<?php echo $r['id']; ?>">Reject</a></td></tr><?php endwhile; ?></table></div></body></html>