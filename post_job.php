<?php
require 'db_config.php';
$errors=[];
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $title = $mysqli->real_escape_string($_POST['title']);
    $company = $mysqli->real_escape_string($_POST['company']);
    $location = $mysqli->real_escape_string($_POST['location']);
    $description = $mysqli->real_escape_string($_POST['description']);
    $apply_email = $mysqli->real_escape_string($_POST['apply_email']);
    if (!$title || !$company) $errors[]='Title and Company required';
    if (empty($errors)) {
        $stmt = $mysqli->prepare('INSERT INTO jobs (title, company, location, description, apply_email, status, created_at) VALUES (?,?,?,?,?,"pending",NOW())');
        $stmt->bind_param('sssss',$title,$company,$location,$description,$apply_email); $stmt->execute();
        echo '<div class="container"><p>Job submitted and is pending admin approval.</p><p><a href="index.php">Back</a></p></div>'; exit;
    }
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Post Job</title><link rel="stylesheet" href="asset/style.css"></head><body>
<div class="header"><h1>Andrew Yemen</h1></div>
<div class="container"><h2>Post a Job (Will be pending approval)</h2><?php if($errors){ foreach($errors as $e) echo '<p style="color:red">'.htmlspecialchars($e).'</p>'; } ?>
<form method="post"><input name="title" placeholder="Job Title"><br><input name="company" placeholder="Company"><br><input name="location" placeholder="Location"><br><input name="apply_email" placeholder="Contact Email"><br><textarea name="description" placeholder="Job description"></textarea><br><button type="submit">Submit Job</button></form></div></body></html>