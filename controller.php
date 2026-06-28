<?php

function saisir(string $user): string {
    return trim(readline($user));  
}

function declencherCreerWallet() : void {
    global $wallets;

    echo " \nCREATION DE PORTEFEUILLES  \n";
    $nom = saisir("Votre nom: ");
    $tel = saisir("Votre numero tel: ");
    $code = saisir("Votre code: ");
    $solde = (float)saisir("Votre solde: ");

    $statut = traiterCreationWallet($nom, $tel, $code, $solde, $wallets);
    
    switch ($statut) {
        case 1:
            echo " Succes: le wallet du client est cree!\n";
            break;
        case -1:
            echo " Erreur: le numero de telephone n'est pas valide!\n";
            break;
        case -2:
            echo " Erreur: le code doit comporter 4 chiffres!\n";
            break;
        case -3:
            echo " Erreur: le solde ne peut pas etre negatif!\n";
            break;
        case -4:
            echo " Erreur: le numero telephone existe deja!\n";
            break;
    }
}

function declencherDepot(): void {
    echo " \n--- EFFECTUER UN DÉPÔT ---\n";
    $tel = saisir("Numéro de téléphone : ");
    $montant = (float)saisir("Montant à déposer : ");

    $statut = traiterDepot($tel, $montant);

    switch ($statut) {
        case 1:
            echo " -> Succès : Le dépôt a été effectué avec succès !\n";
            break;
        case -1:
            echo " -> Erreur : Aucun wallet n'est associé à ce numéro de téléphone.\n";
            break;
        case -2:
            echo " -> Erreur : Le montant du dépôt doit être strictement supérieur à 0.\n";
            break;
    }
}

function declencherRetrait() :void{
    echo " \n--- EFFECTUER UN RETRAIT ---\n";
    $tel = saisir("Numero de telephone : ");
    $montant = (float)saisir("Montant a retirer : ");
    $statut = traiterRetrait($tel, $montant);
    switch($statut){
        case 1:
            $frais = calculerFraisRetrait($montant);
            $total = $montant + $frais;
            echo "Succes: le retrait a ete effectue ! \n";
            echo "Montant retiré : " . $montant . " CFA\n";
            echo "Frais appliqués : " . $frais . " CFA\n";
            echo "Total débité : " . $total . " CFA\n";
            break;
        case -1:
            echo "Erreur : Aucun wallet n'est associe a ce num de telephone!\n";
            break;
        case -2:
            echo "Erreur : Le montant du retrait doit etre superieur a 0!\n";
            break;
        case -3;
            $frais = calculerFraisRetrait($montant);
            echo "Erreur : Solde insuffisant !\n";
            break;                 
    }
}