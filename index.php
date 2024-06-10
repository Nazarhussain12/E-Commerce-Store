<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
error_reporting(0);
ini_set('display_errors', '0');
session_start();
require "functions/functions.php";
?>
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
.cart-modal {
    
    display: none !important;
    position: fixed;
    z-index: 1000; /* High z-index to ensure it's on top */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent black background */
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
    display: flex;
}

.cart-modal-content {
    background-color: #ffffff;
    margin: auto;
    padding: 40px;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
    width: 80%; /* Responsive width */
    max-width: 500px; /* Maximum width */
    text-align: center;
    transition: transform 0.3s ease-out; /* Smooth transition for scaling */
}

.cart-modal-content:hover {
    transform: scale(1.03); /* Slight zoom effect on hover */
}

.close-modal {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    cursor: pointer;
    transition: color 0.3s;
}

.close-modal:hover {
    color: #000000;
}

/* Responsive adjustments */
@media (max-width: 600px) {
    .cart-modal-content {
        width: 90%;
        padding: 20px;
    }

    .close-modal {
        font-size: 24px;
    }
}


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






.gotocart{

background-color:#e64a19;
padding: 8px;
color:#f9f9f9;
border-radius: 50px;

}


.gotocart:hover{
transform: scale(1.2);
}




.content_wrapper {
    display: flex;
    margin: 20px;
}

#sidebar {
    border-radius: 12px;
    width: 340px;
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



/* Add this to your CSS */
.visible {
    display: flex !important;
}





.slider {
    position: relative;
    overflow: hidden;
    width: 100%;
    border-radius: 22px;
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
    border-radius: 22px;
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


</style>
</head>
<body>
    <div class="main_wrapper">
        <div class="header_wrapper">
            <a href="index.php"><img id="logo" src="images/logo.png"></a>
            
        
        <div class="menubar">
            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">All Products</a></li>
                
                <li><a href="cart.php">Cart</a></li>
                <li><a href="./contact/orange/about.html">About Us</a></li>
                <li><a href="index.php#content_area">Explore</a></li>
            </ul>



            <div id="search-container">
    <div id="search-icon">
        <i class="fa fa-search"></i> <!-- Font Awesome search icon -->
    </div>
    <form id="search-form" method="get" action="results.php" style="display: none;">
        <input type="text" name="user_query" placeholder="Search products">
        <input type="submit" name="search" value="Search">
    </form>
</div>


        </div>
<!-- Add to Cart Modal -->
<div id="addCartModal" class="cart-modal">
    <div class="cart-modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <p>Product added to cart!</p>
       
    </div>
</div>


   <?php if(isset($_SESSION['customer_email'])): ?>
                    <?php
                    $user = $_SESSION['customer_email'];
                    $get_img = "select * from customers where cust_email='$user'";
                    $run_img = mysqli_query($con, $get_img);
                    $row_img = mysqli_fetch_array($run_img);
                    $c_image = $row_img['cust_image'] ?? './images/empty.webp';
                    ?>
                    <img src="customer/customer_images/<?php echo $c_image; ?>" alt="User Image" width="50" height="40" style='border: 2px solid white; border-radius: 50%; cursor: pointer;' class="user-image">
                    <div class="dropdown-content">
                        <a href="profile.php">Profile</a>
                        <a href="logout.php">Logout</a>
                    </div>
                <?php else: ?>
                    <img src="./images/empty.webp" alt="User Image" width="50" height="40" style='border: 2px solid white; border-radius: 50%; cursor: pointer;'  class="user-image">
                    <div class="dropdown-content">
                        <a href="customer_login.php">Login</a>
                        <a href="customer_register.php">Register</a>
                    </div>
                <?php endif; ?>

                <div class="menu-container">
    <div class="menu-icon" onclick="toggleDropdown()">︙</div> <!-- Unicode character for vertical ellipsis -->
    <div class="dropdown-content" id="dropdownContent">
        <?php
            if(!isset($_SESSION['customer_email'])){
                echo "<a href='customer_login.php'>Login</a>";
                echo "<a href='my_account.php'>Profile</a>";
                echo "<a href='./admin/index.php'>Login As Admin</a>";
            } else {
                echo "<a href='logout.php'>Logout</a>";
                echo "<a href='my_account.php'>Profile</a>";
                echo "<a href='./admin/index.php'>Login As Admin</a>";
            }
        ?>
    </div>
</div>


        </div>

<br><br>
        <div class="slider">
    <div class="slide active">
        <img src="./images/img0.jpg" alt="Image 1">
    </div>

    
    <div class="slide">
        <img src="./images/img2.jpg" alt="Image 2">
    </div>
    <div class="slide">
        <img src="./images/7a4bf61c-697c-45a0-80fc-c9fefb4167af.jpg" alt="Image 2">
    </div>

    <div class="slide">
        <img src="./images/img8.png" alt="Image 2">
    </div>
    <div class="slide">
        <img src="./images/img9.png" alt="Image 2">
    </div>

    
    <div class="slide">
        <img src="./images/img1.jpg" alt="Image 2">
    </div>

    <div class="slide">
        <img src="./images/img10.jpg" alt="Image 2">
    </div>
    <div class="slide">
        <img src="./images/img11.jpg" alt="Image 2">
    </div>
    <div class="slide">
        <img src="./images/img13.jpg" alt="Image 2">
    </div>
    
    <div class="slide">
        <img src="./images/img6.jpg" alt="Image 2">
    </div>

    <div class="slide">
        <img src="./images/img5.jpg" alt="Image 2">
    </div>
    
    
    <div class="slide">
        <img src="./images/img3.jpg" alt="Image 3">
    </div>
    <div class="slide">
        <img src="./images/img4.jpg" alt="Image 4">
    </div>
    <a class="prev">&#10094;</a>
    <a class="next">&#10095;</a>
</div>

        <br><br><br>
        
        
        <div class="content_wrapper">
            <div id="sidebar">
                <div class="sidebar_title">Categories </div>
                <ul class="cats">
                    <?php getCats(); ?>
                </ul>
                <div class="sidebar_title">Brands </div>
                <ul class="cats">
                    <?php getBrands(); ?>
                </ul>
            </div>
            <div id="content_area">
                <div class="shopping_cart">
                    <?php cart(); ?>
                    <span >
                    
                    <div class="user-welcome-container">
    <?php if(isset($_SESSION['customer_email'])): ?>
        <?php
        $user = $_SESSION['customer_email'];
        
        $get_img = "select * from customers where cust_email='$user'";
        $run_img = mysqli_query($con, $get_img);
        $row_img = mysqli_fetch_array($run_img);
        $c_image = $row_img['cust_image'] ?? './images/empty.webp';
        
        
        $get_user = "SELECT cust_name FROM customers WHERE cust_email='$user'";
        $run_user = mysqli_query($con, $get_user);
        $row_user = mysqli_fetch_array($run_user);
        $c_name = $row_user['cust_name'] ?? 'Guest';
        
        ?>
        <img src="customer/customer_images/<?php echo $c_image; ?>" alt="User Image" class="user-image">
        <div class="formatted-name">
            <?php
            // Assuming formatUserNameFromEmail() is a function you've created
            $formattedName = formatUserNameFromEmail($_SESSION['customer_email']);
            echo 'Welcome back, ' . htmlspecialchars($c_name) . '! We\'re glad to see you here again.';

            ?>
        </div>
        <div class="dropdown-content">
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    <?php else: ?>
        <img src="./images/empty.webp" alt="User Image" class="user-image">
        <div class="formatted-name">Welcome guest!</div>
        <div class="dropdown-content">
            <a href="customer_login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    <?php endif; ?>
</div>



                         <br>
                        <b>
                            Shopping Cart - </b>
                        Total Items: <?php total_items(); ?>
                        Total Price: <?php total_price(); ?>
                        <br><br>
                        <a class="gotocart" href="cart.php">Go to Cart</a>
<br><br>
                  
                    </span>
                </div>
                <div class="products_box">
                    <?php getPro(); ?>
                </div>
                <br><br><br>
                <a href='all_products.php'  class='add-to-cart-button' style='background-color: #ff5722; margin-left:490px; align-items:center; color: white; padding: 9px 11px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; font-size: 16px; transition: background-color 0.3s ease;'>See More</a>
            </div>
        </div>



        <div class="contact-us-section bg-white py-12 px-4 md:px-0">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-semibold text-center mb-6">Contact Us</h2>
        <p class="text-center text-lg mb-10">Have questions? Feel free to reach out.</p>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="contact-info">
                <p><strong>Address:</strong> MNA'z Headquarter-Nust H12, ISLAMBAD 5440</p>
                <p><strong>Email:</strong> support@MNAZ.com</p>
                <p><strong>Phone:</strong> +92 303 523 1963</p>
            </div>
            <div>
         

                    <input type="text" name="name" placeholder="Your Name" class="w-full p-2 rounded border border-gray-300">
                    <input type="email" name="email" placeholder="Your Email" class="w-full p-2 rounded border border-gray-300">
                    <textarea name="message" rows="4" placeholder="Your Message" class="w-full p-2 rounded border border-gray-300"></textarea>
                    <button type="submit" class="w-full bg-daraz-dark hover:bg-daraz text-white p-2 rounded">Send Message</button>
               
            </div>
        </div>
    </div>
</div>






        




        <footer class="p-10 text-sm bg-white">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-8">
      
      <!-- Customer Care Column -->
      <div>
        <h2 class="font-bold mb-3">Customer Care</h2>
        <ul>
          <li><a href="#" class="hover:text-daraz">Help Center</a></li>
          <li><a href="#" class="hover:text-daraz">How to Buy</a></li>
          <li><a href="#" class="hover:text-daraz">Corporate & Bulk Purchasing</a></li>
          <li><a href="#" class="hover:text-daraz">Returns & Refunds</a></li>
          <li><a href="#" class="hover:text-daraz">MNA'zShop</a></li>
          <li><a href="#" class="hover:text-daraz">Purchase Protection</a></li>
          <li><a href="#" class="hover:text-daraz">Pick up Points</a></li>


          <!-- Add other links here -->
        </ul>
      </div>

      <!-- Daraz Column -->
      <div>
        <h2 class="font-bold v mb-3 text-daraz">MNA'z</h2>
        <ul>
          <li><a href="#" class="hover:text-daraz">About Us</a></li>
          <li><a href="#" class="hover:text-daraz">Digital Payments</a></li>
          <li><a href="#" class="hover:text-daraz">Daraz Donates</a></li>
          <li><a href="#" class="hover:text-daraz">Terms & Conditions</a></li>
          <li><a href="#" class="hover:text-daraz">Privacy Policy</a></li>
          <li><a href="#" class="hover:text-daraz">Online Shopping App</a></li>
          <li><a href="#" class="hover:text-daraz">MNA'z Exclusive</a></li>








          <!-- Add other links here -->
        </ul>
      </div>

      <!-- Daraz International Column -->
      <!-- MNA'z International Column -->
<div>
    <h2 style="font-weight: bold; margin-bottom: 1rem;">MNA'z International</h2>
    <ul style="display: flex; list-style: none; padding: 0; gap: 10px;">
        <li style="display: flex; align-items: center;">
            <a href="#"><img src="./images/pak.png" alt="Pakistan Flag" style="height: 30px; width: auto; border-radius: 4px;"></a>
        </li>
        <li style="display: flex; align-items: center;">
            <a href="#"><img src="./images/india.jpeg" alt="India Flag" style="height: 30px; width: auto; border-radius: 4px;"></a>
        </li>
        <li style="display: flex; align-items: center;">
            <a href="#"><img src="./images/afg.png" alt="Afghanistan Flag" style="height: 30px; width: auto; border-radius: 4px;"></a>
        </li>
        <li style="display: flex; align-items: center;">
            <a href="#"><img src="./images/nepal.png" alt="Nepal Flag" style="height: 30px; width: auto; border-radius: 4px;"></a>
        </li>
        <!-- Additional international site links as needed -->
    </ul>
</div>


      <!-- Payment Methods Column -->
      <div>
        <h2 class="font-bold mb-3">Payment Methods</h2>
        <ul class="flex">

        <li><i class="fa-brands fa-cc-visa"></i></li>
        <li><i class="fa-brands fa-cc-mastercard"></i></li>
        <li><i class="fa-brands fa-cc-amex"></i></li>
        <li><i class="fa-brands fa-cc-paypal"></i></li>
        <li><i class="fa-brands fa-cc-discover"></i></li>
          <!-- Payment icons -->
        </ul>
      </div>

<br><br><br>
      <!-- Follow Us Column -->
      <div >
        <h2 class="font-bold mb-3">Follow Us</h2>
        <div class="flex space-x-2">
        <a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a>
        <a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.linkedin.com" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
        <a href="https://www.youtube.com" target="_blank"><i class="fa-brands fa-youtube"></i></a>
        <!-- Add more icons as needed -->
          <!-- Social media icons -->
        </div>
      </div>

    </div>
  </footer>



    </div>



    <script>
let slides = document.querySelectorAll('.slider .slide');
let currentSlide = 0;
const slideInterval = setInterval(nextSlide, 2000); // Change slide every 3 seconds

function nextSlide() {
    goToSlide(currentSlide + 1);
}

function prevSlide() {
    goToSlide(currentSlide - 1);
}

function goToSlide(n) {
    slides[currentSlide].classList.remove('active');
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
}

document.querySelector('.next').addEventListener('click', nextSlide);
document.querySelector('.prev').addEventListener('click', prevSlide);
</script>


<script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            daraz: {
              light: '#f3f3f3',
              DEFAULT: '#ff6000',
              dark: '#e65100',
            },
          },
        },
      },
    }
  </script>




<script>
    // Event listener to toggle the dropdown
    document.addEventListener('DOMContentLoaded', () => {
        const dropdown = document.querySelector('.dropdown');
        const dropdownContent = dropdown.querySelector('.dropdown-content');
        const userImage = dropdown.querySelector('img');

        // Toggle dropdown on image click
        userImage.addEventListener('click', () => {
            dropdownContent.style.display = dropdownContent.style.display === 'none' ? 'block' : 'none';
        });

        // Close the dropdown if clicked outside
        window.addEventListener('click', (event) => {
            if (!dropdown.contains(event.target)) {
                dropdownContent.style.display = 'none';
            }
        });
    });
</script>
<script>
    function toggleDropdown() {
        var dropdownContent = document.getElementById("dropdownContent");
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    }

    // Close the dropdown if clicked outside
    window.addEventListener('click', function(e) {
        if (!document.querySelector('.menu-container').contains(e.target)) {
            document.getElementById("dropdownContent").style.display = 'none';
        }
    });




</script>
<script>
function toggleSearchBar() {
    var form = document.getElementById("search-form");
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "flex";
        form.style.opacity = "1";
        form.style.visibility = "visible";
    } else {
        form.style.opacity = "0";
        form.style.visibility = "hidden";
        setTimeout(function() {
            form.style.display = "none";
        }, 500); // Timeout should match the CSS transition time
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("search-icon").addEventListener("click", toggleSearchBar);
});
</script>
<script>
   document.getElementById('contactForm').addEventListener('submit', function(event) {
    console.log('Form submit handler called');
    event.preventDefault();
    alert('Form submitted! We will handle it here.');
    this.reset();
});

</script>
<script>// Add a class .visible in your CSS file with the following rule:
// .visible { display: flex !important; }
// ... [rest of your JavaScript code]

function showModal(pro_id) {
    var modal = document.getElementById('addCartModal');
    // You can also set any product-specific information here before showing the modal
    // For example, you could set the text inside the modal to show which product was added
    // document.getElementById('modal-product-title').innerText = 'Product ' + pro_id + ' added to cart!';
    modal.classList.add('visible');
    console.log('Modal shown for product ' + pro_id);
}

function closeModal() {
    var modal = document.getElementById('addCartModal');
    modal.classList.remove('visible');
}

// ...

</script>


</body>
</html>