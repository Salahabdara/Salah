<?php
session_start();
require 'db_config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_type']!=='jobseeker') { echo 'You must be logged in as job seeker to apply.'; exit; }
$job_id = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 0;
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $uid = (int)$_SESSION['user_id'];
    $note = $mysqli->real_escape_string($_POST['note']);
    $stmt = $mysqli->prepare('INSERT INTO applications (job_id, user_id, note, created_at) VALUES (?,?,?,NOW())');
    $stmt->bind_param('iis',$job_id,$uid,$note); $stmt->execute();
    echo '<p>Application submitted.</p><p><a href="job.php?id='.$job_id.'">Back to job</a></p>'; exit;
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Apply</title></head><body>
<h1>Apply to Job</h1>
<form method="post">
<textarea name="note" placeholder="Message to employer (optional)"></textarea><br>
<button type="submit">Send Application</button>
</form>
</body></html>