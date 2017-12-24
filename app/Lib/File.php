<?php
namespace App\Lib;

class File {
    function getConfig(){
        $files=app()->basePath().DS.'app'.DS.'etc'.DS.'menu'.DS.'*.xml';
        $files = glob($files);
        $xml='';
        while($file=current($files)){
          
            if(empty($xml)){
                $xml=new \Zend_Config_Xml($file,null,true);
            }else{
                $xml->merge(new \Zend_Config_Xml($file));
            }
            next($files);
        }
        $menu=$xml->toArray();
        $this->sort($menu['menu']);
        return $menu;
    }
    
    function getXml(){
        $files=app()->basePath().'etc'.DS.'menu'.DS.'*.xml';
        $files = glob($files);
        while($file=current($files)){
            if(empty($xml)){
                $xml=new \Zend_Config_Xml($file,null,true);
            }else{
                $xml->merge(new \Zend_Config_Xml($file));
            }
            next($files);
        }
         
        return $xml;
    }
    
    function readDir($dir, $recursion=false){
        if($recursion===false){
            $files=scandir($dir);
        }else{
            $files=$this->directory_list($dir);
        }
        return     $files;    
    }
    
    
    function directory_list($directory_base_path, $filter_dir = false, $filter_files = false, $exclude = ".|..|.DS_Store|.svn", $recursive = true){
        $directory_base_path = rtrim($directory_base_path, "/") . "/";
    
        if (!is_dir($directory_base_path)){
            error_log(__FUNCTION__ . "File at: $directory_base_path is not a directory.");
            return false;
        }
    
        $result_list = array();
        $exclude_array = explode("|", $exclude);
    
        if (!$folder_handle = opendir($directory_base_path)) {
            error_log(__FUNCTION__ . "Could not open directory at: $directory_base_path");
            return false;
        }else{
            while(false !== ($filename = readdir($folder_handle))) {
                if(!in_array($filename, $exclude_array)) {
                    if(is_dir($directory_base_path . $filename . "/")) {
                        if($recursive && strcmp($filename, ".")!=0 && strcmp($filename, "..")!=0 ){ // prevent infinite recursion
                            error_log($directory_base_path . $filename . "/");
                            $result_list[$filename] = $this->directory_list("$directory_base_path$filename/", $filter_dir, $filter_files, $exclude, $recursive);
                        }elseif(!$filter_dir){
                            $result_list[] = $filename;
                        }
                    }elseif(!$filter_files){
                        $result_list[] = $filename;
                    }
                }
            }
            closedir($folder_handle);
            return $result_list;
        }
    }
    
    
    protected function sort(&$data){
        uasort($data, array($this, '_sortTree'));
        foreach($data as &$item){
            if(isset($item['children']) && is_array($item['children'])){
                $this->sort($item['children']);
            }
        }
        return $data;
    }
    protected function _sortTree($a, $b)
    {
        if(!isset($a['sort_order'])) return -1;
        if(!isset($b['sort_order'])) return 1;
        return $a['sort_order']<$b['sort_order'] ? -1 : ($a['sort_order']>$b['sort_order'] ? 1 : 0);
    }
}