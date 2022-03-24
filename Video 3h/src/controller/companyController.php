<?php

require_once '../src/lib/helperController.php';

/*Acceuil*/
function indexAction():void{
    $data['title'] = 'accueil';
    $data['titlePage'] = 'Acceuil';

    ob_start();
    require_once '../template/company/home.php';
    $data['output'] = ob_get_clean();
    renderView($data);
}


/*Contact*/
function contactAction():void{
    $data['title'] = 'contact';
    $data['titlePage'] = 'Contact';
    $phone = '0123456987';

    ob_start();
    require_once '../template/company/contact.php';
    $data['output'] = ob_get_clean();
    renderView($data);
}
