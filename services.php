<?php

function traiterCreationWallet(string $nom, string $tel, string $code, float $solde, array $walletActu) : int {
    if (validerNumero($tel) === 0) {
        return -1;
    }
    
    // CORRECTION : "!" pour vérifier que ce sont bien uniquement des chiffres
    if (strlen($code) !== 4 || !ctype_digit($code)) {
        return -2;
    }
    
    if ($solde < 0) {
        return -3;
    }
    
    if (verifUnicite($walletActu, $tel) === 0) {
        return -4;
    }

    $nouveauWallet = [
        'nom' => $nom,
        'telephone' => $tel,
        'code' => $code,
        'solde' => $solde
    ];
    
    ajouterWallet($nouveauWallet);
    return 1;
}

function traiterDepot(string $tel, float $montant) : int {
    $index = trouverWallet($tel);
    if ($index === -1) {
        return -1; 
    }
    if ($montant <= 0) {
        return -2; 
    }

    global $wallets;
    $ancienSolde = $wallets[$index]['solde'];
    $nouveauSolde = $ancienSolde + $montant;

    modifierSolde($index, $nouveauSolde);

    $transaction = [
        'numero' => $tel,
        'type'   => 'depot',
        'montant'=> $montant
    ];

    ajouterTransaction($transaction);
    return 1;
}