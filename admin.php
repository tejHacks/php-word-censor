<?php
session_start();
require 'config.php'; // Database connection

// Ensure only admins can access
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Handle adding banned words
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_word'])) {
    $word = trim($_POST['word']);
    if (!empty($word)) {
        $stmt = $conn->prepare("INSERT INTO banned_words (word) VALUES (?)");
        $stmt->bind_param("s", $word);
        $stmt->execute();
    }
}

// Handle deleting banned words
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM banned_words WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header('Location: admin.php');
}

// Fetch banned words
$result = $conn->query("SELECT * FROM banned_words ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Censoring System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Manage Banned Words</h2>
        <form method="post" class="mb-3">
            <div class="input-group">
                <input type="text" name="word" class="form-control" placeholder="Enter word to ban" required>
                <button type="submit" name="add_word" class="btn btn-danger">Add</button>
            </div>
        </form>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Word</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['word']) ?></td>
                        <td>
                            <a href="admin.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
