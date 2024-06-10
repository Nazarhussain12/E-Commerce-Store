
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MNA'z</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- ... other head elements ... -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.4/dist/tailwind.min.css" rel="stylesheet">
<!-- Google Font for placeholders -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

body {
    background-color: #f9f9f9;
    color: #333333;
    font-size: 16px;
    line-height: 1.6;
}

a {
    color: #ff5722;
    text-decoration: none;
    transition: color 0.3s;
}

a:hover {
    color: #e64a19;
  
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Montserrat', sans-serif;
    color: #333;
    margin-bottom: 0.5em;
}

ul {
    list-style-type: none;
}





.header_wrapper {
    border-radius: 26px;
    background-color: white;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

#logo {
    max-height: 80px;
}

.menubar {
    position: relative;
    margin-left: 250px;
    align-items: center;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%; /* Adjust width to fill space */
}

#menu {
    display: flex;
    align-items: center;
    margin-right: auto;
}

#form input[type="submit"] {
    background-color: #ff5722; /* Modern color */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    transition: background-color 0.3s, transform 0.2s;
    cursor: pointer;
}

#form input[type="submit"]:hover {
    background-color: #e64a19; /* Darker shade on hover */
    transform: scale(1.05); /* Slight enlargement on hover */
}

/* Adjustments for Search Text Input */
#form input[type="text"] {
    border: 2px solid #ff5722;
    padding: 10px;
    border-radius: 25px;
    border-radius: 5px;
    margin-right: 10px;
    border-radius: 50px;
}

/* Optional: Responsive Adjustments */
@media (max-width: 768px) {
    .header_wrapper, .menubar {
        flex-direction: column;
        align-items: center;
    }
    #menu {
        justify-content: center;
        align-items: center;
    }
}

#menu li {
    margin-right: 20px;
}

#menu a {
    font-weight: 500;
    color: #555;
}

#menu a:hover {
    color: #ff5722;
   
}









.content_wrapper {
    display: flex;
    margin: 20px;
}

#sidebar {
    border-radius: 12px;
    width: 200px;
    margin-right: 20px;
    padding: 20px;
    background-color: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.sidebar_title {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
}

.cats a {
    display: block;
    color: #555;
    padding: 5px 0;
    transition: color 0.3s;
}

.cats a:hover {
    color: #ff5722;
}
#content_area {
    border-radius: 12px;
    flex-grow: 1;
    background-color: white;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.products_box {
    border-radius: 12px;
    display: flex;
    flex-wrap: wrap; /* Allows products to wrap to the next line */
    gap: 20px; /* Space between products */
    justify-content: center; /* Center products horizontally */
}

.single_product {
    border-radius: 12px;
    border: 1px solid #eee;
    padding: 10px;
    text-align: center;
    flex-basis: 200px; /* Base width for each product, they'll grow to fill space */
    flex-grow: 1; /* Allow each product to grow as needed */
    display: flex; /* Flex layout for the contents of each product */
    flex-direction: column; /* Stack elements vertically */
    justify-content: space-between; /* Space out the child elements */
}

.single_product img {
    border-radius: 12px;
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.single_product h3 { /* Style for product titles */
    font-size: 1em;
    margin: 10px 0;
}

.single_product p { /* Style for product descriptions or prices */
    font-size: 0.8em;
    color: #555;
}

/* Styling for buttons or links within .single_product */




.flex {
    display: flex;
    list-style: none;
    padding: 0;
}

.flex li {
    margin-right: 10px; /* Space between icons */
}

.fa-brands {
    font-size: 24px; /* Size of the icons */
    color: #333; /* Icon color, change as needed */
}

.flex {
    display: flex;
    align-items: center;
    gap: 10px; /* Adjust space between icons */
}

.flex a {
    color: #333; /* Icon color, change as needed */
    text-decoration: none;
}

.fa-brands {
    font-size: 24px; /* Adjust size of icons */
    transition: color 0.3s ease;
}

.flex a:hover .fa-brands {
    color: #007bff; /* Change color on hover */
}








.slider {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 500px; /* Adjust as needed */
}

.slider .slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.6s ease;
}

.slider .slide.active {
    opacity: 1;
}

.slider .slide img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* Changed from cover to contain */
    object-position: center; /* Center the image within the slide */
}

/* Next & Prev buttons */
.slider .prev, .slider .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -22px;
    color: white;
    font-weight: bold;
    font-size: 18px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
}

.slider .next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

.slider






.footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px;
    flex-wrap: wrap; /* Allow wrapping for smaller screens */
}

.footer .col {
    flex-basis: 20%; /* Adjust this value based on how many columns you want */
    flex-grow: 1;
    margin-bottom: 20px;
}

.footer .col a {
    display: block;
    text-decoration: none;
    color: #777;
    font-size: 14px;
    margin-bottom: 10px;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .footer {
        flex-direction: column;
    }

    .footer .col {
        width: 100%; /* Full width for smaller screens */
        margin-bottom: 10px;
    }
}


/* Payment Methods Icons - Colorful */
.fa-cc-visa {
    color: #1A1F71; /* Visa color */
}

.fa-cc-mastercard {
    color: #EB001B; /* MasterCard color */
}

.fa-cc-amex {
    color: #2E77BC; /* American Express color */
}

.fa-cc-paypal {
    color: #003087; /* PayPal color */
}

.fa-cc-discover {
    color: #FF6000; /* Discover color */
}






@media (max-width: 768px) {
    .header_wrapper, .menubar, .content_wrapper {
        flex-direction: column;
    }

    #menu {
        flex-direction: column;
        margin-top: 10px;
    }

    #menu li {
        margin-bottom: 10px;
    }

    .content_wrapper {
        flex-direction: column;
    }

    #sidebar {
        width: 100%;
        margin-bottom: 20px;
    }

    #content_area {
        width: 100%;
    }
}



.font-bold-mt-4:hover{
color: #333333;
}




    
        .formatted-name {
        text-align: center; /* Centers the text */
        font-size: 1.5em; /* Makes the font size larger */
        font-weight: 600; /* Makes the font a bit bolder */
        color: #333; /* A dark grey color for better readability */
        padding: 10px 0; /* Adds space above and below the text */
        margin: 0; /* Resets any default margins */
        transition: transform 0.3s ease, color 0.3s ease; /* Smooth transition for hover effects */
        text-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle text shadow for depth */
        display: inline-block; /* Allows the use of transform property */
        width: 100%; /* Ensures it takes full width */
    }

    .formatted-name:hover {
        transform: translateY(-2px); /* Moves the text up slightly on hover */
        color: #ff5722; /* A nice orange hover color */
    }

    /* Responsive font size */
    @media (max-width: 768px) {
        .formatted-name {
            font-size: 1.25em; /* Slightly smaller font size on mobile devices */
        }
    }




    .menu-container {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.menu-icon {
    font-size: 24px; /* Large dots */
}

.menu-container {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.menu-icon {
    font-size: 24px; /* Adjust size as needed */
    line-height: 1; /* Aligns the dots vertically */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}


.user-welcome-container {
    display: flex;
    align-items: center;
}

.user-image {
    border: 2px solid white;
    border-radius: 50%;
    cursor: pointer;
    width: 50px;
    height: 40px;
    margin-right: 10px; /* Space between image and text */
}

.formatted-name {
    margin: 0; /* Adjust as needed */
    /* Other styles for formatted-name */
}

.dropdown-content {
    display: none; /* Hide dropdown by default */
    /* Other styles for dropdown-content */
}

/* ... Other styles ... */

#search-container {
    position: relative;
    display: flex;
    align-items: center;
}

#search-icon {
    margin-right: 15px;
    cursor: pointer;
    font-size: 24px; /* Adjust size as needed */
}

#search-form {
    display: none;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.5s, visibility 0.5s;
    align-items: center; /* To align the input and button */
}

/* ... Other styles ... */

#search-form.visible {
    margin-right: 15px;
    opacity: 1;
    visibility: visible;
}

#search-form {
    display: none;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.5s, visibility 0.5s;
    align-items: center;
    margin-right: 15px;
}

/* Style when the form is visible */
#search-form.visible {
    opacity: 1;
    visibility: visible;
}

/* Style for the input field in the search form */
#search-form input[type="text"] {
    padding: 6px 8px;
    border: 2px solid #ff5722;
    border-radius: 25px;
    margin-right: 10px;
    outline: none;
    transition: all 0.3s ease;
}

/* Style for the search button in the form */
#search-form input[type="submit"] {
    padding: 6px 8px;
    background-color: #ff5722;
    color: white;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Hover effect for the search button */
#search-form input[type="submit"]:hover {
    background-color: #e64a19;
}







.contact-us-section {
    background-color: #fff;
    padding: 3rem 1rem;
}

.contact-us-section h2 {
    color: #333;
    font-size: 1.875rem; /* 30px */
    font-weight: 600;
    margin-bottom: 1.5rem; /* 24px */
}

.contact-us-section p {
    color: #555;
    font-size: 1.125rem; /* 18px */
    margin-bottom: 2.5rem; /* 40px */
}

.contact-us-section input[type="text"],
.contact-us-section input[type="email"],
.contact-us-section textarea {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 0.375rem; /* 6px */
    margin-bottom: 1rem; /* 16px */
}

.contact-us-section button {
    width: 100%;
    padding: 0.5rem;
    background-color: #ff6000;
    color: white;
    border-radius: 0.375rem; /* 6px */
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.contact-us-section button:hover {
    background-color: #e65100;
}

/* Responsive design */
@media (max-width: 768px) {
    .contact-us-section .grid {
        grid-template-columns: 1fr;
    }
}









/* Additional Styles for Product Box */
.products_box {
    background-color: #fff; /* White background */
    padding: 20px;
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    margin-top: 20px; /* Spacing from top content */
}

.products_box table {
    width: 100%; /* Full width */
    border-collapse: collapse; /* Remove gaps between table cells */
}

.products_box th, .products_box td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd; /* Light border for each row */
}

.products_box th {
    background-color: #f3f3f3; /* Light gray background for headers */
}

.products_box img {
    width: 60px; /* Adjust as needed */
    height: auto;
}

.products_box input[type='text'], 
.products_box input[type='submit'], 
.products_box button, 
.products_box a {
    padding: 5px 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    background-color: #ff5722;
    color: white;
    text-decoration: none;
    margin: 5px;
    cursor: pointer;
}

.products_box input[type='text'] {
    width: 50px; /* Adjust as needed */
}

.products_box input[type='submit']:hover,
.products_box button:hover,
.products_box a:hover {
    background-color: #e64a19; /* Darker shade on hover */
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .products_box {
        padding: 10px;
    }

    .products_box th, .products_box td {
        padding: 5px;
    }
}



</style>



</head>

<body>

                    <form action="" method="post" enctype="multipart/form-data">
                        <table >
                            <tr >
                                <th> Remove </th>
                                <th> Product(s) </th>
                                <th> Quantity </th>
                                <th> Unit Price </th>
                                <th> Items Total </th>
                            </tr>
                            <?php
                                $ip = getIp();
                                $total = 0;
                                $sel_price = "select * from cart where ip_add = '$ip'";
                                $run_price = mysqli_query($con,$sel_price);
                                while($cart_row = mysqli_fetch_array($run_price)){
                                    $pro_id = $cart_row['p_id'];
                                    $pro_qty = $cart_row['qty'];
                                    $pro_price = "select * from products where pro_id = '$pro_id'";
                                    $run_pro_price = mysqli_query($con, $pro_price);
                                    while ($pro_row = mysqli_fetch_array($run_pro_price)){
                                        $pro_title = $pro_row['pro_title'];
                                        $pro_image = $pro_row['pro_image'];
                                        $pro_price = $pro_row['pro_price'];
                                        $pro_price_all_items = $pro_price * $pro_qty;
                                        $total += $pro_price_all_items;
                                        ?>
                                        <tr >
                                            <td><input type="checkbox" name="remove[]"
                                                       value="<?php echo $pro_id; ?>"></td>
                                            <td><?php echo $pro_title; ?> <br>
                                                <img src="admin/product_images/<?php echo $pro_image; ?>"
                                                     width="60" height="60">
                                            </td>
                                            <td><input size="2" name="qty[]" value="<?php echo $pro_qty;?>">
                                                <input name="product_id[]" type="hidden" value="<?php echo $pro_id;?>">
                                            </td>
                                            <td><?php echo "Rs " . $pro_price . "/-"; ?></td>
                                            <td><?php echo "Rs " . $pro_price_all_items . "/-"; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>

                            <tr >
                                <td colspan="4"><b>Sub Total:</b></td>
                                <td><?php echo "Rs ".$total."/-"; ?></td>
                            </tr>
                            <tr >
                                <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
                                <td>
    <a href="index.php" class="continue-shopping-button">Continue Shopping</a>
</td>

                                <td>  <a  href="checkout.php">
                                            Checkout</a>
                                      
                                    
                                </td>
                            </tr>
                        </table>
                    </form>
              
</body>
</html>