<?php
return [
    'user' => [
        'rule' => [
            'name_max' => 50,
            'email_max' => 80,
            'password_min' => 6,
            'role_user' => 1,
            'role_admin' => 2,
            'upload_path' => '/uploads/user/images',
            'image_max_size' => 5120,
            'avatar_resize'  => 150,
        ],
    ],
    'cate' => [
        'rule' => [
            'name_max' => 100,
        ],
    ],
    'pagination' => 10,
    'lesson' => [
        'rule' => [
            'name_max' => 100,
        ],
    ],
]; 