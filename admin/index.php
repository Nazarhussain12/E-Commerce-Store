<?php
error_reporting(0);
ini_set('display_errors', '0');
session_start();
include ('functions/db_connect.php');
if(!isset($_SESSION['user_email'])){
    header('location: login.php?not_admin=You are not Admin!');
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
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <title>MNA'z Admin Panel</title>
        <title>Admin Panel</title>
        <style>
            /* Base reset */
*,
*::before,
*::after {
    box-sizing: border-box;
}

body, html {
    height: 100%;
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, rgba(0, 0, 0, 0.9), rgba(255, 255, 255, 0.2)), url('./adminimages/img2.jpg') no-repeat center center fixed; 
    background-size: cover;
    color: #fff;
}


.wrapper {
    display: flex;
    align-items: stretch;
}


/* Sidebar styling */
#sidebar {
    min-width: 250px;
    max-width: 250px;
    background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
    color: #333;
    transition: all 0.3s;
    margin-left: -250px;
}

#sidebar.active {
    margin-left: 0;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #ff5722; /* Orange color */
    color: #fff;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
    color: #333;
    transition: 0.3s;
}

#sidebar ul li a:hover {
    color: #ff5722; /* Orange color on hover */
    background: rgba(255, 255, 255, 0.5);
}

#sidebar ul li.active > a,
a[aria-expanded="true"] {
    color: #fff;
    background: #ff5722; /* Orange color for active state */
}

/* Submenu items */
#sidebar ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #6d7fcc;
}

/* Sidebar collapse button */
#sidebarCollapse {
    background: none; /* Remove any background */
    border: none; /* Remove the border */
   
    box-shadow: none;
}

#sidebarCollapse:focus {
    outline: none; /* Remove focus outline */
}
#sidebarCollapse span {
    display: block;
    width: 80%;
    height: 2px;
    margin: 5px auto;
    
    transition: all 0.4s;
}

#sidebarCollapse.active span {
    transform: rotate(45deg) translate(5px, 5px);
}

#sidebarCollapse.active span:nth-of-type(2) {
    opacity: 0;
}

#sidebarCollapse.active span:nth-of-type(3) {
    transform: rotate(-45deg) translate(7px, -6px);
}


#sidebarCollapse .fas.fa-bars {
    color: #ff5722; /* Set the color of the bars */
}
/* Content styling */
#content {
    width: 100%;
    padding: 20px;
    min-height: 100vh;
    transition: all 0.3s;
    position: relative;
    left: 0;
    top: 0;
}

/* Navbar styling */

/* Animations and transitions */
.fadeIn {
    animation-name: fadeIn;
    animation-duration: 1s;
    animation-fill-mode: both;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Adding a shadow to the active content area */
#content.active {
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
    #sidebarCollapse {
        display: none;
    }
    #content {
        padding: 10px;
    }
}

/* Background image for the content area */

/* Styling for headings and messages */
h3 {
    margin-top: 0;
    color: #fff; /* Orange color for headers */
}

.text-primary {
    color:#fff; /* Orange color for primary texts */
}


        </style>
    </head>
    <body>
        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Admin Panel</h3>
                </div>
                <ul class="list-unstyled components">
                    <li>
                        <a href="index.php?insert_product">
                            <i class="fas fa-plus"></i> Insert New Product
                        </a>
                    </li>
                    <li>
                        <a href="index.php?view_products">
                            <i class="fas fa-sitemap"></i> View All Products
                        </a>
                    </li>
                    <li>
                        <a href="index.php?insert_category">
                            <i class="fas fa-plus"></i> Insert New Category
                        </a>
                    </li>
                    <li>
                        <a href="index.php?view_categories">
                            <i class="fas fa-band-aid"></i> View All Categories
                        </a>
                    </li>
                    <li>
                        <a href="index.php?insert_brand">
                            <i class="fas fa-plus"></i> Insert New Brand
                        </a>
                    </li>
                    <li>
                        <a href="index.php?view_brands">
                            <i class="fas fa-toolbox"></i> View All Brands</a>
                    </li>
                    <li>
                        <a href="index.php?view_customers">
                            <i class="fa fa-user-tie"></i> View Customers</a>
                    </li>
                    <li>
                        <a href="index.php?view_orders">
                            <i class="fa fa-shopping-bag"></i> View Orders</a>
                    </li>
                    <li>
                        <a href="index.php?view_payments">
                           
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-sign-out-alt"></i> Admin logout</a>
                    </li>
                </ul>
            </nav>
            <div id="content">
                <nav class="navbar ">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </nav>
                <div class="container">
                    <h2 class="text-center text-primary"><?php echo @$_GET['logged_in']?></h2>
                    <?php
                        if(isset($_GET['insert_product'])){
                            include ('insert_product.php');
                        }
                        else if(isset($_GET['view_products'])){
                            include ('view_products.php');
                        }
                        else if(isset($_GET['edit_pro'])){
                            include ('edit_pro.php');
                        }
                        else if(isset($_GET['del_pro'])){
                            include ('del_pro.php');
                        }
                        else if(isset($_GET['view_categories'])){
                            include ('view_categories.php');
                        }
                        else if(isset($_GET['insert_category'])){
                            include ('insert_category.php');
                        }
                        else if(isset($_GET['edit_cat'])){
                            include ('edit_cat.php');
                        }
                        else if(isset($_GET['del_cat'])){
                            include ('del_cat.php');
                        }
                        else if(isset($_GET['view_brands'])) {
                            include('view_brands.php');
                        }
                        else if(isset($_GET['insert_brand'])) {
                            include('insert_brand.php');
                        }
                        else if(isset($_GET['edit_brand'])) {
                            include('edit_brand.php');
                        }
                        else if(isset($_GET['del_brand'])) {
                            include('del_brand.php');
                        }
                        else if(isset($_GET['view_customers'])){
                            include ('view_customers.php');
                        }
                        else if(isset($_GET['del_customer'])){
                            include ('del_customer.php');
                        }
                        else if (isset($_GET['view_orders'])) {
                            include('view_orders.php'); // The file name should be the one that contains the code to display orders
                        }
                        

                        ?>
                </div>
            </div>
        </div>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script>
           $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

        </script>
    </body>
</html>