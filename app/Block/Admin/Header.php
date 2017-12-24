<?php
namespace App\Block\Admin;
use App\Block\Core\Template;
use App\Model\Role;

class Header extends Template{
    
    public function getInfo(){
        return 'header';
    }

    

    
    public function getMenuHtml(){
        //dump(session()->all());
        $roleModel=new Role();
        $userMenu=$roleModel->getUserMenuResource();
//         dump($userMenu);exit;
        return $this->getMenu($userMenu);
        
        
    }
    
    public function getMenu($data,$level=0){
       $activeMenu=$this->getActiveMenu();
       $html="";
        foreach($data as $k=>$child){
            if(isset($child['children']) && count($child['children'])>0 ){
                $parent='parent';
            }else{
                $parent='';
            }
       
            if($activeMenu==$k){
                $active='active';
            }else{
                $active='';
            }
            $html.='<li class=" '.$active.' '.$parent.' level'.$level.'  ">';
            if(isset($child['action'])){
                $action=$child['action'];
            }else{
                $action="";
            }
            $html.=$this->getMenuUrl($action, '', $child['title']);
            if($parent){
                $html.='<ul>';
                $html.=$this->getMenu($child['children'],$level+1);
                $html.='</ul>';
            }
            $html.='</li>';
        }
        return $html;
    }
    
    
    function inUrl($current,$menu){
        foreach($menu as $key=>$val){
            foreach($val as $url){
                if(stripos($url, $current)===0){
                    return $key;
                }
            }
        }
    }
    
    function getActiveMenu(){
        $xml=new \App\Lib\File();
        $menu=$xml->getConfig();
        $menu=$this->_getActiveMenu($menu['menu']);
        
       array_walk($menu, function(&$data,$key){
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]=route($data[$i]);
            }
        });
        
        $roleModel=new Role();
        $aclActions=$roleModel->getRoleActionResource();
        $fullActionArr=explode('/',\Route::current()->uri);
        
        //获取模块名称
        if(count($fullActionArr)>1) {
            $fullAction=$fullActionArr[1];
        }else{
            $fullAction='home';
        }
      
        $activeKey='';
        
        
        
        if(in_array($fullAction, array_keys($menu))){
            return $fullAction;
        }elseif($key=$this->inUrl(request()->url(),$menu)){
            return $key;
        }else{
            return false;
        }
        /*
            foreach($menu as $k=>$url){
                if(in_array($fullAction, $url)){
                    $activeKey=$k;
                }elseif(in_array($fullAction, $aclActions)){
                    $activeKey=$k; 
                }else{
                    $fullAction=preg_replace('/(\w+?)\/(\w+?)\/(\w+)/', '$1/$2/index',$fullAction);
                    if(in_array($fullAction, $url)) $activeKey=$k;
                }
            };
           return $activeKey;
        */
      
    }
    
    protected function _getActiveMenu($menu,$k=false){
        static $data=array();
        foreach($menu as $key=>$item){
            if($k) $key=$k;
            if(isset($item['action'])){
                   $data[$key][]=$item['action'];
            }
            if(isset($item['children'])){
                $this->_getActiveMenu($item['children'],$key);
            }
        }
        return $data;
    }
    
    public function getMenuUrl($type,$params,$text,$className="default-btn"){
        //if($this->accessAcl($type)){
        if(empty($type)){
            $url="javascript:;";
        }else{
            //$params['key']=$this->getEncodeUrl($type,$params);
           // $url=\Html::getAdminUrl($type, $params);
           $url=route($type);
            
        }
        if($text===false){
            return $url;
        }else{
            return '<a class="'.$className.'" href="'.$url.'">'.$text.'</a>';
        }
     
    }
    
    
}