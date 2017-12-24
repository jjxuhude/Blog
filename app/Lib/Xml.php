<?php
namespace App\Lib;
class Xml{
    
    protected $_prototype;
    
    public function __construct($sourceData=null)
    {
        $this->_prototype       = new \Varien_Simplexml_Config();
    }
    
    
    public function getResourcesTree(){
        $resource=$this->_buildResourcesArray(null, null, null, null, true);
        return $this->_getNodeJson($resource,1);
    }
    
    public function getXmlObject(){
        $files=$this->getFiles();
        $xmlObj=$this->loadModulesConfiguration($files);
        return $xmlObj;
    }
    
    protected  function getFiles($dir='acl'){
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
    
   
    
    protected function _buildResourcesArray(\Varien_Simplexml_Element $resource = null,
        $parentName = null, $level = 0, $represent2Darray = null, $rawNodes = false)
    {
        static $result;
        if (is_null($resource)) {
            $resource = $this->getXmlObject()->getNode('acl');
            $resourceName = null;
            $level = -1;
        } else {
            $resourceName = $parentName;
            if (!in_array($resource->getName(), array('title', 'sort_order', 'children', 'disabled'))) {
                $resourceName = (is_null($parentName) ? '' : $parentName . '/') . $resource->getName();
    
          
    
                if ($rawNodes) {
                    $resource->addAttribute("aclpath", $resourceName);
                }
    
                if ( is_null($represent2Darray) ) {
                    $result[$resourceName]['name']  = (string)$resource->title;
                    $result[$resourceName]['level'] = $level;
                } else {
                    $result[] = $resourceName;
                }
            }
        }
    
        //check children and run recursion if they exists
        $children = $resource->children();
        foreach ($children as $key => $child) {
            if (1 == $child->disabled) {
                $resource->{$key} = null;
                continue;
            }
            $this->_buildResourcesArray($child, $resourceName, $level + 1, $represent2Darray, $rawNodes);
        }
    
        if ($rawNodes) {
            return $resource;
        } else {
            return $result;
        }
    }
    
    
    public function _getNodeJson($node, $level = 0)
    {
        $item = array();
        //$selres = $this->getSelectedResources();
        $selres=array();
        
    
        if ($level != 0) {
            $item['text'] = (string)$node->text;
            $item['sort_order'] = isset($node->sort_order) ? (string)$node->sort_order : 0;
            $item['value'] = (string)$node->attributes()->aclpath;
    
            if (in_array($item['value'], $selres))
                $item['checked'] = true;
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