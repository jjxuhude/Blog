<?php
namespace App\Block\Core;
use App\Lib\Data;
class Template extends Data{
    
    protected $_viewPath;
    protected $_block;
    protected $_template;
    protected $_cacheStatus;
    protected $_cacheTag;
    
    function __construct(){
        $this->_viewPath=app()->basePath().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR;
        $this->init();
    }
    
    public function init(){
       return $this;
    }
    
    public function setTemplate($template){
        $this->_template=$template;
    }
    
    public function getTemplate(){
        return $this->_template;
    }
    
    public function getBlock(){
        return $this->_block;
    }
    
    public function beforeHtml(){
        return $this;
    }
    
    public function afterHtml($html){
        return $html;
    }
    
    public function getHtml($type,$template=false,$data=array()){
        $type="\\App\Block\\".$type;
        if(!class_exists($type)) {
            $message='class not exists:'.$type;
            throw  new \Exception($message);
        }
        $block=new $type();
        
        if($block->_cacheStatus==true && $block->_cacheTag){
            $cacheId=md5(join('|',\Route::current()->parameters));
            $cacheKey=$block->_cacheTag.'_'.$cacheId;
            $cacheStatus=\App\Model\Cache::getStatus($block->_cacheTag);
            if($cacheStatus==1  && cache()->has($cacheKey)){
                $html=cache($cacheKey);
                return $html;
            }elseif($cacheStatus==0){
                cache()->forget($cacheKey);
            }
        }
        
        $template=str_replace('\\','/',$template);
        if($template){
            $this->_template=$template;
        }elseif(!!$template=$block->getTemplate()){
            $this->_template=$template;
        }else{
            $message="Template Not Exists:".get_class($block);
            throw  new \Exception($message);
        }
        $this->_block=$block;
        if(count($data)>0) $this->_block->setData($data);
        $this->beforeHtml();
        extract(array('block'=>$block));
        $templateFile=$this->renderTemplate($this->_template);
        if(file_exists($templateFile)){
            ob_start();
            include ($templateFile);
            $html=ob_get_clean();
            $html=$this->afterHtml($html);
            
            if($block->_cacheStatus==true && $block->_cacheTag){
               
                $cacheId=md5(join('|',\Route::current()->parameters));
                $cacheKey=$block->_cacheTag.'_'.$cacheId;
                $cacheStatus=\App\Model\Cache::getStatus($block->_cacheTag);
                if($cacheStatus==1  && !cache()->has($cacheKey)){
                    cache()->put($cacheKey,$html,\App\Model\Config::getConfig('advance/cache/timeout'));
                    \App\Model\Cache::addKeyToTag($block->_cacheTag,$cacheKey);
                }
            }
            
            return $html;
        }else{
            $message='template file not exists:'.$templateFile;
            throw new \Exception($message);
        }
    }
    
    public function renderTemplate($template){
        $template=$this->_viewPath.$template;        
        return $template;
    }
    
    
    
}