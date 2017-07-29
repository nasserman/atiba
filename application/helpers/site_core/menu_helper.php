<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



function generate_menu($id_menu = "menu1")
{

    $ci = &get_instance();
    $ci->config->load('site_core/menu',true);

    $menuha = $ci->config->item("site_core/menu")['menu'][$id_menu];

    $output = "";
    $user_is_logged_in = user_is_logged_in();
    foreach($menuha as $item){

        if(($item['view'] === 'in') or ($item['view'] === 'in_group')){
            if (!$user_is_logged_in){
                continue;
            }
        }

        if($item['view'] === 'out'){
            if ($user_is_logged_in){
                continue;
            }
        }

        if($item['view'] === 'in_group'){
            $_groupha = json_decode($item['id_roleha']);
            $_current_user = get_current_site_user();
            $_id_rolehaye_user = json_decode($_current_user->id_roleha);

            $_res = false ;

            foreach($_groupha as $_g){
                if(in_array($_g, $_id_rolehaye_user)){
                    $_res = true;
                }
            }

            if(!$_res){
                continue;
            }

        }

        $_href= $item['url'];
        if($item['prepare']){
            $_href= site_url($_href);
        }
        $_title = $item['title'];



        if(isset($item['items']) && (count($item['items']) > 0)){

            $_o_parrent = '<li aria-expanded="false" aria-haspopup="true" class="uk-parent" data-uk-dropdown="{pos:\'bottom-right\' , mode:\'click\'}">';
            $_o_parrent .= '<a href="#">'.$_title.'</a>';
            $_o = '<div style="" class="uk-dropdown uk-dropdown-navbar uk-dropdown-top">';
            $_o .= '<ul class="uk-nav uk-nav-navbar">';

            $child_items = 0;

            foreach($item['items'] as $i){
                if(($i['view'] === 'in') or ($i['view'] === 'in_group')){
                    if (!$user_is_logged_in){continue;}
                }

                if($i['view'] === 'out'){
                    if ($user_is_logged_in){continue;}
                }

                if($i['view'] === 'in_group'){
                    $__groupha = json_decode($i['id_roleha']);
                    $__res = false ;
                    foreach($__groupha as $__g){
                        if(in_array($__g, $_id_rolehaye_user)){
                            $__res = true;
                        }
                    }
                    if(!$__res){
                        continue;
                    }
                }

                $__href= $i['url'];
                if($i['prepare']){
                    $__href= site_url($__href);
                }
                $__title = $i['title'];
                $__l = '<li><a href="'.$__href.'">'.$__title.'</a></li>';
                $_o .= $__l;
                $child_items++;
            }

            $_o .= '</ul>';
            $_o .= '</div>';


            if($child_items>0){
                $_o_parrent .= $_o;
                //$_l = $_o;
            }
            $_o_parrent .= '</li>';
            $_l = $_o_parrent;
        }

        else {
            $_l = '<li class=""><a href="'.$_href.'">'.$_title.'</a></li>';
        }




        $output .= $_l;
    }

    return $output;
}



function generate_offcanvas_menu($id_menu = "menu1" , $active_item_url="")
{

    $ci = &get_instance();
    $ci->config->load('site_core/menu',true);

    $menuha =  $ci->config->item("site_core/menu")['menu'][$id_menu];


    $output = "";
    $user_is_logged_in = user_is_logged_in();

    foreach($menuha as $item){

        if(($item['view'] === 'in') or ($item['view'] === 'in_group')){
            if (!$user_is_logged_in){
                continue;
            }
        }

        if($item['view'] === 'out'){
            if ($user_is_logged_in){
                continue;
            }
        }

        if($item['view'] === 'in_group'){
            $_groupha = json_decode($item['id_roleha']);
            $_current_user = get_current_site_user();
            $_id_rolehaye_user = json_decode($_current_user->id_roleha);

            $_res = false ;

            foreach($_groupha as $_g){
                if(in_array($_g, $_id_rolehaye_user)){
                    $_res = true;
                }
            }

            if(!$_res){
                continue;
            }

        }

        $_href= $item['url'];
        if($item['prepare']){
            $_href= site_url($_href);
        }
        $_title = $item['title'];



        if(isset($item['items']) && (count($item['items']) > 0)){
            $_o = '<ul class="uk-nav uk-nav-parent-icon" data-uk-nav>';
            $_o .= '<li class="uk-parent @__active">';
            $_o .= '<a href="#">' .$_title .'</a>';
            $_o .= '<ul class="uk-nav-sub">';

            $_is_active = false;

            foreach($item['items'] as $i){


                if(($i['view'] === 'in') or ($i['view'] === 'in_group')){
                    if (!$user_is_logged_in){
                        continue;
                    }
                }

                if($i['view'] === 'out'){
                    if ($user_is_logged_in){
                        continue;
                    }
                }

                if($i['view'] === 'in_group'){
                    $__groupha = json_decode($i['id_roleha']);
                    $__res = false ;

                    foreach($__groupha as $__g){
                        if(in_array($__g, $_id_rolehaye_user)){
                            $__res = true;
                        }
                    }

                    if(!$__res){
                        continue;
                    }

                }

                $__href= $i['url'];
                if($i['prepare']){
                    $__href= site_url($__href);
                }
                $__title = $i['title'];
                $__class = "";
                if($i['url'] === $active_item_url){
                    $__class = 'uk-active';
                    $_is_active = true;
                }

                $__l = '<li class="'.$__class.'"><a href="'.$__href.'">'.$__title.'</a></li>';

                $_o .= $__l;

            }

            if(!$_is_active){
                $_o = str_replace('@__active', '', $_o);
            }
            else {
                $_o = str_replace('@__active', 'uk-active', $_o);
            }

            $_o .= '</ul>';
            $_o .= '</li>';
            $_o .= '</ul>';

            $_l = $_o;
        }

        else {
            $_class = "";
            if($item['url'] === $active_item_url){
                $_class = 'uk-active';
            }
            $_l = '<li class="'.$_class.'"><a href="'.$_href.'">'.$_title.'</a></li>';
        }




        $output .= $_l;
    }

    return $output;
}
