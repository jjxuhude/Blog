<?php
namespace App\Block\Frontend;
use App\Block\Core\Template;
use App\Model\Role;
use App\Model\Catalog;

class Header extends Template{
    
    
    function init(){
       // dump(\Route::current());
    }
    
    function getHeaderCatalog(){
        $headerCatalog=cache('header',function(){
            $catalog=new \App\Model\Catalog();
            $values=Catalog::getTreeArray();
            return $values[0]['children'];
        });
        return $headerCatalog;
    }
    
    
}