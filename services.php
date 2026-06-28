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


function calculerFraisRetrait(float $montant) :float {
    if ($montant <= 10000){
        return 200.0;
    }

    if ($montant <= 100000){
        return 500.0;
    }

    if ($montant > 100000){
        $frais = $montant * 0.01;
        if ($frais > 5000){
            return 5000.0;
        }
        return $frais;
    }
}
function traiterRetrait(string $tel, float $montant) :int {

    $index = trouverWallet($tel);
    if ($index === -1){
        return -1;
    }
    if ($montant <= 0){
        return -2;
    }
    $frais = calculerFraisRetrait($montant);
    $totalADebiter = $montant + $frais;

    global $wallets;
    $soldeActuel = $wallets[$index]['solde'];
    if($totalADebiter > $soldeActuel){
        return -3;
    }
    $nouveauSolde = $soldeActuel - $totalADebiter;
    modifierSolde($index,$nouveauSolde);

    $transaction = [
        'numero' => $tel,
        'type'   => 'retrait',
        'montant'=> $montant,
        'frais' => $frais
    ];
    ajouterTransaction($transaction);

    return 1;
    
}