<?php
namespace App\Block\Admin\Widget;
class Column extends \App\Block\core\Template{
    function getValueHtml($item){
        $data=$this->data;
        $key=$data['index'];
        $html="";
        $options=array();
        
        switch ($data['type']) {
            case 'options':
                if(isset($data['options'])){
                    $options=$data['options'];
                }
                $html=$options[$item[$key]];
            break;
            
            default:
                $html=$item[$key];
            break;
        }
        
        if(isset($data['renderer']) && $data['renderer'] instanceof \Closure){
            $html=call_user_func($data['renderer'],$item);
        }
        return $html;
    }
    
    function getFilterHtml(){
        $data=$this->data;
        $index=$data['index'];
        $html="";
        $options=array();
        
  
        if(in_array('search_index', array_keys($data)) && is_null($data['search_index'])) return $html;
        
        switch ($data['type']) {
            case 'options':
               $postData=request($index);
               $html ='<select name="'.$index.'">';
               $html.='<option></option>';
               if(isset($data['options']) && is_array($data['options'])){
                   $options=$data['options'];
               }
               foreach($options as $key=>$val){
                  $key=(string) $key;
                  $key===$postData? $selected="selected":$selected="";
                  $html.='<option '.$selected.' value="'.$key.'">'.$val.'</option>';
               }
               $html.='</select>';
            break;
            
            case 'date':
                $postData=request($index);
                $html.='<p><input value="'.$postData[0].'" class="date" name="'.$index.'[]"/></p><p><input value="'.$postData[1].'"  class="date" name="'.$index.'[]"/></p>';
            break;    
            
            case 'range':
                $postData=request($index);
                $html.='<input value="'.$postData[0].'"  class="range" name="'.$index.'[]"/><br/><input value="'.$postData[1].'" class="range" name="'.$index.'[]"/>';
                break;
                
            default:
                $html='<input value="'.request($index).'" name="'.$index.'"/>';
            break;
        }
        return $html;
    }
    function getTopFilterHtml(){
        $data=$this->data;
        $index=$data['index'];
        $html="";
        $options=array();
    
    
        if(in_array('search_index', array_keys($data)) && is_null($data['search_index'])) return $html;
    
        switch ($data['type']) {
            case 'options':
                $postData=request($index);
                $html ='<select name="'.$index.'">';
                $html.='<option></option>';
                if(isset($data['options']) && is_array($data['options'])){
                    $options=$data['options'];
                }
                foreach($options as $key=>$val){
                    $key=(string) $key;
                    $key===$postData? $selected="selected":$selected="";
                    $html.='<option '.$selected.' value="'.$key.'">'.$val.'</option>';
                }
                $html.='</select>';
                break;
    
            case 'date':
                $postData=request($index);
                isset($postData[0])?:$postData[0]="";
                isset($postData[1])?:$postData[1]="";
                $html.='<dl class="dl-horizontal"><dt>From:</dt><dd><input value="'.$postData[0].'" class="date" name="'.$index.'[]"/></dd><dt>To:</dt><dd><input value="'.$postData[1].'"  class="date" name="'.$index.'[]"/></dd></dl>';
                break;
    
            case 'range':
                $postData=request($index);
                isset($postData[0])?:$postData[0]="";
                isset($postData[1])?:$postData[1]="";
                $html.='<dl class="dl-horizontal"><dt>From:</dt><dd><input value="'.$postData[0].'"  class="range" name="'.$index.'[]"/></dd><dt>To:</dt><dd><input value="'.$postData[1].'" class="range" name="'.$index.'[]"/></dd></dl>';
                break;
    
            default:
                $html='<input value="'.request($index).'" name="'.$index.'"/>';
                break;
        }
        return $html;
    }
    
    function getHeaderHtml(){
        $data=$this->data;
        return $data['header'];
    }
    
    function get($index=false){
        $data=$this->data;
        if(empty($index)){
            return $this->data;
        }else{
            if(isset($data[$index])){
                return $data[$index];
            }else{
                return false;
            }
            
        }
    }
    
    
}