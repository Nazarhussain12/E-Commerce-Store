<?php
session_start();
include ('functions/db_connect.php');
$error_msg = '';
if(isset($_POST['login'])){
    $email = $_POST['user_email'];
    $pass = $_POST['user_pass'];
    $sel_user = "select * from admins where user_email='$email' AND user_pass='$pass'";
    $run_user = mysqli_query($con, $sel_user);
    $check_user = mysqli_num_rows($run_user);
    if($check_user==0){
        $error_msg = 'Password or Email is wrong, try again';
    }
    else{
        $_SESSION['user_email'] = $email;
        if(!empty($_POST['remember'])) {
            setcookie('user_email', $email, time() + (10 * 365 * 24 * 60 * 60));
            setcookie('user_pass', $pass, time() + (10 * 365 * 24 * 60 * 60));
        } else {
            setcookie('user_email','' );
            setcookie('user_pass', '');
        }
        header('location:index.php?logged_in=' . urlencode('<span style="color: white; font-weight: bold;">Welcome Nazar Hussain</span><br><br><p style="color: white; font-weight: lighter; font-size:40px;">Welcome back, Administrator! Your dashboard is the command center for all your management needs. Here, you\'ll find everything you need to oversee operations, analyze performance, and make informed decisions. Dive into today\'s insights or get started on new tasks. We\'re here to ensure your experience is seamless and productive.</p>'));

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
  
    <title>Admin Login</title>
    <style>/* Reset some basic elements */
body, h2, h3, div, form {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Use a white background and apply a font */
body {
    
    background-color: #fff;
    font-family: 'Arial', sans-serif;
}

/* Center the login form on the page */
.login_form {
    margin: 90px 400px;
    width: 100%;
    max-width: 530px;
    padding: 15px;
    
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 60vh; /* Full height of the viewport */
}

/* Style the input fields */
.login_form input[type="text"],
.login_form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: none;
}

/* Adjust the placeholder color to a light grey */
.login_form input::placeholder {
    color: #bbb;
}

/* Style the buttons and links */
.login_form input[type="submit"] {
    background-color: #ff5722; /* Orange color */
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.2s;
}

/* Hover effect for buttons */
.login_form input[type="submit"]:hover {
    background-color: #e64a19; /* A shade darker for hover state */
}

/* Styles for the 'Remember me' checkbox */
.form-check {
    align-self: start;
}

.form-check-input {
    margin-right: 5px;
}

.form-check-label {
    font-size: 0.9rem;
    color: #333;
}

/* Error and Success message styling */
.text-danger, .text-primary {
    margin-bottom: 15px;
}

/* Icon in the title */
.login_form .icon {
    color: #ff5722; /* Orange color */
    margin-bottom: 15px;
}

/* Additional media query for larger screens */
@media (min-width: 768px) {
    .login_form {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
        padding: 20px;
    }
}

/* Modify h2, h3 styles */
h2, h3 {
    text-align: center;
    width: 100%;
}

/* Display error messages in red and notifications in orange */
.text-danger {
    color: #dc3545;
}

.text-primary {
    color: #ff5722;
}

/* General spacing and aesthetics for messages */
.text-center {
    text-align: center;
    padding: 10px 0;
}

/* Set a larger margin for top elements */
.m-3 {
    margin: 1rem !important;
}

/* Style for the message container */
div {
    color: #555;
    margin-bottom: 10px;
}
</style>
</head>
<body class="text-center">
    <form class="login_form" action="login.php" method="post">
      
        <h2 class="text-primary"><?php echo @$_GET['logged_out']?></h2>
        <h3 class="m-3">Admin Login </h3>
        <div><?php echo $error_msg;?></div>
        <input type="text" id="user_email" name="user_email"
               value="<?php echo @$_COOKIE['user_email']?>" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" id="user_pass" name="user_pass"
               value="<?php echo @$_COOKIE['user_pass']?>" class="form-control" placeholder="Password" required><br>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <input class="btn btn-lg btn-primary mt-3" type="submit" name="login" value="Sign in">
    </form>

</body>
</html>



