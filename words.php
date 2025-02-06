<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "";  // Change if needed
$dbname = "censor_db";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch banned words from the database
$sql = "SELECT word FROM banned_words";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banned Words List</title>
    <link rel="stylesheet" href="assets/bootstrap-5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Banned Words List</h1>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Word</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$count}</td><td>" . htmlspecialchars($row['word']) . "</td></tr>";
                    $count++;
                }
            } else {
                echo "<tr><td colspan='2' class='text-center'>No banned words found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
