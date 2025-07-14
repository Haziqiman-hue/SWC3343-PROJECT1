<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - IronHeartFitness</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background: #f8f8f8;
    }

    header {
      background: #2f00ff;
      color: white;
      padding: 20px;
      text-align: center;
    }

    h1 {
      margin: 0;
    }

    .dashboard-container {
      max-width: 1000px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #eee;
    }

    .btn {
      padding: 6px 12px;
      background-color: #2f00ff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
    }

    .btn:hover {
      background-color: #1e00cc;
    }
  </style>
</head>
<body>

<header>
  <h1>Admin Dashboard</h1>
  <p>Manage Registered Members</p>
</header>

<div class="dashboard-container">
  <h2>Registered Users</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Membership</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require 'db.php';
      $stmt = $pdo->query("SELECT * FROM users WHERE role = 'user'");
      while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['fullname']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['membership_plan']}</td>";
        echo "<td>
                <a href='edit_user.php?id={$row['id']}' class='btn'>Edit</a>
                <a href='delete_user.php?id={$row['id']}' class='btn' onclick=\"return confirm('Are you sure?')\">Delete</a>
              </td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
