<?php
return [
    'template' => '2021',
    /*
    |--------------------------------------------------------------------------
    | Folder
    |--------------------------------------------------------------------------
    */
    'folder_tmp' => 'uploads/tmp',
    'folder' => [
        'content' => 'uploads/content',
        'content_thumb' => 'uploads/content/thumbnails',
        'products' => 'uploads/products',
        'products_thumb' => 'uploads/products/thumbnails',
    ],

    'layouts' => [
        'default' => 'default',
        'transparent' => 'transparent',
        'blank' => 'blank',
        'fix' => 'fix',
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    */
    'widgets' => [
        'custom_html' => [
            'name' => 'Custom HTML',
            'description' => 'Tùy chỉnh HTML',
        ],
        'search' => [
            'name' => 'Search',
            'description' => 'Tìm kiếm',
        ],
        'content_list' => [
            'name' => 'List of Content',
            'description' => 'Danh sách bài viết'
        ],
        'content_related_list' => [
            'name' => 'List of Related Content',
            'description' => 'Danh sách bài viết liên quan'
        ],
        'categories_list' => [
            'name' => 'List of Categories',
            'description' => 'Danh sách nhóm bài viết'
        ],
        'products_list' => [
            'name' => 'List of Product',
            'description' => 'Danh sách sản phẩm'
        ],
        'products_categories_list' => [
            'name' => 'Danh sách nhóm product',
            'description' => ''
        ],
        'carousel_bootstrap' => [
            'name' => 'Carousel Bootstrap',
            'description' => 'Slideshow'
        ],
        'navbar' => [
            'name' => 'Menu ngang',
            'description' => 'Navbar'
        ],
        'navbar_vertical' => [
            'name' => 'Menu dọc',
            'description' => 'Navbar Vertical'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins
    |--------------------------------------------------------------------------
    */
    'plugins' => [
        'register_mail' => [
            'name' => 'Đăng ký nhận email',
            'enable' => 0
        ],
        'register_mail_popup' => [
            'name' => 'Đăng ký nhận email',
            'enable' => 0,
            'data' => [
                'phone' => '0948790588'
            ]
        ],
        'register_main_right' => [
            'name' => 'Đăng ký nhận email',
            'enable' => 1,
            'data' => [
                'phone' => '0948790588'
            ]
        ],
        'arrow_up' => [
            'name' => 'Arrow up',
            'enable' => 1
        ],
        'chat_facebook' => [
            'name' => 'Chat facebook',
            'enable' => 0
        ]
    ]
];
