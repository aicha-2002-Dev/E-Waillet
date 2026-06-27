<?php

function validerNumero(string $tel, int $long = 9) : int {
    if (strlen($tel) === $long && substr($tel, 0, 1) === '7' && ctype_digit($tel)) {
        return 1;
    }
    return 0;
}

function verifUnicite(array $wallets, string $tel) : int {
    foreach ($wallets as $w) {
        if ($w['telephone'] === $tel) {
            return 0; // Trouvé ! Donc PAS unique
        } 
    }
    return 1; // Unique
}