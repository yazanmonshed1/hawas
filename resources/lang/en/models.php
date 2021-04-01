<?php

return [
    'blogs' => [
        'singular' => 'Blog',
        'plural' => 'Blogs',
        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'slug' => 'URL',
            'brief' => 'Brief'
        ],
    ],
    'sliders' => [
        'singular' => 'Slider',
        'plural' => 'Sliders',
        'columns' => [
            'id' => 'ID',
            'description' => 'Description',
            'title' => 'Title',
            'image' => 'Media'
        ],
    ],
    'text_books' => [
        'singular' => 'Text book',
        'plural' => 'Text books',
        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'back_cover' => 'Front cover',
            'front_cover' => 'Back cover',
            'description' => 'Description',
            'slug' => 'URL'
        ],
    ],
    'text_book_parts' => [
        'singular' => 'Book part section',
        'plural' => 'Books parts sections',
        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
        ],
    ],
    'digital_books' => [
        'singular' => 'Digital book',
        'plural' => 'Digital books',
        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'intro' => 'Intro',
            'slug' => 'URL',
            'description' => 'Description',
            'grade' => 'Grade',
            'cover_image' => 'Cover image'
        ],
    ],
    'collapses' => [
        'singular' => 'Collapses',
        'plural' => 'Collapse',
        'columns' => [
            'id' => 'ID',
            'title' => 'title',
            'images' => 'Images',
            'description' => 'Description'
        ],
    ],
    'galleries' => [
        'singular' => 'Gallery',
        'plural' => 'Galleries',
        'columns' => [
            'id' => 'ID',
            'images' => 'Images',
        ],
    ],
    'users' => [
        'singular' => 'User',
        'plural' => 'Users',
        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Username',
            'email' => 'E-mail',
            'created_at' => 'Created at',
            'roles' => 'Roles',
            'phone_no' => 'Phone number',
            'grade_id' => 'Grade - school',
            'id_no' => 'Id number',
            'avatar' => 'Avatar',
            'books' => 'Books',
            'grade' => 'Grade',
            'school' => 'School'
        ],
    ],
    'programs' => [
        'singular' => 'Program',
        'plural' => 'Programs',
        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'slug' => 'URL',
            'images' => 'Images'
        ],
    ],
    'messages' => [
        'singular' => 'Message',
        'plural' => 'Messages',
        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'E-mail',
            'phone_number' => 'Phone number',
            'message' => 'Message',
            'image' => 'Image',
            'header_image' => 'Header image',
            'images' => 'Images'
        ]
    ],
    'plays' => [
        'singular' => 'Play',
        'plural' => 'Plays',
        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'slug' => 'URL',
            'image' => 'Header image',
            'header_image' => 'Image',
            'images' => 'Images'
        ]
    ],
    'schools' => [
        'singular' => 'School',
        'plural' => 'Schools',
        'columns' => [
            'id' => 'ID',
            'name' => 'School name',
            'books' => 'Books',
            'username' => 'Username',
            'teachers' => 'Teachers'
        ]
    ],
    'grades' => [
        'singular' => 'Class',
        'plural' => 'Classes',
        'columns' => [
            'id' => 'ID',
            'name' => 'Class name',
            'school' => 'School name',
            'books' => 'Books',
            'teacher' => 'Teacher'
        ]
    ],
    'teachers' => [
        'singular' => 'Teacher',
        'plural' => 'Teachers',
        'columns' => [
            'id' => 'ID',
            'email' => 'Email',
        ]
    ],
    'students' => [
        'singular' => 'Student',
        'plural' => 'Students'
    ]
];
