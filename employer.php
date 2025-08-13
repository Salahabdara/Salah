<?php
require 'db_config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $mysqli->prepare('SELECT p.*, u.username FROM profiles p JOIN users u ON u.id=p.user_id WHERE p.user_id=?');
$stmt->bind_param('i',$id); $stmt->execute(); $res = $stmt->get_result(); $emp = $res->fetch_assoc();
if (!$emp) { echo 'Employer not found'; exit; }
$jobs = $mysqli->query('SELECT * FROM jobs WHERE posted_by='.(int)$id.' AND status="approved" ORDER BY created_at DESC');
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title><?php echo htmlspecialchars($emp['display_name']); ?></title></head><body>
<h1><?php echo htmlspecialchars($emp['display_name']); ?></h1>
<p><?php echo nl2br(htmlspecialchars($emp['bio'])); ?></p>
<h2>Jobs by this employer</h2>
<?php while($j = $jobs->fetch_assoc()): ?>
  <div><a href="job.php?id=<?php echo $j['id']; ?>"><?php echo htmlspecialchars($j['title']); ?></a></div>
<?php endwhile; ?>
</body></html>