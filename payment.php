<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



require './phpmailer/PHPMailer-master/src/Exception.php';
require './phpmailer/PHPMailer-master/src/PHPMailer.php';
require './phpmailer/PHPMailer-master/src/SMTP.php';
require_once "functions/functions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$paymentProcessed = false;

// At the top of your script, after session_start();
$userName = $_SESSION['cust_name'] ?? 'Valued Customer'; // Replace with actual session variable or database call
$total = $_SESSION['total'] ?? '0'; // Replace with actual session variable or database call
$orderNumber = $_SESSION['order_number'] ?? rand(100000, 999999); // Generate a random number for order number if not set


if (isset($_POST['submit_payment'])) {
    global $con;
    $userEmail = $_SESSION['customer_email'] ?? ''; // Fallback to an empty string if not set
    $userCardNumber = $_POST['user_card_number'];
    $nameOnCard = $_POST['name_on_card'];
    $securityCode = $_POST['security_code'];
    $orderTotal = total_price1();
    $totalItems =total_items1();

    // Validate inputs as necessary before inserting them into the database

    // Insert into database
    $query = "INSERT INTO orders (user_email, user_card_number, name_on_card, security_code) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssss", $userEmail, $userCardNumber, $nameOnCard, $securityCode);
    $result = $stmt->execute();

    if ($result) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nazarliaqat123@gmail.com';
            $mail->Password = 'kzrlrgfynrowqhej';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $nameOnCard = htmlspecialchars(strip_tags($nameOnCard));
            //Recipients
            $mail->setFrom('nazarliaqat123@gmail.com', ' MNA\'z International');
            $mail->addAddress($userEmail, 'User'); // Add a recipient, Name is optional

           // Content
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = 'Order Confirmation from MNA\'z';
$mail->Body    = "
    <html>
        <head>
            <title>Order Confirmation</title>
        </head>
        <body>
            <h1>Thank you for your order, {$nameOnCard}!</h1>
            <p>We are thrilled to inform you that your order #{$orderNumber} has been successfully placed with MNA'z. We are preparing it with care and will notify you once it is shipped.</p>
            <h2>Order Details:</h2>
            <p><strong>Order Price:</strong> Rs {$orderTotal}/-</p>
            <p><strong>Total Items:</strong> {$totalItems}</p>
            <p><strong>Order Number:</strong> {$orderNumber}</p>
            <p><strong>Estimated Delivery Date:</strong> 2 to 5 Days</p>
            <p>You can track your order status or manage your order from your account page.</p>
            <p>We are always here to help. If you have any questions or concerns about your order, feel free to contact us at +92 303 5231963.</p>
            <p>Thank you for choosing MNA'z. We hope you enjoy your purchase!</p>
            <p>Warm regards,</p>
            <p><strong>The MNA'z Team</strong></p>
            <p><strong>Nazar Hussain-CEO</strong></p>
        </body>
    </html>";
            $mail->send();
            echo "<div style='text-align: center; border-radius:25px; margin-top: 20px; padding: 50px; background-color: #4CAF50; color: white;'>
            <p style='font-size:25px; font-weight:bold;'>Congratulations! Your order has been placed. Thank You for choosing Us.Hope you had great time shopping with us.A confirmation email has been sent to you. Check your Email.</p>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
           
            $paymentProcessed = true;
        } catch (Exception $e) {
            echo "<script>alert('Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('There was an issue processing your payment.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Payment</title>
    <!-- Include your existing style here -->



    </style>
</head>
<body >
    <div class="container" style="display: flex; justify-content: center; align-items: center; width: 100%; padding: 20px;">
       
<?php if (!$paymentProcessed): ?>
    <div class="min_wrapper" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); width: 300px; margin-right: 20px;">
        <form action="" method="post">
            <h2 style="color: #333; text-align: center; margin-bottom: 20px;">Payment Details</h2>
            <label for="user_card_number" style="display: block; margin-bottom: 5px; color: #333;">Card Number:</label>
            <input type="text" name="user_card_number" required style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
            
            <label for="name_on_card" style="display: block; margin-bottom: 5px; color: #333;">Name on Card:</label>
            <input type="text" name="name_on_card" required style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
            
            <label for="security_code" style="display: block; margin-bottom: 5px; color: #333;">Security Code:</label>
            <input type="text" name="security_code" required style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
            
            <input type="submit" name="submit_payment" value="Make Payment" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s; margin-bottom: 20px;">
        </form>
    </div>
    <?php endif; ?>

    <div class="image_wrapper" style="flex-grow: 1; flex-basis: 40%; max-width: 600px;">
            <img src="./images/cardimg.png" alt="Payment Image" style="width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
        </div>
    </div>
</body>
</html>
