<?php

require_once 'controller.php';
require_once 'repository.php';
require_once 'services.php';
require_once 'validator.php';

while(true){
    echo"\n====== MENU NAVIGATEUR =====\n";
    echo "1- Creer Wallet \n";
    echo "2- Faire Depot \n";
    echo "3- faire Retrait\n";
    echo "4- lister Transactions \n";
    echo "0- Quitter\n";

    $choix = saisir("Votre choix: \n");

    switch($choix){
        case '1':
            declencherCreerWallet();
            break;
        case '2':
            declencherDepot();
            break;
        case '3':
            declencherRetrait();
            break;
        case '4':
        break;
        case '0': exit("Au revoir! \n");
        default :
        echo "Choix invalide,veuillez reessayer! \n";
        break;

    }
}