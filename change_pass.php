<?php
$err_msg = '';
$no_match_err = '';
if(isset($_POST['change_pass'])){
    $user = $_SESSION['customer_email'];
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    $sel_pass = "select * from customers where cust_pass = '$current_pass' 
                  AND cust_email='$user'";
    $run_pass = mysqli_query($con,$sel_pass);
    $check_pass = mysqli_num_rows($run_pass);
    if($check_pass == 0){
        $err_msg = 'Your current Password is wrong';
    }else {
        if ($new_pass != $confirm_pass) {
            $no_match_err = 'Confirm Password do not match!';
        }else{
            $update_pass = "update customers set cust_pass = '$new_pass' where cust_email='$user'";
            $run_update = mysqli_query($con,$update_pass);
            header('location: my_account.php');
        }
    }
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
        padding: 7px 9px;
        margin: 10px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
       
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


.h2{
        font-size: 20px;
        font-weight: bold;

    }
</style>

</head>
<body>
<div><b style="color: red"><?php echo $err_msg;?></b></div>
<div><b style="color: red"><?php echo $no_match_err;?></b></div>

<form action="" method="post">
<h2 class="h2" style="text-align: center"> Change Your Password</h2><br><br><br>

    <table align="center" width="700">
        <tr>
            <td align="right"><b>Enter Current Password:</b></td>
            <td><input type="password" name="current_pass" required></td>
        </tr>
        <tr>
            <td align="right"><b>Enter New Password:</b></td>
            <td> <input type="password" name="new_pass" required></td>
        </tr>
        <tr>
            <td align="right"><b>Confirm Password:</b></td>
            <td><input type="password" name="confirm_pass" required></td>
        </tr>
        <tr align="center">
            <td colspan="3"><input type="submit" name="change_pass" value="Change Password"></td>
        </tr>

    </table>
</form>
</body>
</html>