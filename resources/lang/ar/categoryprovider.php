<?php

return [
'create'=>'انشاء قسم جديد',
    'singular' => 'الاقسام',
    'plural' => 'انواع الاقسام',
    'empty' => 'لا يوجد انواع اقسام حتى الان',
    'count' => 'عدد الاقسام',
    'search' => 'بحث',
    'select' => 'اختر المقاول',
    'permission' => 'ادارة الاقسام',
    'trashed' => 'انواع الاقسام المحذوفة',
    'perPage' => 'عدد النتائج بالصفحة',
    'filter' => 'ابحث عن الاقسام',
 'image'=>'الصورة',
    'actions' => [
        'list' => 'عرض الكل',
        'create' => 'اضافةالاقسام',
        'show' => 'عرض القسم',
        'edit' => 'تعديل القسم',
        'delete' => 'حذف القسم',
        'restore' => 'استعادة',
        'forceDelete' => 'حذف نهائي',
        'options' => 'خيارات',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم اضافة  القسم بنجاح.',
        'updated' => 'تم تعديل  القسم بنجاح.',
        'deleted' => 'تم حذف  القسم بنجاح.',
        'restored' => 'تم استعادة  القسم بنجاح.',
    ],
    'attributes' => [
        '%name%' => 'اسم القسم',
'name' => 'اسم القسم',
        'description' => 'وصف القسم',
       'stauts'=>'حالة القسم',
        'image' => 'صورة القسم',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل انت متأكد انك تريد حذف القسم  ؟',
            'confirm' => 'حذف',
            'cancel' => 'الغاء',
        ],
        'restore' => [
            'title' => 'تحذير !',
            'info' => 'هل انت متأكد انك تريد استعادة القسم  ؟',
            'confirm' => 'استعادة',
            'cancel' => 'الغاء',
        ],
        'forceDelete' => [
            'title' => 'تحذير !',
            'info' => 'هل انت متأكد انك تريد حذف القسم  نهائياً ؟',
            'confirm' => 'حذف نهائي',
            'cancel' => 'الغاء',
        ],
    ],
];
