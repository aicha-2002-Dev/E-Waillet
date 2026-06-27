<?php

$wallets = [];
$transactions = [];

function trouverWallet(string $telephone) : int {
    global $wallets;
    foreach ($wallets as $index => $wallet) {
        if ($wallet['telephone'] === $telephone) {
            return $index;
        }   
    }
    return -1; 
}

function ajouterWallet(array $nouveauWallet) : void {
    global $wallets;
    $wallets[] = $nouveauWallet;
}

function modifierSolde(int $index, float $nouveauSolde) : void {
    global $wallets;
    $wallets[$index]['solde'] = $nouveauSolde;
}

function ajouterTransaction(array $newTransaction) : void {
    global $transactions;
    $transactions[] = $newTransaction;
}