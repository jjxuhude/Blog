<?php
namespace App\Services;
use App\Block\Core\Template;

class HtmlService extends Template {
    

    
    /**
     * 
     * @param Array | String  $exclude
     * @return string
     */
    function getCurrentUrl($exclude=[]){
        $params=request()->all();
        if(is_string($exclude)){
            unset($params[$exclude]);
        }
        if(is_array($exclude)){
            foreach($exclude as $key){
                unset($params[$key]); 
            }
        }
        return route(\Route::currentRouteName(),$params);
    }
}