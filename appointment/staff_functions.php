
<?php 
$processing="SELECT * FROM tbl_appointment_details INNER JOIN tbl_appointment ON tbl_appointment_details.appointment_id = tbl_cart.cart_id INNER JOIN tbl_product ON tbl_cart.product_id = tbl_product.product_id INNER JOIN tbl_user ON tbl_cart.user_id = tbl_user.user_id WHERE delivery_status ='1' ORDER BY order_id";

                    $processing_result = mysqli_query($conn, $processing);
                    ?>