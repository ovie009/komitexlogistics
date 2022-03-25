<?php
    session_start();
    include_once "includes/class-autoloader.inc.php";
    if (isset($_SESSION['komitexLogisticsEmail'])) {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="rgb(7, 66, 124)">
    <title>Komitex Logistics</title>
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/signup.css">
    <link rel="shortcut icon" type="image/png" href="icons/logistics/018-motorcycle.png">
    <script src="jquery/jquery-3.4.1.min.js"></script>
</head>
<body>
    <?php
        require "header.php";
    ?>
    <main>
        <section class="front-page-info">
            <h1 id="page-heading">SIGNUP</h1>
            <div class="signup-div">
                <div class="signup-container">
                    <!-- <form action="includes/signup.inc.php" method="POST" id="signup-form">
                        <label for="fullname">Fullname:</label> 
                        <input type="text" id="fullname" name="fullname" placeholder="Fullname" title="Your Fullname e.g. Jane Doe" pattern="([^\s][a-zA-zÀ-ž\s]+)" required>
                        <label for="username">Username:</label> 
                        <input type="text" id="username" name="username" placeholder="username" title="username e.g. Janedoe123" pattern="([^\s][a-zA-z0-9À-ž\s]+)" required>
                        <label for="email">Email address:</label> 
                        <input type="email" id="email" name="email" placeholder="email" title="e.g. komitexlogistics@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        <label for="phone">Phone Number:</label> 
                        <input type="tel" id="phone" name="phone" placeholder="phone-number" title="Your phone-number e.g. 08165266847 or +2348165266847" pattern="[0-9+]{11,}" required>
                        <label for="password">Password:</label> 
                        <input type="password" id="password" name="password" placeholder="password" required>
                        <label for="Rpassword">Retype Password:</label> 
                        <input type="password" id="Rpassword" name="Rpassword" placeholder="Retype password" required>
    
                        <button type="submit" name="signup" id="signup">Signup</button>
                    </form> -->
                    <form action="includes/signup.inc.php" method="POST" id="signup-form"  class="signup-form">
                        
                        <div>
                            <label for="fullname" id="onclick-fullname">Fullname</label> 
                            <input type="text" id="fullname" name="fullname" placeholder="Fullname"  title="Your Fullname e.g. Jane Doe" pattern="([^\s][a-zA-zÀ-ž\s]+)" required>
                        </div>

                        <div>
                            <label for="username" id="onclick-username">Username</label> 
                            <input type="text" id="username" name="username" title="username e.g. Janedoe123" pattern="([^\s][a-zA-z0-9À-ž\s]+)" required>
                        </div>

                        <div>
                            <label for="email" id="onclick-email">Email address</label> 
                            <input type="email" id="email" name="email" title="e.g. komitexlogistics@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        </div>

                        <div>
                            <label for="phone" id="onclick-phone">Phone Number</label> 
                            <input type="tel" id="phone" name="phone" title="Your phone-number e.g. 08165266847 or +2348165266847" pattern="[0-9+]{11,}" required>
                        </div>

                        <div>
                            <label for="password" id="onclick-password">Password</label> 
                            <input type="password" id="password" name="password" required>
                        </div>

                        <div>
                            <label for="Rpassword" id="onclick-Rpassword">Retype Password</label> 
                            <input type="password" id="Rpassword" name="Rpassword" required>
                        </div>
    
                        <button type="submit" name="signup" id="signup">Signup</button>

                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php
        require "footer.php";
    ?>
    <script src="javascript/main.js"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>