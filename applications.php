<?php
session_start();
require '../db_config.php';
if (!isset($_SESSION['admin_logged'])) { header('Location: index.php'); exit; }
$res = $mysqli->query('SELECT a.*, u.username, j.title FROM applications a JOIN users u ON u.id=a.user_id JOIN jobs j ON j.id=a.job_id ORDER BY a.created_at DESC');
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Applications</title></head><body>
<h1>Applications</h1>
<p><a href="dashboard.php">Back</a></p>
<table border="1"><tr><th>ID</th><th>Job</th><th>Applicant</th><th>Note</th><th>When</th></tr>
<?php while($r=$res->fetch_assoc()): ?>
<tr><td><?php echo $r['id']; ?></td><td><?php echo htmlspecialchars($r['title']); ?></td><td><?php echo htmlspecialchars($r['username']); ?></td><td><?php echo nl2br(htmlspecialchars($r['note'])); ?></td><td><?php echo $r['created_at']; ?></td></tr>
<?php endwhile; ?>
</table>
</body></html>