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
    'custom' => [
        'name' => [
            'required' => 'Le nom est requis',
            'regex' => 'Le nom ne doit pas contenir de chiffres ou de caractères spéciaux',
        ],
        'email' => [
            'required' => 'L\'e-mail est requis',
            'email' => 'Le format de l\'e-mail est invalide',
            'unique' => 'L\'adresse e-mail existe déjà',
        ],
        'password' => [
            'required' => 'Le mot de passe est requis',
            'min' => [
                'string' => 'Le mot de passe doit contenir au moins 8 caractères',
            ],
            'confirmed' => 'La confirmation du mot de passe ne correspond pas',
            'current_password' => 'Le mot de passe saisi est incorrect.',
        ],
        'current_password' => [
            'required' => 'Le mot de passe actuel est requis',
            'current_password' => 'Le mot de passe actuel saisi est incorrect.',
        ],
    ],
    'attributes' => [
        'name' => 'nom',
        'email' => 'e-mail',
        'password' => 'mot de passe',
        'role' => 'rôle',
    ],
];
