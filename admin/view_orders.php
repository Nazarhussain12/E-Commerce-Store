<?php
if(!isset($_SESSION['user_email'])){
    header('location: login.php?not_admin=You are not Admin!');
}
?>
<div class="row">
    <div class="col-sm-12">
        <h1>Orders</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order ID</th>
                <th scope="col">Card Number</th>
                <th scope="col">Name on Card</th>
                <th scope="col">Security Code</th>
                <th scope="col">User Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $get_orders = "select * from orders";
            $run_orders = mysqli_query($con, $get_orders);
            $i=0;
            while ($row_orders = mysqli_fetch_array($run_orders)){
                $order_id = $row_orders['order_id'];
                $user_card_number = $row_orders['user_card_number'];
                $name_on_card = $row_orders['name_on_card'];
                $security_code = $row_orders['security_code'];
                $user_email = $row_orders['user_email'];
                ?>
                <tr>
                    <th scope="row"><?php echo ++$i; ?></th>
                    <td><?php echo $order_id; ?></td>
                    <td><?php echo $user_card_number; ?></td>
                    <td><?php echo $name_on_card; ?></td>
                    <td><?php echo $security_code; ?></td>
                    <td><?php echo $user_email; ?></td>
                    <td>
                        <!-- Insert your action buttons and links here -->
                        <!-- Example: Edit or Delete actions -->
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
