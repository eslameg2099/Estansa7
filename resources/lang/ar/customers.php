<?php

return [
    'plural' => 'العملاء',
    'singular' => 'العميل',
    'empty' => 'لا توجد عملاء',
    'select' => 'اختر العميل',
    'permission' => 'ادارة العملاء',
    'trashed' => 'العملاء المحذوفين',
    'perPage' => 'عدد النتائج في الصفحة',
    'actions' => [
        'list' => 'كل العملاء',
        'show' => 'عرض',
        'create' => 'إضافة',
        'new' => 'إضافة',
        'edit' => 'تعديل  العميل',
        'delete' => 'حذف العميل',
        'restore' => 'استعادة',
        'forceDelete' => 'حذف نهائي',
        'save' => 'حفظ',
        'filter' => 'بحث',
        'textmail'=>'ارسال الايميل',
    ],
    'messages' => [
        'created' => 'تم إضافة العميل بنجاح .',
        'updated' => 'تم تعديل العميل بنجاح .',
        'deleted' => 'تم حذف العميل بنجاح .',
        'restored' => 'تم استعادة العميل بنجاح .',
    ],
    'attributes' => [
        'name' => 'الاسم الاول',
        'last_name'=> 'الاسم الاخير',
        'phone' => 'رقم الهاتف',
        'email' => 'البريد الالكترونى',
        'created_at' => 'تاريخ الإنضمام',
        'old_password' => 'كلمة المرور القديمة',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'type' => 'نوع المستخدم',
        'avatar' => 'الصورة الشخصية',
'category_id'=>'القسم',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا العميل ؟',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
        'restore' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد استعادة هذا العميل ؟',
            'confirm' => 'استعادة',
            'cancel' => 'إلغاء',
        ],
        'forceDelete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا العميل نهائياً؟',
            'confirm' => 'حذف نهائي',
            'cancel' => 'إلغاء',
        ],
    ],
];
