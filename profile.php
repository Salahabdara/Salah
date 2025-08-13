<?php
session_start();
require 'db_config.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$uid = (int)$_SESSION['user_id'];
// fetch profile
$stmt = $mysqli->prepare('SELECT p.*, u.type, u.email FROM profiles p JOIN users u ON u.id=p.user_id WHERE p.user_id=?');
$stmt->bind_param('i',$uid); $stmt->execute(); $res = $stmt->get_result(); $profile = $res->fetch_assoc();
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $display = $mysqli->real_escape_string($_POST['display_name']);
    $bio = $mysqli->real_escape_string($_POST['bio']);
    if ($_FILES && $_FILES.get('resume')){}
    // if jobseeker can upload resume
    if ($_SESSION['user_type'] === 'jobseeker' && isset($_FILES['resume']) && $_FILES['resume']['error']===0) {
        $fname = basename($_FILES['resume']['name']);
        $target = 'uploads/'.time().'_'.preg_replace('/[^A-Za-z0-9_.-]/','_',$fname);
        move_uploaded_file($_FILES['resume']['tmp_name'],$target);
        $stmtu = $mysqli->prepare('UPDATE profiles SET resume_path=? WHERE user_id=?');
        $stmtu->bind_param('si',$target,$uid); $stmtu->execute();
    }
    $stmtu = $mysqli->prepare('UPDATE profiles SET display_name=?, bio=? WHERE user_id=?');
    $stmtu->bind_param('ssi',$display,$bio,$uid); $stmtu->execute();
    header('Location: profile.php'); exit;
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Profile</title></head><body>
<h1>Your Profile</h1>
<p>Username: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
<form method="post" enctype="multipart/form-data">
<input name="display_name" value="<?php echo htmlspecialchars($profile['display_name']); ?>"><br>
<textarea name="bio"><?php echo htmlspecialchars($profile['bio']); ?></textarea><br>
<?php if($_SESSION['user_type']=='jobseeker'): ?>
<p>Upload resume (PDF): <input type="file" name="resume"></p>
<?php if(!empty($profile['resume_path'])): ?>
<p>Current resume: <a href="<?php echo htmlspecialchars($profile['resume_path']); ?>">Download</a></p>
<?php endif; ?>
<?php endif; ?>
<button type="submit">Save Profile</button>
</form>
</body></html>