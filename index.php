<?php
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "censor_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch banned words from the database table(banned_words)
$sql = "SELECT word FROM banned_words";
$result = $conn->query($sql);


$bannedWords = [];
if ($result->num_rows > 0) {
    // Fetch all banned words into an array
    while($row = $result->fetch_assoc()) {
        $bannedWords[] = $row['word'];
    }
} else {
    echo "No banned words found.";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Word Censoring Program</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap-5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="container mt-5">
    <h1 class="text-center">PHP Word Censoring Program</h1>

    <!-- Form for Input Text -->
    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label for="inputText" class="form-label">Enter Text</label>
            <textarea id="inputText" name="inputText" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" name="submit" class="btn btn-primary w-100">Censor Text</button>
        </div>
    </form>
    
    <!-- Display Censored Text -->
    <?php
    if (isset($_POST['submit']) && isset($_POST['inputText'])) {
        $inputText = htmlspecialchars($_POST['inputText']);
        $censoredText = censorText($inputText, $bannedWords);
        echo '<div class="alert alert-primary">Original Text: <strong>' . htmlspecialchars($inputText) . '</strong></div>';
        echo '<div class="alert alert-success">Censored Text: <strong>' . htmlspecialchars($censoredText) . '</strong></div>';
        echo '<a href="words.php" class="btn btn-primary">See the List of Censored Words</a>';
    }

    // Function to censor text
    function censorText($inputText, $bannedWords) {
        foreach ($bannedWords as $word) {
            // Create a regex pattern to match the word (case-insensitive)
            $pattern = '/\b' . preg_quote($word, '/') . '\b/i';
            $inputText = preg_replace($pattern, str_repeat('*', strlen($word)), $inputText);
        }
        return $inputText;
    }
    ?>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
