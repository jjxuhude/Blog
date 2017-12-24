<?php
namespace App\Block\Admin\Role;
class Grid extends \App\Block\Admin\Widget\Grid{

    public $title="角色管理";
    public $addText="添加新角色";
    
 function prepareColumns(){
        
        if(empty($this->_columns)){
            $this->addColumn('id', array(
                'header'    => '编号',
                'type'      =>'int',
                'index'     => 'id',
            ));
            
            $this->addColumn('name', array(
                'header'    => '角色名称',
                'type'      =>'text',
                'index'     => 'name',
            ));
            
        }
    }
   
}