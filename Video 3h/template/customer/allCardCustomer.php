<?php

?>
<h2>Il y a <?php echo $nbCustomers; ?> clients</h2>
<?php foreach ($customer as $customer): ?>
    <div class="cardsCustomer">
        <?php
        require '../template/customer/cardCustomer.php';
        ?>
    </div>
<?php endforeach; ?>
