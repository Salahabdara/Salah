<?php
require 'db_config.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $mysqli->real_escape_string($_POST['username']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $type = $_POST['type'] === 'employer' ? 'employer' : 'jobseeker';
    $password = $_POST['password'];
    if (!$username || !$email || !$password) $errors[] = 'All fields required';
    $exists = $mysqli->prepare('SELECT id FROM users WHERE username=? OR email=? LIMIT 1');
    $exists->bind_param('ss',$username,$email); $exists->execute(); $er = $exists->get_result();
    if ($er->num_rows) $errors[] = 'Username or email already taken';
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare('INSERT INTO users (username, email, password_hash, type, created_at) VALUES (?,?,?,?,NOW())');
        $stmt->bind_param('ssss',$username,$email,$hash,$type);
        $stmt->execute();
        $uid = $mysqli->insert_id;
        // create empty profile
        $stmt2 = $mysqli->prepare('INSERT INTO profiles (user_id, display_name) VALUES (?,?)');
        $stmt2->bind_param('is',$uid,$username); $stmt2->execute();
        echo '<p>Registered. <a href="login.php">Login here</a></p>'; exit;
    }
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Register - Andrew Yemen</title></head><body>
<h1>Register</h1>
<?php if($errors){ foreach($errors as $e) echo '<p style="color:red">'.htmlspecialchars($e).'</p>'; } ?>
<form method="post">
<input name="username" placeholder="Username"><br>
<input name="email" placeholder="Email"><br>
<input name="password" placeholder="Password" type="password"><br>
<select name="type"><option value="jobseeker">Job Seeker</option><option value="employer">Employer</option></select><br>
<button type="submit">Register</button>
</form>
</body></html>