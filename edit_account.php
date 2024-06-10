<?php
    $user = $_SESSION['customer_email'];
    $get_cust = "select * from customers where cust_email='$user'";
    $run_cust = mysqli_query($con, $get_cust);
    $row_cust = mysqli_fetch_array($run_cust);
    $c_id = $row_cust['cust_id'];
    $name = $row_cust['cust_name'];
    $email = $row_cust['cust_email'];
    $pass = $row_cust['cust_pass'];
    $country = $row_cust['cust_country'];
    $city = $row_cust['cust_city'];
    $image = $row_cust['cust_image'];
    $contact = $row_cust['cust_contact'];
    $address = $row_cust['cust_address'];

if(isset($_POST['update'])){
    $customer_id = $c_id;
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];

    move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

    $update_c = "update customers set cust_name='$c_name',cust_email='$c_email',
                cust_pass='$c_pass',cust_city='$c_city',
                cust_contact='$c_contact',cust_address='$c_address',cust_image='$c_image'
                where cust_id = '$customer_id'";
    $run_update_c = mysqli_query($con,$update_c);
    if($run_update_c){
        header('location: my_account.php?edit_account');
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
<form action="" method="post" enctype="multipart/form-data">
    <table width="600">
        <tr align="center">
            <td colspan="2"><h2>Update your Account </h2></td>
        </tr>
        <tr>
            <td align="right">Name: </td>
            <td><input type="text" name="c_name" value="<?php echo $name;?>" required></td>
        </tr>
        <tr>
            <td align="right">Email: </td>
            <td><input  type="text" name="c_email" value="<?php echo $email;?>" required></td>
        </tr>
        <tr>
            <td align="right">Password: </td>
            <td><input type="password" name="c_pass" value="<?php echo $pass;?>" required></td>
        </tr>
        <tr>
            <td align="right">Image: </td>
            <td><input type="file" name="c_image" required>
                <img src="customer/customer_images/<?php echo $image?>" width="50" height="50px"></td>
        </tr>
        <tr>
            <td align="right">Country: </td>
            <td>
                <select name="c_country" disabled>
                    <option value="<?php  echo $country;?>" > <?php  echo $country;?> </option>
                    <option value="Afghanistan">Afghanistan </option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="China">China</option>
                    <option value="Canada">Canada</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">City: </td>
            <td><input type="text" name="c_city" value="<?php echo $city;?>"></td>
        </tr>
        <tr>
            <td align="right">Contact: </td>
            <td><input type="text"  name="c_contact" required  value="<?php echo $contact;?>"></td>
        </tr>
        <tr>
            <td align="right">Address: </td>
            <td><input  type="text" name="c_address" value="<?php echo $address;?>"></td>
        </tr>
        <tr align="center">
            <td colspan="2"><input type="submit" name="update" value="Update Account"></td>
        </tr>
    </table>

</form>

</body>
</html>