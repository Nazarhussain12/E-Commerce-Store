

<?php

error_reporting(0);
ini_set('display_errors', '0');
session_start();
require "functions/functions.php";
?>
<?php
if(isset($_POST['login']))
{
    global $con;
    $ip = getIp();
    $c_email = $_POST['email'];
    $c_pass = $_POST['pass'];
    $sel_c = "select * from customers where cust_pass = '$c_pass' AND cust_email = '$c_email'";
    $run_c = mysqli_query($con,$sel_c);
    $check_c = mysqli_num_rows($run_c);
    if($check_c==0){
        header('location:'.$_SERVER['PHP_SELF']);
        exit();
    }
    $sel_cart = "select * from cart where ip_add='$ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if($check_c > 0 && $check_cart ==0){
        $_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }else{
        echo "here2";
        $_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }
}
?>
<html>
    <head>
<title>MNA'z</title>

    <style>
 /* Base Styles */
body {
    font-family: 'Open Sans', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    color: #333;
    position: relative; /* Needed for absolute positioning of pseudo-element */
    background: linear-gradient(to right, rgba(109, 213, 237, 0.1), rgba(33, 147, 176, 0.1)), 
                url('./images/loginimage.avif') no-repeat center center; /* Image with gradient */
    background-size: cover; /* Ensure background covers the entire viewport */
}

body::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    backdrop-filter: blur(10px); /* Blurry effect */
    z-index: -1; /* Place the pseudo-element behind the content */
}


/* Styling the Form */
form {

justify-content: center;
align-items: center;
background: white;
border-radius: 20px; /* Rounded borders */
box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); /* Deeper box-shadow for 3D effect */
padding: 20px;
min-width: 350px;
min-height: 400px;
animation: formEntry 0.5s ease-out forwards;
overflow: hidden; /* Hide overflow for inner elements */
}
@keyframes formEntry {
    0% { opacity: 0; transform: scale(0.9); }
    100% { opacity: 1; transform: scale(1); }
}

/* Table Styling - Removed for modern design */
table {
    width: 100%;
    border-collapse: collapse;
}

h2 {
    font-size: 24px; /* Larger font size */
    font-weight: 600; /* Bold font weight */
    color: #1a1a1a; /* Darker color for contrast */
    text-align: center;
    margin-bottom: 30px;
}

td {
    padding: 6px;
    text-align: left;
}

/* Input Fields Styling */
input[type='text'], input[type='password'] {
    width: calc(100% - 20px); /* Full width minus padding */
    padding: 7px 10px;
    margin-bottom: 15px;
    border-radius: 8px; /* More rounded edges */
    border: 2px solid #ddd;
    background-color: #f9f9f9; /* Light background */
    box-sizing: border-box;
    transition: border-color 0.3s, box-shadow 0.3s;
}

input[type='text']:focus, input[type='password']:focus {
    border-color:  #FDA96D;
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.2);
}

/* Button Styling */
input[type='submit'] {
    width: calc(100% - 20px); /* Full width minus padding */
    padding: 12px 10px;
    background: linear-gradient(to right, #FF5722, #FDA96D); /* Gradient background */
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: background 0.3s;
}

input[type='submit']:hover {
    background: linear-gradient(to right, #FDA96D, #FF5722);
}

/* Additional Links */
a {
    display: block; /* Full-width links */
    text-align: center;
    margin-top: 10px;
    color: #007bff;
    transition: color 0.3s;
    text-decoration: none;
}

a:hover {
    color: #0056b3;
}

/* Responsive Design */
@media (max-width: 600px) {
    form {
        width: 90%;
        padding: 20px;
    }
}


    </style>
    </head>
<div>
    <form method="post" action="">
        <table>
            <tr >
                <td colspan="2"><h2>Login or Register to Buy!</h2></td>
            </tr>
            <tr>
                <td ><b>Email: </b></td>
                <td><input type="text" name="email"  placeholder="Enter email" required></td>
            </tr>
            <tr>
                <td ><b>Password:</b></td>
                <td><input type="password" name="pass" placeholder="Enter password" required></td>
            </tr>
            <tr >
                <td colspan="2"><a href="checkout.php?forgot_pass">Forgot Password? </a></td>
            </tr>
            <tr >
                <td colspan="2"><input type="submit" name="login" value="Login"></td>
            </tr>
        </table>
        <h2 >
            <a  href="customer_register.php">Register Here</a>
        </h2>
    </form>
</div>
</html>