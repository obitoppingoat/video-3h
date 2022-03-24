<?php
?>
<div>
    <h2><?php echo getNameFromCustomer($customer); ?></h2>
    <p>
        <?php if (getIdFromCustomer($customer)=== 0){?>
            Ce client n'est pas enregistré dans la bdd
        <?php } else { ?>
            Client enregistré sous le numéro <?php echo getIdFromCustomer($customer); ?>
        <?php } ?>
    </p>

    <p>Age <?php echo getAgeFromCustomer($customer); ?></p>
<p>
    <?php if (isLoyalFromCustomer($customer)) {?>
    Client fidélisé
    <?php } else {?>
    Il faut fidéliser ce client
    <?php } ?>
</p>
    <p>
        <a href="formulaire-modification-client.php?id=<?php echo getIdFromCustomer($customer);
        ?>">Modifier les informations de ce client</a>
    </p>
    <p>
        <a href="demande-supression-client.php?id=<?php echo getIdFromCustomer($customer);
        ?>">Supprimer le client</a>
    </p>
</div>
