<?php

require_once '../src/lib/helperController.php';
require_once '../src/entity/customerEntity.php';
require_once ('../src/repositiry/customerRepository.php');

/**
 * Rend la vue qui affiche une fiche client
 */
function showCustomerAction():void{

    $customer  = getCustomerFromParameterId();

    ob_start();
    require_once '../template/customer/cardCustomer.php';
    $data['output'] = ob_get_clean();

    $data['title'] = 'fiche client';
    $data['titlePage'] = 'Fiche client';

    renderView($data);
}

/** Rend la vue qui affiche toute les fiche client */
function showAllCustomerAction():void{
    //récupération des clients
    $customer = readAllCustomer();

    //récupération du nombre de clients
    $nbCustomers = count($customer);

    //temporisation du contenu à injecter dans la vue
    ob_start();
    require_once '../template/customer/allCardCustomer.php';
    $data['output'] = ob_get_clean();

    $data['title'] = 'Liste clients';
    $data['titlePage'] = 'Liste de tous les clients';

    renderView($data);
}
/**
 * Rend la vue avec le formulaire d'ajout d'un client
 */
function formCreateCustomerAction():void{
    //cible du formulaire à passer au template
    $targetForm = 'creation-client.php';

    //on passe au formulaire un nouveau client (afin de preremplir le formulaire avec
    // d'eventuelles valeurs par défaut)
    $customer = getInstanceCustomer();

    //temporisation du contenu à injecter dans la vue
    ob_start();
    require_once '../template/customer/formCustomer.php';
    $data['output']= ob_get_clean();

    //données à transmettre à la vue
    $data['title']='form client';
    $data['titlePage']= 'Formulaire d\'ajout d\'un client';
    
    renderView($data);
}

/**
 * Rend la vue après insertion d'un vouveau client
 */
function createCustomerAction():void{

    //création d'un client à partir des données postées
    $customer = getCustomerFromPostData();


    //insertion en bdd
    createCustomer($customer);

    ob_start();
    echo'<p>Le client a été inséré avec l\'identifiant ' .getIdFromCustomer($customer). '</p>';
    echo '<p><a href = "fiche-client.php?id='.getIdFromCustomer($customer).'">Voir la fiche ce 
client</a></p>';
    $data['output'] = ob_get_clean();

    $data['title'] = 'Nouveau client';
    $data['titlePage'] = 'Résultat de l\'insertion d\'un client';

    renderView($data);
}

/**
 * Rend la vue avec le formulaire de modification d'un client
 */
function formUpdateCustomerAction():void{
$customer = getCustomerFromParameterId();

    $targetForm = 'modification-client.php';

    //temporisation du contenu à injecter dans la vue
    ob_start();
    require_once '../template/customer/formCustomer.php';
    $data['output'] = ob_get_clean();

    //données à transmettre à la vue
    $data['title']= "Modif Client";
    $data['titlePage']= "Formulaire de modification d'un client";

    renderView($data);
}

/**
 * Rend la vue aprés mis à jour d'un client
 */
function updateCustomerAction():void{
    //je récupère un client construit à partir des données du formulaire de modification
    $customerTemp = getCustomerFromPostData();

    //je récupère le client à modifier dans la bdd
    $customer = readCustomer($_POST['idCustomer']);


    //je met à jour le client à modifier ($customer) avec les données du client créées à partir des données postées du formulaire de modification
    $customer = setNameToCustomer($customer, getNameFromCustomer($customerTemp));
    $customer = setAgeToCustomer($customer, getAgeFromCustomer($customerTemp));
    $customer = setIsLoyalToCustomer($customer, isLoyalFromCustomer($customerTemp));

    //mise à jour du client
    updateCustomer($customer);

    ob_start();
    echo '<p> Le client avec l\'identifiant '.getIdFromCustomer($customer).' a été mis à jour</p>';
    echo '<p><a href="fiche-client.php?id='.getIdFromCustomer($customer).'">
Voir la fiche de ce client</a></p>';

    $data['output'] = ob_get_clean();

    //données à transmettre à la vue
    $data['title']= "Client modifié";
    $data['titlePage']= "Résultat de la modification du client";

    renderView($data);
}

/**
 * Rend la vue pour une demande de suppression
 */
function requestDeleteCustomerAction():void {
    //récupérer un client de la base de données nous confirme que ce client existe bien
    $customer = getCustomerFromParameterId();

    //temporisation de sortie
    ob_start();
    echo'<p> Vous êtes sur le point de spprimer définitivement le client ci-dessous. Cette action est 
irréversible.</p>';
    echo '<p><a href="suppression-client.php?id='.getIdFromCustomer($customer).'">
Supprimer définitivement le client</a></p>';
    $data['output']= ob_get_clean();

    //données à transmettre à la vue
    $data['title']= "Demande suppression client";
    $data['titlePage']= "Demande confirmation suppression client";

    renderView($data);
}

/**
 * Rend la vue aprés suppression du client
 */
function deleteCustomerAction(){
    $customer = getCustomerFromParameterId();

    deleteCustomer($customer);

    ob_start();
    echo'<p>Le client est l\'identifiant '.getIdFromCustomer($customer).
        ' a été supprimé définitivement</p>';
    echo '<p><a href="liste-des-clients.php">Voir la liste des clients</a></p>';

    $data['output']= ob_get_clean();

    //données à transmettre à la vue
    $data['title']= "Suppression client";
    $data['titlePage']= "Le client a été supprimé !";

    renderView($data);
}

/**
 * Construit une entité client à partir des données postées par le formulaire de création /maj
 * @return arrayl'entité client
 */
function getCustomerFromPostData(){
    //récupération des données postées
    $name = $_POST['nameCustomer'];
    $age = $_POST['ageCustomer'];
    $isLoyal = isset($_POST['isLoyalCustomer']);

    $customer = getInstanceCustomer();
    $customer = setNameToCustomer($customer, $name);
    $customer = setAgeToCustomer($customer, $age);
    $customer = setIsLoyalToCustomer($customer, $isLoyal);

    return $customer;
}

/**
 * Récupère le client correspondant à l'id passé dans l'url
 */
function getCustomerFromParameterId(){
    if (!isset($_GET['id'])){
        header('location:home.php');
    }
    //on récupère l'id (en estimant que la valeur passer est correcte
    $id = (int)$_GET['id'];

    return readCustomer($id);

}