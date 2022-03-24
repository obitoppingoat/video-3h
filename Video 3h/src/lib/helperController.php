<?php
/**
*Construit la vue à rendre à partir de templates
*
 * @param array $dataPage tableau associatif avec les clés title, titlePage, output, data
 *la clé title concerne le titre à placer dans la balise title
 * la clé titlePage concerne le titre principal de la page à rendre
 * la clé output concerne du contenu placé dans le tampon
 * la clé data contient un tableau associatif dont les clés dont libres (utile pour passer n'importe quelle
 * données aux templates)
 */
function renderView(array $data):void {
    require_once '../template/layout/header.php';
    require_once '../template/layout/menu.php';
    require_once '../template/layout/mainContent.php';
    require_once '../template/layout/footer.php';
}