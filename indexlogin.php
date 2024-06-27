<?php
   session_start();
   include("tutorial/php/config.php");

   if(isset($_POST['submit'])){
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $password = mysqli_real_escape_string($con, $_POST['password']);

      $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Password='$password'") or die("Select Error");
      $row = mysqli_fetch_assoc($result);

      if(is_array($row) && !empty($row)){
         $_SESSION['valid'] = $row['Email'];
         $_SESSION['username'] = $row['Username'];
         $_SESSION['age'] = $row['Age'];
         $_SESSION['id'] = $row['Id'];
         header("Location: index.php");
         exit;
      } else {
         $error_message = "Wrong Email or Password";
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelogin/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <?php
                if(isset($error_message)){
                    echo "<div class='message'><p>$error_message</p></div><br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                }
            ?>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field">
                    <a href="home.php"> Login</a>
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
