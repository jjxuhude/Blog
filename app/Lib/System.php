<?php
namespace App\Lib;
class System{
    
    protected $_prototype;
    
    public function __construct($sourceData=null)
    {
        $this->_prototype       = new \Varien_Simplexml_Config();
    }
    
    function getTabssArray(&$obj=null,$parentKey=null){
        if(is_null($obj)) $obj=$this->getXmlObject()->getNode('tabs')->asArray();
        foreach($obj as $k=>&$v){
            
            if(in_array($k,array('groups','fields'))){
                $key=$parentKey;
            }else{
                $key=is_null($parentKey)?$k:$parentKey."/".$k;
            }
           
            if(is_array($v)){
                $v['key']=$key;
               // if(!isset($v['sort_order'])) $v['sort_order']=0;
                $this->getTabssArray($v,$key);
            }
        }
        if(is_array($obj) ){
            @uasort($obj, array($this, '_sortTree'));
        }
        return $obj;
    }
    
    function getSectionsArray(&$obj=null,$parentKey=null){
        if(is_null($obj)) $obj=$this->getXmlObject()->getNode('sections')->asArray();
        foreach($obj as $k=>&$v){
    
            if(in_array($k,array('groups','fields'))){
                $key=$parentKey;
            }else{
                $key=is_null($parentKey)?$k:$parentKey."/".$k;
            }
             
            if(is_array($v)){
                $v['key']=$key;
                // if(!isset($v['sort_order'])) $v['sort_order']=0;
                $this->getSectionsArray($v,$key);
            }
        }
        if(is_array($obj) ){
            @uasort($obj, array($this, '_sortTree'));
        }
        return $obj;
    }
    
    
    
    
    public function getXmlObject($dir='system'){
        $files=$this->getFiles($dir);
        $xmlObj=$this->loadModulesConfiguration($files);
        return $xmlObj;
    }
    
    protected  function getFiles($dir='system'){
        $files=app()->basePath().DS.'app'.DS.'etc'.DS.$dir.DS.'*.xml';
        $files = glob($files);
        return $files;
    }
    
    protected   function loadModulesConfiguration($fileName,$mergeToObject = null, $mergeModel=null){
        if ($mergeToObject === null) {
            $mergeToObject = clone $this->_prototype;
            $mergeToObject->loadString('<config/>');
        }
        if ($mergeModel === null) {
            $mergeModel = clone $this->_prototype;
        }
        
        foreach ($fileName as $configFile) {
            if ($mergeModel->loadFile($configFile)) {
                $mergeToObject->extend($mergeModel, true);
            }
        }
        return $mergeToObject;
    }
    
   
    
   
    
    
    public function _getNodeJson($node, $level = 0)
    {
        $item = array();
        //$selres = $this->getSelectedResources();
        $selres=array();
        
    
        if ($level != 0) {
            $item['text'] = (string)$node->text;
            $item['sort_order'] = isset($node->sort_order) ? (string)$node->sort_order : 0;
        }
    
        if (isset($node->children)) {
            $children = $node->children->children();
        } else {
            $children = $node->children();
        }
        if (empty($children)) {
            return $item;
        }
    
        if ($children) {
            $item['children'] = array();
            //$item['cls'] = 'fiche-node';
            foreach ($children as $child) {
                if ($child->getName() != 'text' && $child->getName() != 'sort_order') {
                    if (!(string)$child->text) {
                        continue;
                    }
                    if ($level != 0) {
                        $item['children'][] = $this->_getNodeJson($child, $level+1);
                    } else {
                        $item = $this->_getNodeJson($child, $level+1);
                    }
                }
            }
            if (!empty($item['children'])) {
                usort($item['children'], array($this, '_sortTree'));
            }
        }
        return $item;
    }
    
    protected function _sortTree($a, $b)
    {
        return $a['sort_order']<$b['sort_order'] ? -1 : ($a['sort_order']>$b['sort_order'] ? 1 : 0);
    }
}