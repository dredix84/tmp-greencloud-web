<?php

namespace App\View\Helper;

require_once(ROOT . DS . 'vendor' . DS  . 'Dredix' . DS . 'Security' . DS . 'Permissions.php');

use Cake\View\Helper;

class MenuHelper extends Helper {
    use \Permissions;   //Used to check permissions
    
    public function getNavMenu($navmenus) {
        $outMenu = '';
        foreach ($navmenus as $nm) {
            if(!$this->hasPermission($nm->permissions)){ continue; }    //Check if user has permission
            if(empty($nm->menus)){
                $outMenu .=  $this->menuItem($nm);
            }else{
                $outMenu .= "
        <li class=\"nav-parent\">
            <a>
                $nm->before_title
                $nm->title
                $nm->after_title    
            </a>
            <ul class=\"nav nav-children\">";
                foreach($nm->menus as $m){
                    $outMenu .=  $this->menuItem($m);
                }
                $outMenu .= "
            </ul>
        </li>
                    ";
            }
        }
        echo $outMenu;
        
    }

    
    private function menuItem($nm){
        if(!$this->hasPermission($nm->permissions)){ return "";}    //Check if user has permission
        $webroot =  WEBROOT;
        if(empty($nm->url) && empty($nm->controller) && empty($nm->action)){
            $link = "#";
        }elseif(!empty($nm->url)){
            $link = $nm->url;
        }elseif(empty($nm->action)){
           $link = $webroot . $nm->controller; 
        }else{
            $link = $webroot . $nm->controller . '/' . $nm->action; 
        }
        //die(pr(compact('link', 'nm')));
        return "
        <li>
            <a href=\"$link\">
                $nm->before_title
                $nm->title
                $nm->after_title
            </a>
        </li>
        ";
    }
}
