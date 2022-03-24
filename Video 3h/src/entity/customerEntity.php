<?php

/**
 * créé un client avec ses valeurs par défaut
 *
 * @return array tableau associatif dont chaque clé correspond à une propriété du client
 */


function getInstanceCustomer():array{
    return [
        'id'=> null,
        'name' => null,
        'age' => null,
        'isLoyal' => false,
    ];
}

/**
 * Affecte un nom au client passé en argument
 * @param array $customer le client pour lequel il faut assigner un nom
 * @param string $name le nom à assigner au client passé en argument
 * @return array le client
 */
function setNameToCustomer(array $customer, string $name):array {
    $customer['name'] = $name;
    return $customer;
}

/**
 * Affecte un age au client passé en argument
 * @param array $customer le client pour lequel il faut assigner un age
 * @param int $age le nom à assigner au client passé en argument
 * @return array le client
 */
function setAgeToCustomer(array $customer, int $age):array {
    $customer['age'] = $age;
    return $customer;
}

/**
 * Affecte un statut qui indique si le client est fidélisé ou pas
 * @param array $customer le client pour lequel il faut assigner un age
 * @param bool $isLoyal le nom à assigner au client passé en argument
 * @return array le client
 */
function setIsLoyalToCustomer(array $customer, bool $isLoyal):array {
    $customer['isLoyal'] = $isLoyal;
    return $customer;
}

/**
 * Donne l'id du client passé en argument
 * @param array $customer
 * @return int l'id du client ou 0 s'il n'a pas d'identifiant
 */
function getIdFromCustomer(array $customer):int{
    return (int) $customer['id'];
}

/**
 * Donne l'age du client passé en argument
 * @param array $customer
 * @return int|null l'age du client
 */
function getAgeFromCustomer(array $customer):?int{
    return (int) $customer['age'];
}

/**
 * Donne le nom du client passé en argument
 * @param array $customer
 * @return string|null le nom du client
 */
function getNameFromCustomer(array $customer):?string{
    return $customer['name'];
}

/**
 * Donne le statut fidéisé du client
 * @param array $customer
 * @return bool true si le client est fidélisé, false dans le cas contraire
 */
function IsLoyalFromCustomer (array $customer):bool{
    return $customer['isLoyal'];

}



