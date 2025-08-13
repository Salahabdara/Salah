<?php
require 'db_config.php';
$id = isset($_GET['id'])?(int)$_GET['id']:0;
$stmt = $mysqli->prepare("SELECT * FROM jobs WHERE id=? AND status='approved'"); $stmt->bind_param('i',$id); $stmt->execute(); $res = $stmt->get_result(); $job = $res->fetch_assoc();
if (!$job) { echo 'Job not found or not approved.'; exit; }
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title><?php echo htmlspecialchars($job['title']); ?></title><link rel="stylesheet" href="asset/style.css"></head><body>
<div class="header"><h1>Andrew Yemen</h1></div>
<div class="container">
<h2><?php echo htmlspecialchars($job['title']); ?></h2>
<p><strong>Company:</strong> <?php echo htmlspecialchars($job['company']); ?></p>
<p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
<p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
<p><a href="index.php">Back</a></p>
</div></body></html>