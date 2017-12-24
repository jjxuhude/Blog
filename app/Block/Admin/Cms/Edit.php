<?php
namespace App\Block\Admin\Cms;
class Edit extends \App\Block\Admin\Widget\Edit{
    
    
    
    function getModel(){
       return $this->model;
    }
    
    function getRole(){
        $roleModel=new \App\Model\Role();
        return $roleModel->getRoleOptions()->toArray();
    }
    
    
    protected function _prepareForm()
    {
        $form = new \Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getFormAction(), 'method' => 'post')
        );
    
        $fieldset = $form->addFieldset('base_fieldset',array('legend'=>'General Information', 'class' => 'fieldset-base active'));
    
        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => '标题',
            'title'     => 'title',
            'required'  => true,
        ));
        
        $fieldset->addField('url_key', 'text', array(
            'name'      => 'url_key',
            'label'     => 'Url Key',
            'title'     => 'url_key',
            'required'  => true,
        ));
        

      
        
        $fieldset->addField('status', 'select', array(
            'label'     => '状态',
            'title'     => 'Status',
            'name'      => 'status',
            'required'  => true,
            'options'   => array(
                '1' =>'Enabled',
                '0' =>'Disabled',
            ),
        ));
        
        $fieldset->addField('sort', 'text', array(
            'name'      => 'sort',
            'label'     => '排序',
            'title'     => 'sort',
        ));
        
        

        $fieldsetPassord = $form->addFieldset('content_fieldset',array('legend'=>'Page Content', 'class' => 'fieldset-content hidden'));
        $fieldsetPassord->addField('content', 'textarea', array(
            'name'      => 'content',
            'style'     => 'width:100%;height:400px;font-weight: 400;font-size: 12px;font: 12px arial, helvetica, sans-serif;',
            'class'     => 'form-control editor',
            'label'     => null,
            'title'     => 'content',
            'required'  => true,
        ));


        $form->setValues($this->model);
        $form->setUseContainer(true);
        $this->setForm($form);
    }
}