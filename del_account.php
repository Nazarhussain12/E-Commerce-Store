<?php
$user = $_SESSION['customer_email'];
if(isset($_POST['yes'])){
    $del_cust = "delete  from customers where cust_email='$user'";
    mysqli_query($con,$del_cust);
    header('location: logout.php');
}
if(isset($_POST['no'])){
    header('location: my_account.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Account</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }
    .h2{
        font-size: 20px;
        font-weight: bold;

    }

    .form-table {
        width: 100%;
        max-width: 600px;
        margin: 20px auto;
        background-color: #ffffff;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-table th, .form-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .form-table th {
        background-color: #f8f8f8;
    }

    .form-header {
        text-align: center;
        background-color: #007bff;
        color: white;
        padding: 15px 0;
    }

    .form-header h2 {
        margin: 0;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    select,
    input[type="file"] {
        width: 100%;
        padding: 8px;
        margin: 5px 0 15px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: #28a745;
        color: white;
        padding: 14px 20px;
        margin: 10px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-label {
        flex-basis: 30%;
        margin-right: 10px;
    }

    .form-input {
        flex-grow: 1;
    }

    @media screen and (max-width: 600px) {
        .form-row {
            flex-direction: column;
            align-items: stretch;
        }

        .form-label {
            margin-bottom: 5px;
        }
    }
</style>

</head>
<body>
<br>

<br>
<form action="" method="post">
<h2 class="h2" >Do you really want to DELETE your account? </h2><br><br>
    <input type="submit" name="yes" value="Yes I want">
    <input type="submit" name="no" value="No I was Joking">
</form>

    
</body>
</html>