<?php
session_start();
require 'db.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: login.html');
    exit();
}


$user_id = $_SESSION['user_id'];


$stmt = $pdo->prepare("SELECT fullname, email, phone, membership_plan, created_at FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "Please Register";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile - IronHeartFitness</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f8f8;
      padding: 40px;
      color: #333;
    }

    .profile-card {
      background: white;
      padding: 40px;
      max-width: 600px;
      margin: 50px auto;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #2f00ff;
    }

    .profile-info {
      margin-top: 30px;
      font-size: 18px;
      line-height: 1.8;
    }

    .back-button {
      display: block;
      margin-top: 30px;
      text-align: center;
      background: #2f00ff;
      color: white;
      padding: 12px;
      text-decoration: none;
      border-radius: 8px;
      width: 100%;
    }

    .back-button:hover {
      background: #1a00b3;
    }
  </style>
</head>
<body>

  <div class="profile-card">
    <h2>My Profile</h2>
    <div class="profile-info">
      <strong>Full Name:</strong> <?= htmlspecialchars($user['fullname']) ?><br>
      <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?><br>
      <strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?><br>
      <strong>Membership Plan:</strong> <?= htmlspecialchars($user['membership_plan']) ?><br>
      <strong>Joined Since:</strong> <?= date("F j, Y", strtotime($user['created_at'])) ?><br>
    </div>

    <a href="index.html" class="back-button">Back to Home</a>
  </div>

</body>
</html>
