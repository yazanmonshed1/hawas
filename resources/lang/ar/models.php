<?php

return [
    'blogs' => [
        'singular' => 'مدونة',
        'plural' => 'المدونات',
        'columns' => [
            'id' => 'ID',
            'title' => 'العنوان',
            'image' => 'الصورة',
            'slug' => 'عنوان URL',
            'brief' => 'نبذة مختصرة'
        ],
    ],
    'sliders' => [
        'singular' => 'سلايدر',
        'plural' => 'السلايدرات',
        'columns' => [
            'id' => 'ID',
            'description' => 'الوصف',
            'title' => 'العنوان',
            'image' => 'ميديا'
        ],
    ],
    'text_books' => [
        'singular' => 'كتاب ورقي',
        'plural' => 'الكتب الورقية',
        'columns' => [
            'id' => 'ID',
            'title' => 'العنوان',
            'back_cover' => 'الصورة الامامية',
            'front_cover' => 'الصورة الخلفية',
            'description' => 'الوصف',
            'slug' => 'عنوان URL',
        ],
    ],
    'text_book_parts' => [
        'singular' => 'قسم كتاب ورقي',
        'plural' => 'اقسام الكتب الورقية',
        'columns' => [
            'id' => 'ID',
            'title' => 'العنوان',
        ],
    ],
    'digital_books' => [
        'singular' => 'كتاب رقمي',
        'plural' => 'الكتب الرقمية',
        'columns' => [
            'id' => 'ID',
            'title' => 'العنوان',
            'intro' => 'المقدمة',
            'slug' => 'عنوان URL',
            'description' => 'الوصف',
            'grade' => 'الصف',
            'cover_image' => 'صورة الغلاف'
        ],
    ],
    'collapses' => [
        'singular' => 'كولابس',
        'plural' => 'كولابس',
        'columns' => [
            'id' => 'ID',
            'title' => 'العنوان',
            'images' => 'الصور',
            'description' => 'الوصف'
        ],
    ],
    'galleries' => [
        'singular' => 'معرض',
        'plural' => 'المعارض',
        'columns' => [
            'id' => 'ID',
            'images' => 'الصور',
        ],
    ],
    'users' => [
        'singular' => 'مستخدم',
        'plural' => 'المستخدمين',
        'columns' => [
            'id' => 'ID',
            'name' => 'الاسم',
            'username' => 'اسم المستخدم',
            'email' => 'البريد الالكتروني',
            'created_at' => 'انشئت في',
            'roles' => 'الادوار',
            'phone_no' => 'رقم الهاتف',
            'grade_id' => 'الصف - المدرسة',
            'id_no' => 'رقم الهوية',
            'avatar' => 'الصورة الشخصية',
            'books' => 'الكتب',
            'grade' => 'الصف',
            'school' => 'المدرسة'
        ],
    ],
    'programs' => [
        'singular' => 'برنامج',
        'plural' => 'البرامج',
        'columns' => [
            'id' => 'ID',
            'name' => 'الاسم',
            'description' => 'الوصف',
            'image' => 'الصورة',
            'slug' => 'عنوان URL',
            'images' => 'الصور'
        ],
    ],
    'messages' => [
        'singular' => 'رسالة',
        'plural' => 'الرسائل',
        'columns' => [
            'id' => 'ID',
            'name' => 'الاسم',
            'email' => 'البريد الالكتروني',
            'phone_number' => 'رقم الهاتف',
            'message' => 'الرسالة'
        ]
    ],
    'plays' => [
        'singular' => 'مسرحية - فيلم',
        'plural' => 'المسرحيات',
        'columns' => [
            'id' => 'ID',
            'title' => 'العنوان',
            'description' => 'الوصف',
            'slug' => 'عنوان URL',
            'image' => 'صورة الغلاف',
            'header_image' => 'الصورة',
            'images' => 'الصور'
        ]
    ],
    'schools' => [
        'singular' => 'مدرسة',
        'plural' => 'المدارس',
        'columns' => [
            'id' => 'ID',
            'name' => 'اسم المدرسة',
            'books' => 'الكتب',
            'username' => 'اسم المستخدم',
            'teachers' => 'المعلمين',
        ]
    ],
    'grades' => [
        'singular' => 'صف',
        'plural' => 'الصفوف',
        'columns' => [
            'id' => 'ID',
            'name' => 'اسم الصف',
            'school' => 'المدرسة',
            'books' => 'الكتب',
            'teacher' => 'المعلم'
        ]
    ],
    'teachers' => [
        'singular' => 'معلم',
        'plural' => 'المعلمين',
        'columns' => [
            'id' => 'ID',
            'email' => 'البريد الالكتروني',
        ]
    ],
    'students' => [
        'singular' => 'الطالب',
        'plural' => 'الطلاب'
    ],
    'profiles' => [
        'singular' => 'الملف الشخصي',
        'plural' => 'الملفات الشخصية',
    ]
];
