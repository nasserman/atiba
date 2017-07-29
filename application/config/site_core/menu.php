<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * هر گزینه منو به صورت زیر تعریف می شود
*    [
*        'title'=>'menu title' , عنوان منو که نمایش داده می شود
*        'url'=>'' , لینکی که به ایتم اختصاص داده می شود
*        'prepare'=>true , در صورتی که درست باشد از تابع site_url برای ایجاد ادرس منو استفاده می شود
*        'view'=>'hame / in / out / in_group', یکی از گزینه های فوق قابل استفاده است
*                        hame : منو برای همه قابل نمایش است
*                        in : فقط کاربرانی که لاگین کرده اند
*                        out : فقط کاربرانی که لاگین نکرده اند منو را می بینند
*                        in_group : فقط کاربرانی که لاگین کرده و در یکی از گروه های کاربری زیر قرار داشته باشند
*        'id_roleha'=>json_encode(['admin_user']) لیست نام گروه های کاربری
*    ],
 */

$config['menu'] = [

    'menu1' =>[

        [
            'title'=>'صفحه نخست' ,
            'url'=>'' ,
            'prepare'=>true ,
            'view'=>'hame',
            'id_roleha'=>json_encode([]),
            'items'=>[]
        ],

        [
            'title'=>'حساب کاربری من' ,
            'url'=>'site_core/user_account/index' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['hesabdar_user','operator_user' , 'admin_user' , "super_user"]),
            'items'=>[]
        ],


        [
            'title'=>'لیست بیماران' ,
            'url'=>'operator/bimar/index' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['admin_user','super_user','operator_user']),
            'items'=>[]
        ],

        [
            'title'=>'لیست پذیرش‌ها' ,
            'url'=>'operator/paziresh/index' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['admin_user','super_user']),
            'items'=>[]
        ],

        [
            'title'=>'پذیرش' ,
            'url'=>'operator/paziresh/edit' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['admin_user','super_user','operator_user']),
            'items' => []
        ],

        [
            'title'=>'لیست اپراتور‌ها' ,
            'url'=>'admin/operator/index' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['admin_user','super_user']),
            'items'=>[]
        ],

        [
            'title'=>'ورود' ,
            'url'=>'site_core/user/login' ,
            'prepare'=>true ,
            'view'=>'out',
            'id_roleha'=>json_encode([]),
            'items'=>[]
        ],

        [
            'title'=>'خروج' ,
            'url'=>'site_core/user/logout' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['operator_user' , 'admin_user' , "super_user"]),
            'items'=>[]
        ],

    ] ,

    'menu2' =>[] ,

    'menu3' =>[]

];
