<?php

?>

<form action="<?php echo $targetForm; ?>"  method="post">
    <?php if (getIdFromCustomer($customer) !== 0) { ?>
            <input type="hidden" name="idCustomer" value="<?php echo getIdFromCustomer($customer);?>">
     <?php  } ?>
    <p>
        <label for="nameCustomer">Nom du client</label>
        <input type="text" id="nameCustomer" name="nameCustomer"
               value="<?php echo getNameFromCustomer($customer); ?>"/>
    </p>
    <p>
        <label for="ageCustomer">Age du client</label>
        <input type="number" id="ageCustomer" name="ageCustomer"
               value="<?php echo getAgeFromCustomer($customer); ?>"/>
    </p>
    <p>
    <label for="isLoyalCustomer">Client fidélisé</label>
    <input type="checkbox" id="isLoyalCustomer" name="isLoyalCustomer"
           value="1"
        <?php if (isLoyalFromCustomer($customer)){?>
        checked
       <?php } ?>
    </p>

    <p><input type="submit" value="Enregistrer"/p>
</form>
