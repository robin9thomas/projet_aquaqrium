<?php
require_once('config.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $date = $_GET['date'];

    $bassin = new bassin();
    $details_bassin = $bassin->getById($id);
    unset($bassin);

    $donnee = new donnee();
    $donnees = !empty($date) ? $donnee->getDataForCsv($id, $date) : $donnee->getByIdForCsv($id);
    unset($donnee);

 

    // Entêtes pour forcer le téléchargement du fichier
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$details_bassin["Nom_bassin"].'-'.date("d-m-y H\Hi").'.csv"');

    // Ouverture du flux de sortie
    $outstream = fopen("php://output", 'w');

    // Entêtes de colonnes
    fputcsv($outstream, array('Date', 'Température', 'PH', 'Nitrate'));

    // Parcourir les données et les écrire dans le fichier CSV
    foreach ($donnees as $donnee) {
        fputcsv($outstream, $donnee);
    }

    // Fermeture du flux de sortie
    fclose($outstream);



}
