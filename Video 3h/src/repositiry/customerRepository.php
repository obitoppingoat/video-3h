<?php

require_once '../src/lib/helperRepository.php';
/**
 * Récupère le client depuis la base de données à partir de son identifiant
 * @param int $id identifiant du client
 * @return array une entité client
 */


function readCustomer(int $id):array{
    global $globalConnexion;
    connectToDatabase();

    $query = $globalConnexion->prepare('SELECT * FROM customer WHERE id = :id');
    $query -> bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();

    $customer = $query->fetch(PDO::FETCH_ASSOC);
    $customer = dataTransformerToCustomer($customer);
    return $customer;


}

/**
 * Insère un client dans la base de données
 * @param array $customer client à insérer en bdd. Le passage du client est fait par référence ce qui veut dire que
 * le programme appelant aura la variable utilisée en argument qui sera automatiquement 'mise à jour"
 */

function createCustomer(array &$customer):void {

    global $globalConnexion;
    connectToDatabase();
    $query = $globalConnexion->prepare('INSERT INTO customer VALUES (NULL,:name,:age,:isLoyal)');
    $query->bindValue(':name', getNameFromCustomer($customer),PDO::PARAM_STR);
    $query->bindValue(':age', getAgeFromCustomer($customer), PDO::PARAM_INT);
    $query->bindValue('isLoyal', isLoyalFromCustomer($customer),PDO::PARAM_BOOL);

    $executeIsOk = $query->execute();

    //récupération de l'id du client inséré
    $id = (int) $globalConnexion->lastInsertId();

    $customer = readCustomer($id);

}

/**
 * @return array tableau dont chaque valeur est une entité client [pour rappel une entité client est un tableau)
 */
function readAllCustomer():array{
    global $globalConnexion;
    ConnectToDatabase();

    $query = $globalConnexion->query('SELECT * FROM customer');

    $customers = [];
    while($customer = $query->fetch(PDO::FETCH_ASSOC)){
        $customers[]=dataTransformerToCustomer($customer);
    }
    return $customers;
}

/**
 * Met à jour le client passé en argument dans la bdd
 * @param $customer le client mis à jour
 * @return bool true en cas de succès, false dans le cas contraire
 */
function updateCustomer(array $customer):bool {
    global $globalConnexion;
    connectToDatabase();

    $query = $globalConnexion->prepare('UPDATE customer SET name=:name, age=:age, is_loyal=:isLoyal WHERE id=:id');

    $query->bindValue(':id', getIdFromCustomer($customer), PDO::PARAM_INT).
    $query->bindValue(':name', getNameFromCustomer($customer), PDO::PARAM_STR).
    $query->bindValue(':age', getAgeFromCustomer($customer), PDO::PARAM_INT);
    $query->bindValue(':isLoyal', IsLoyalFromCustomer($customer), PDO::PARAM_BOOL);

    $executeIsOk = $query->execute();

    return $executeIsOk;
}

/**
 * Supprime un client de la bdd
 * @return bool true succès de la suppression, false dans le cas contraire
 */
function deleteCustomer(array $customer):bool {
    global $globalConnexion;
    connectToDatabase();

    $query = $globalConnexion->prepare('DELETE FROM customer WHERE id=:id');
    $query->bindValue(':id', getIdFromCustomer($customer), PDO::PARAM_INT);

    $executeIsOk= $query->execute();

    return $executeIsOk;
}
/**
 * Transforme le client issu de la bdd en client compatible avec l'appli
 * Cela est nécessaire car des colones utilisées dasn la table "customer" peuvent être différentes des clés
 * utilisées par l'entité "customer"
 * @param array $customerFromSource
 * @return array
 */
function dataTransformerToCustomer(array $customerFromSource):array{
    $customer = getInstanceCustomer();

    $customer['id'] = $customerFromSource ['id'];

    $customer = setNameToCustomer($customer, $customerFromSource['name']);
    $customer = setAgeToCustomer($customer, $customerFromSource['age']);
    $customer = setIsLoyalToCustomer($customer, $customerFromSource['is_loyal']);

    return $customer;
}