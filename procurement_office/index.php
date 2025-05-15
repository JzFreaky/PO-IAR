<?php
include "pclasses/header.php";
require "../procurement_office/authenticate.php";
?>
<title>Procurement Office Portal</title>
<div class="login-container">
        <div class="login-box">
            <div class="login-left">
                <img src="css/image/IMG_8354_2-1-1-1536x863.jpg" alt="Student Portal" class="whole_background">
                <img src="css/image/po.png" alt="Student Portal" class="background">
            </div>
            <div class="login-right">
            <?php if (!empty($message)) : ?>
                    <div class="error-message"><?php echo $message; ?></div>
                    <?php endif; ?>
                <h1>PROCUREMENT OFFICE PORTAL</h1>
                <form action="" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="student_id" name="username" placeholder="Username" required>
                    <label for="password">Password</label>
                    <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="toggle-password" onclick="togglePassword()">
                        👁️
                    </span>
                </div>
                    <button type="submit">Login</button>
                </form>
                    <div class="terms-and-regulations">
                    <p>
                        <p>By using this service, you understood and agree to the  <a href="termsconditions.php" target="_blank">EVSU Online Services Terms of Use and Privacy Statement</a> </p>
                    </p>
                </div>    
            </div>
        </div>
        <div class="back-home">
            <a href="../">&larr; Back to Homepage</a>
        </div>
    </div>    
</body>
</html>
<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.querySelector('.toggle-password');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.textContent = '🙈'; // Change the icon
        } else {
            passwordField.type = 'password';
            toggleIcon.textContent = '👁️'; // Change the icon back
        }
    }
</script>

