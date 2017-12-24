<?php
namespace App\Block\Admin\Season\Renderer;
use App\Block\Core\Template;
use Illuminate\Support\Facades\DB;
class Catalog extends Template{
    
    function getTreeData(){
      $data=\App\Model\Catalog::select('id','pid',DB::raw('name as text,id as value'))->get()->toArray();
      return $this->toTree($data);
    }
    
    function getCheckedData(){
        $catalogIds=\App\Model\Catalog::getCatalogsByVideoId($this->getModel()->id)->toArray();
        return $catalogIds;
    }
    
    
    function toTree($list=null, $pk='id',$pid = 'pid',$child = 'children',$root=0)
    {
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }
    
    
    
    
    


}
