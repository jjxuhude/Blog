<?php
namespace App\Block\Admin\User;
class Grid extends \App\Block\Admin\Widget\Grid{
    
    public $title="用户管理";
    public $addText="添加新用户";

    
    
 function prepareColumns(){
        
        if(empty($this->_columns)){
            $this->addColumn('id', array(
                'header'    => '编号',
                'type'      =>'int',
                'index'     => 'id',
                'search_index'   => 'm.id'
            ));
            
            $this->addColumn('name', array(
                'header'    => '用户名',
                'type'      =>'text',
                'index'     => 'name',
                'search_index'   => 'm.name'
            ));
            
             $this->addColumn('email', array(
                'header'    => '邮箱',
                'type'      =>'find_in_set',
                'index'     => 'email',
                 'search_index'=>'m.email'
            ));
            
            $this->addColumn('age', array(
                'header'    => '年龄',
                'type'      =>'range',
                'index'     => 'age',
                'search_index'=>'m.age'
            ));
            
            $this->addColumn('role', array(
                'header'    => '角色',
                'type'      =>'text',
                'index'     => 'role',
                'search_index'=>'m.role'
            ));
            
            $this->addColumn('label', array(
                'header'    => '角色Label',
                'type'      =>'text',
                'index'     => 'label',
                'search_index'=>'s.label'
            ));
            
            $this->addColumn('status', array(
                'header'    => '状态',
                'type'      =>'options',
                'options'   => array(
                    0 => 'Disabled',
                    1 => 'Enabled'
                ),
                'index'     => 'status',
                'search_index'=>'m.status'
            ));
    
            $this->addColumn('created_at', array(
                'header'    => '时间',
                'index'     => 'created_at',
                'type'      => 'date',
                'renderer'  => function ($item){
                    $date= new \DateTime($item['created_at']);
                    return $date->format('Y-m-d');
                },
                'search_index'=>'m.created_at'
            ));
        }
    }
   
}