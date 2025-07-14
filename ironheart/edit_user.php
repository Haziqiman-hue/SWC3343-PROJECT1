<?php
require 'db.php';

// Check if user ID is passed
if (!isset($_GET['id'])) {
  die("User ID missing.");
}

$id = intval($_GET['id']);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fullname = trim($_POST['fullname']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $membership_plan = trim($_POST['membership_plan']);

  $stmt = $pdo->prepare("UPDATE users SET fullname=?, email=?, phone=?, membership_plan=? WHERE id=?");
  $stmt->execute([$fullname, $email, $phone, $membership_plan, $id]);

  header("Location: admin_dashboard.php");
  exit();
}

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
  die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 40px;
    }
    .form-container {
      max-width: 500px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
    }
    button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #2f00ff;
      color: white;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
<div class="form-container">
  <h2>Edit User</h2>
  <form method="POST">
    <label>Full Name</label>
    <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label>Phone</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>

    <label>Membership Plan</label>
    <input type="text" name="membership_plan" value="<?= htmlspecialchars($user['membership_plan']) ?>" required>

    <button type="submit">Save Changes</button>
  </form>
</div>
</body>
</html>
