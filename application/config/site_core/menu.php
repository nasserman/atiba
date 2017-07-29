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
            'title'=>'تنظیمات پایه' ,
            'url'=>'' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['admin_user','super_user' , "hesabdar_user"]),
            'items'=>[

                [
                    'title'=>'مدیریت مناطق' ,
                    'url'=>'admin/manateg/ostanha' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'شعب' ,
                    'url'=>'admin/shobe/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'مجموعه‌ها' ,
                    'url'=>'admin/category/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'رنگ‌ها' ,
                    'url'=>'admin/color/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'گروه‌های مشتریان' ,
                    'url'=>'admin/grouhe_moshtari/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
				[
                    'title'=>'تنظیمات بارکدخوان' ,
                    'url'=>'admin/setting/barcode' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                  	'id_roleha'=>json_encode(['admin_user','super_user'])
				],
				[
                    'title'=>' چاپ بارکد' ,
                    'url'=>'barcode/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                  	'id_roleha'=>json_encode(['admin_user','super_user' , "hesabdar_user"])
				],
				[
                    'title'=>'سطوح هزینه‌ها' ,
                    'url'=>'admin/sathe_hazine/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                  	'id_roleha'=>json_encode(['admin_user','super_user'])
				],
            ]
        ],

        [
            'title'=>'آیتم‌ها' ,
            'url'=>'' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['hesabdar_user','admin_user','super_user']),
            'items'=>[
                [
                    'title'=>'آیتم‌ها (کالاها)' ,
                    'url'=>'admin/item/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['hesabdar_user','admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'موجودی' ,
                    'url'=>'admin/mojudi/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['hesabdar_user','admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'ثبت موجودی' ,
                    'url'=>'admin/sabte_mojudi/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['hesabdar_user','admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'خرید' ,
                    'url'=>'admin/kharid/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['hesabdar_user','admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'انتقال' ,
                    'url'=>'admin/entegal/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['hesabdar_user','admin_user','super_user']),
                    'items'=>[]
                ],
            ]
        ],

        [
            'title'=>'مشتریان' ,
            'url'=>'admin/moshtari/index' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['admin_user','super_user']),
            'items' => [
                [
                    'title'=>'لیست مشتریان' ,
                    'url'=>'admin/moshtari/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'مشتری جدید' ,
                    'url'=>'admin/moshtari/edit' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
            ]
        ],

        [
            'title'=>'فروش‌' ,
            'url'=>'' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['admin_user','super_user']),
            'items' => [
                [
                    'title'=>'لیست فروش‌ها' ,
                    'url'=>'admin/furush/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ]
            ]
        ],

        [
            'title'=>'فروش‌' ,
            'url'=>'operator/furush/index' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['operator_user']),
            'items' => []
        ],

        [
            'title'=>'اپراتورها' ,
            'url'=>'' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['admin_user','super_user']),
            'items' => [
                [
                    'title'=>'لیست اپراتور‌ها' ,
                    'url'=>'admin/operator/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'لیست حسابدارها' ,
                    'url'=>'admin/hesabdar/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
            ]
        ],

        [
            'title'=>'انتقال‌ها' ,
            'url'=>'operator/shobe/liste_entegalha' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['operator_user']),
            'items' => []
        ],

        [
            'title'=>'پیام‌ها' ,
            'url'=>'' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['operator_user','admin_user','super_user']),
            'items' => [
                [
                    'title'=>'پیام های دریافتی من' ,
                    'url'=>'admin/message/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'پیام های دریافتی من' ,
                    'url'=>'operator/message/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['operator_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'پیام های ارسالی من' ,
                    'url'=>'admin/message/mymessage' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'پیام های ارسالی من' ,
                    'url'=>'operator/message/mymessage' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['operator_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'ارسال پیام جدید' ,
                    'url'=>'admin/message/add' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['admin_user','super_user']),
                    'items'=>[]
                ],
                [
                    'title'=>'ارسال پیام جدید' ,
                    'url'=>'operator/message/add' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['operator_user']),
                    'items'=>[]
                ],
            ]
        ],

        [
            'title'=>'فرایندها' ,
            'url'=>'#' ,
            'prepare'=>false ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['admin_user','super_user']),
            'items' => []
        ],


        [
            'title'=>'کاربر' ,
            'url'=>'#' ,
            'prepare'=>false ,
            'view'=>'in',
            'id_roleha'=>json_encode(['hesabdar_user','operator_user' , 'admin_user' , "super_user"]),
            'items'=>[

                [
                    'title'=>'حساب کاربری من' ,
                    'url'=>'site_core/user_account/index' ,
                    'prepare'=>true ,
                    'view'=>'in_group',
                    'id_roleha'=>json_encode(['hesabdar_user','operator_user' , 'admin_user' , "super_user"]),
                    'items'=>[]
                ],
            ]
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
            'id_roleha'=>json_encode(['hesabdar_user' , 'admin_user' , "super_user"]),
            'items'=>[]
        ],
        [
            'title'=>'خروج' ,
            'url'=>'site_core/user/operator_logout' ,
            'prepare'=>true ,
            'view'=>'in_group',
            'id_roleha'=>json_encode(['operator_user']),
            'items'=>[]
        ],

    ] ,

    'menu2' =>[] ,

    'menu3' =>[]

];
