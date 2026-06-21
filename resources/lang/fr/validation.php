<?php
return [
    'required' => 'Le champ :attribute est requis.',
    'email' => 'Le champ :attribute doit être une adresse e-mail valide.',
    'min' => [
        'string' => 'Le champ :attribute doit contenir au moins :min caractères.',
    ],
    'max' => [
        'string' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
    ],
    'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
    'unique' => 'La valeur du champ :attribute est déjà utilisée.',
    'password' => [
        'letters' => 'Le mot de passe doit contenir au moins une lettre.',
        'mixed' => 'Le mot de passe doit contenir au moins une majuscule et une minuscule.',
        'numbers' => 'Le mot de passe doit contenir au moins un chiffre.',
        'symbols' => 'Le mot de passe doit contenir au moins un symbole.',
        'uncompromised' => 'Le mot de passe fourni est apparu dans une fuite de données. Veuillez choisir un autre mot de passe.',
    ],
    'attributes' => [
        'name' => 'nom',
        'email' => 'e-mail',
        'password' => 'mot de passe',
        'role' => 'rôle',
    ],
];
