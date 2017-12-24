<?php
namespace App\Block\Admin\Cms;
class Grid extends \App\Block\Admin\Widget\Grid{
    
    public $title="Cms页面管理";
    public $addText="添加页面";

    
    
 function prepareColumns(){
        
        if(empty($this->_columns)){
            $this->addColumn('id', array(
                'header'    => '编号',
                'type'      =>'int',
                'index'     => 'id',
            ));
            
            $this->addColumn('title', array(
                'header'    => '标题',
                'type'      =>'text',
                'index'     => 'title',
            ));
            
             $this->addColumn('url_key', array(
                'header'    => 'Url Key',
                'type'      =>'text',
                'index'     => 'url_key',
            ));
            
            
            $this->addColumn('status', array(
                'header'    => '状态',
                'type'      =>'options',
                'options'   => array(
                    0 => 'Disabled',
                    1 => 'Enabled'
                ),
                'index'     => 'status',
            ));
    
            $this->addColumn('sort', array(
                'header'    => '排序',
                'type'      =>'int',
                'index'     => 'sort',
            ));
            
            $this->addColumn('created_at', array(
                'header'    => '时间',
                'index'     => 'created_at',
                'type'      => 'date',
                'renderer'  => function ($item){
                    $date= new \DateTime($item['created_at']);
                    return $date->format('Y-m-d H:i:s');
                }
            ));
        }
    }
   
}