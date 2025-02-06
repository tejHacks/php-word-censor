<?php
// Admin login credentials (for demonstration purposes)
$adminUsername = 'admin';
$adminPassword = 'password123';  // Replace with a more secure password

// Admin login verification
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['isAdmin'] = true;
    } else {
        $loginError = "Invalid credentials.";
    }
}

// Check if user is logged in as admin
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    echo '<form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="login">Login</button>
        </form>';
    exit;
}

// Database connection (from your previous code)
$servername = "localhost";
$username = "root";  
$password = "";  
$dbname = "censor_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add a banned word
if (isset($_POST['addWord'])) {
    $newWord = $_POST['newWord'];
    $sql = "INSERT INTO banned_words (word) VALUES ('$newWord')";
    if ($conn->query($sql) === TRUE) {
        echo "New word added successfully.";
    } else {
        echo "Error adding word: " . $conn->error;
    }
}

// Remove a banned word
if (isset($_GET['delete'])) {
    $wordToDelete = $_GET['delete'];
    $sql = "DELETE FROM banned_words WHERE word = '$wordToDelete'";
    if ($conn->query($sql) === TRUE) {
        echo "Word deleted successfully.";
    } else {
        echo "Error deleting word: " . $conn->error;
    }
}

// Fetch banned words
$sql = "SELECT word FROM banned_words";
$result = $conn->query($sql);
$bannedWords = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bannedWords[] = $row['word'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel - Manage Banned Words</h1>

    <!-- Add a Banned Word -->
    <form method="POST">
        <label for="newWord">Add Banned Word:</label>
        <input type="text" id="newWord" name="newWord" required>
        <button type="submit" name="addWord">Add Word</button>
    </form>

    <h2>Current Banned Words</h2>
    <ul>
        <?php foreach ($bannedWords as $word) : ?>
            <li>
                <?= htmlspecialchars($word) ?>
                <a href="?delete=<?= urlencode($word) ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
