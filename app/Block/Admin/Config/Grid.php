<?php
namespace App\Block\Admin\Config;
use App\Model\Config;
class Grid extends \App\Block\Core\Template{
    
    protected $_defaultValues;
    
    function __construct($model){
        $this->_defaultValues=Config::pluck('value','path');
    }
    
    function getSaveBtn(){
        return "";
    }

    
    function getActiveSection($k,$i){
        $active="";
        if($section=request('section')){
            if($k==$section) $active="active";
        }else{
            if($i==1) $active="active";
        }
        return $active;
    }
    
    function getElementHtml($field){
        $html="";
        if(is_array($field)){
            if(isset($field['frontend_type'])){
                switch ($field['frontend_type']) {
                    case 'select': $html=$this->getSelectHtml($field);break;
                    case 'multiselect': $html=$this->getSelectHtml($field,true);break;
                    case 'text': $html=$this->getInputHtml($field);break;
                    case 'textarea': $html=$this->getTextAreaHtml($field);break;
                }
            }else{
                $html=$this->getInputHtml($field);
            }
        }else{
            $html=$this->getInputHtml($field);
        }
        return $html;
    }
    
    protected function getInputHtml($field){
        $name=$field['key'];
        $value=isset($this->_defaultValues[$field['key']])?$this->_defaultValues[$field['key']]:'';
        $html='<input type="text" name="'.$name.'" value="'.$value.'" class="form-control" />';
        return $html;
    
    }
    
    protected function getTextAreaHtml($field){
        $name=$field['key'];
        $value=isset($this->_defaultValues[$field['key']])?$this->_defaultValues[$field['key']]:'';
        $html='<textarea name="'.$name.'" class="form-control" />'.$value.'</textarea>';
        return $html;
    }
    
    protected function getSelectHtml($field,$multi=false){
        $value=isset($this->_defaultValues[$field['key']])?$this->_defaultValues[$field['key']]:'';
        if($multi){
            $value=explode(',', $value);
        }
       
        $name=$field['key'];
        $type=$field['source_model'];
        list($class,$method)=explode('::', $type);
    
        $data=call_user_func(array(new $class,$method));
        $size=count($data)<10?:10;
        $multiHtml='';
        if($multi){
            $multiHtml='multiple="multiple" size="'.$size.'"';
            $name.='[]';
        }
        $html='<select name="'.$name.'" class="form-control select" '.$multiHtml.'>';
        
        foreach($data as $k=>$v){
            $k=(string) $k;
          
            if($k===$value || (is_array($value) && in_array($k, $value))) {$selected="selected='selected'";}else{$selected='';}
            $html.='<option '.$selected.' value="'.$k.'">'.$v.'</option>';
        }
    
        $html.='</select>';
        return $html;
    }
    
    
 
   
}