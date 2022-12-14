<?php

return [
    'plural' => 'المقالات',
    'singular' => 'مقالات',
    'empty' => 'لا توجد مقالات',
    'select' => 'اختر العميل',
    'permission' => 'ادارة العملاء',
    'trashed' => 'المقالات المحذوفين',
    'perPage' => 'عدد النتائج في الصفحة',
'filter' => 'ابحث عن المقال',
    'actions' => [
        'list' => 'كل المقالات',
        'show' => 'عرض',
        'create' => ' اضافة مقال',
        'new' => 'إضافة',
        'edit' => 'تعديل  مقال',
        'delete' => 'حذف المقال',
        'restore' => 'استعادة',
        'forceDelete' => 'حذف نهائي',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم اضافة مقال بنجاح .',
        'updated' => 'تم تعديل مقال بنجاح .',
        'deleted' => 'تم حذف مقال بنجاح .',
        'restored' => 'تم استعادة مقال بنجاح .',
    ],
    'attributes' => [
        'titele' => 'اسم المقال',
        'description' => 'الوصف',
        'category_id' => ' النوع',
'user_id' => 'الناشر',
        'image' => 'الصورة',
'slug'=>'الاختصار',
'view'=>'عدد المشاهدات',
'created_at'=>'تاريخ النشر',
       
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا المقال ؟',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
        'restore' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد استعادة هذا المقال ؟',
            'confirm' => 'استعادة',
            'cancel' => 'إلغاء',
        ],
        'forceDelete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا المقال نهائياً؟',
            'confirm' => 'حذف نهائي',
            'cancel' => 'إلغاء',
        ],
    ],
];
