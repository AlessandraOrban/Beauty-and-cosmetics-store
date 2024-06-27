<?php
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelogin/style.css">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <?php
            if(isset($_SESSION['valid'])) {
                echo "<p>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</p>";
                echo "<a href='index.php'><button class='btn'>Go to shopping!</button></a>";
            } else {
                echo "<p>You are not logged in.</p>";
                echo "<a href='indexlogin.php'><button class='btn'>Login</button></a>";
            }
        ?>
    </div>
</body>
</html>