<?php
namespace App\Block\Admin\Role;
class Edit extends \App\Block\Admin\Widget\Edit{
    
    
    function getModel(){
       return $this->model;
    }
    
    function getRole(){
        $roleModel=new \App\Model\Role();
        return $roleModel->getRoleOptions()->toArray();
    }
    
    
    function getAlcData(){
            $xml=new \App\Lib\Xml();
            $xmlObj=$xml->getResourcesTree();
            $data=array_values($xmlObj['children']);
            return \Zend_Json::encode($data);
    }
    
    function getCheckedData(){
        $resourceModel=new \App\Model\RoleResource();
        $roleResource=$resourceModel->getCollection($this->getModel()->id);
        return \Zend_Json::encode($roleResource);
        
    }
    
    protected function _prepareForm()
    {
        $form = new \Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getFormAction(), 'method' => 'post')
        );
    
        $fieldset = $form->addFieldset('base_fieldset',array('legend'=>'General Information', 'class' => 'fieldset-base active'));
    
        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => '角色名称',
            'title'     => 'name',
            'required'  => true,
        ));
    
     
        $form->setValues($this->model);
        $form->setUseContainer(true);
        $this->setForm($form);
    }

}