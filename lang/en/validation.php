<?php
return [
    'required' => 'The :attribute field is required.',
    'email' => 'The :attribute must be a valid email address.',
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'max' => [
        'string' => 'The :attribute must not be greater than :max characters.',
    ],
    'confirmed' => 'The :attribute confirmation does not match.',
    'unique' => 'The :attribute has already been taken.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'custom' => [
        'name' => [
            'required' => 'Name is required',
            'regex' => 'Name must not contain numbers or special characters',
        ],
        'email' => [
            'required' => 'Email is required',
            'email' => 'Email format is invalid',
            'unique' => 'Email already exists',
        ],
        'password' => [
            'required' => 'Password is required',
            'min' => 'Password must be at least 8 characters',
            'confirmed' => 'Password confirmation does not match',
        ],
    ],
    'attributes' => [
        'name' => 'name',
        'email' => 'email',
        'password' => 'password',
        'role' => 'role',
    ],
];
