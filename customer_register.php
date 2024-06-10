<!DOCTYPE html>
<?php

error_reporting(0);
ini_set('display_errors', '0');
session_start();
require "functions/functions.php";
?>

<?php
if(isset($_POST['register'])){
    global $con;
    $ip = getIp();
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];

    move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

    $insert_c = "insert into customers (cust_ip,cust_name,cust_email,cust_pass,cust_country,cust_city,cust_contact,cust_address,cust_image) 
                  values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
    $run_c = mysqli_query($con,$insert_c);
    $sel_cart = "select * from cart where ip_add='$ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if($check_cart==0){
        $_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }
    else {
        $_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LONDON BAZAAR</title>
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
                url('./images/registerimage.avif') no-repeat center center; /* Image with gradient */
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
/* Input Fields Styling for text, password, file, and dropdowns */
input[type='text'], input[type='password'], input[type='file'], select {
    width: calc(100% - 20px); /* Full width minus padding */
    padding: 7px 10px;
    margin-bottom: 0px;
    border-radius: 8px; /* More rounded edges */
    border: 2px solid #ddd;
    background-color: #f9f9f9; /* Light background */
    box-sizing: border-box;
    transition: border-color 0.3s, box-shadow 0.3s;
}

input[type='text']:focus, input[type='password']:focus, input[type='file']:focus, select:focus {
    border-color: #FDA96D;
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.2);
}

/* Specific styles for file input */
input[type='file'] {
    padding: 8px; /* Adjust padding for file input */
}

/* Specific styles for select dropdown */
select {
    cursor: pointer;
}

/* Style adjustments for other elements */

/* ... (rest of your styles) ... */

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
<body>
    <div class="main_wrapper">
       
       

                    <form action="customer_register.php" method="post" enctype="multipart/form-data">
                        <table >
                            <tr>
                                <td colspan="3"><h2>create an Account </h2></td>
                            </tr>
                            <tr>
                                <td >Name: </td>
                                <td><input type="text" name="c_name" required></td>
                            </tr>
                            <tr>
                                <td >Email: </td>
                                <td>
                                    <input type="text" name="c_email" onkeyup="checkEmail(this.value)" required>
                                    <span id="hint"></span>
                                </td>
                            </tr>
                            <tr>
                                <td >Password: </td>
                                <td><input type="password" name="c_pass" required></td>
                            </tr>
                            <tr>
                            <td>Image: </td>
<td>
    <input type="file" name="c_image" required
           style='width: calc(100% - 20px); padding: 7px 10px; margin-bottom: 0px; border-radius: 8px; border: 2px solid #ddd; background-color: #f9f9f9; box-sizing: border-box; transition: border-color 0.3s, box-shadow 0.3s;'>
</td>

                            </tr>
                            <tr>
                                <td >Country: </td>
                                <td>
                                    <select name="c_country">
                                        <option>Select a Country </option>
                                        <option>Afghanistan </option>
                                        <option>Pakistan</option>
                                        <option>China</option>
                                        <option>Canada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td >City: </td>
                                <td><input type="text" name="c_city" required></td>
                            </tr>
                            <tr>
                                <td >Contact: </td>
                                <td><input type="text" name="c_contact" required pattern=".*"></td>
                            </tr>
                            <tr>
                                <td >Address: </td>
                                <td><input type="text" name="c_address" required></td>
                            </tr>
                            <tr >
                                <td colspan="3"><input type="submit" name="register" value="Create Account"></td>
                            </tr>
                        </table>

                    </form>


            </div>
        </div>
    </div>
    <script>
        function checkEmail(email) {
            if(email==''){
                document.getElementById('hint').innerHTML = "";
            }
            else {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('hint').innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "check_email.php?e="+email);
                xhttp.send();
            }
        }
    </script>
</body>
</html>
