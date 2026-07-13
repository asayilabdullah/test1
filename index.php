<?php
require 'config.php';

// Handle new submission (normal form POST, page reloads to show the new row)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['age'])) {
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $age  = (int) $_POST['age'];

    if ($name !== '' && $age > 0) {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (name, age, status) VALUES (?, ?, 0)");
        mysqli_stmt_bind_param($stmt, "si", $name, $age);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Redirect so refreshing the page doesn't resubmit the form
    header("Location: index.php");
    exit;
}

// Fetch all saved users
$result = mysqli_query($conn, "SELECT id, name, age, status FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>نموذج بيانات المستخدمين</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

  <h1>إضافة مستخدم جديد</h1>

  <form method="POST" action="index.php" class="user-form">
    <div class="field">
      <label for="name">الاسم</label>
      <input type="text" id="name" name="name" required>
    </div>
    <div class="field">
      <label for="age">العمر</label>
      <input type="number" id="age" name="age" min="1" required>
    </div>
    <button type="submit">إرسال</button>
  </form>

  <h2>قائمة المستخدمين</h2>

  <table id="users-table">
    <thead>
      <tr>
        <th>الاسم</th>
        <th>العمر</th>
        <th>الحالة</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr data-id="<?php echo $row['id']; ?>">
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo (int) $row['age']; ?></td>
        <td class="status-cell">
          <?php echo $row['status'] ? 'مفعّل (1)' : 'غير مفعّل (0)'; ?>
        </td>
        <td>
          <button class="toggle-btn" data-id="<?php echo $row['id']; ?>">Toggle</button>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</div>

<script src="script.js"></script>
</body>
</html>
