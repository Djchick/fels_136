<?php
return [
    'user' => [
        'rule' => [
            'name_max' => 50,
            'email_max' => 80,
            'password_min' => 6,
            'role_user' => 1,
            'role_admin' => 2,
        ],
    ],
    'cate' => [
        'rule' => [
            'name_max' => 100,
        ],
    ],
    'pagination' => 3,
    'lesson' => [
        'rule' => [
            'name_max' => 100,
        ],
    ],
]; 