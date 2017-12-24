<?php
namespace App\Block\Admin\User;
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
    
        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => '用户名',
            'title'     => 'name',
            'required'  => true,
        ));
        
        $fieldset->addField('age', 'text', array(
            'name'      => 'age',
            'label'     => '年龄 ',
            'title'     => 'age',
            'required'  => true,
        ));
        
        $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => '邮箱',
            'title'     => 'email',
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
        
        $fieldset->addField('role', 'select', array(
            'label'     => '角色',
            'title'     => 'role',
            'name'      => 'role',
            'required'  => true,
            'options'   =>$this->getRole()
        ));
       
        
        
        $fieldsetPassord = $form->addFieldset('password_fieldset',array('legend'=>'Change Password', 'class' => 'fieldset-password hidden'));
        $fieldsetPassord->addField('password', 'text', array(
            'name'      => 'password',
            'label'     => '新密码 ',
            'title'     => 'password',
        ));
        $fieldsetPassord->addField('confirm_password', 'text', array(
            'name'      => 'confirm_password',
            'label'     => '密码确认 ',
            'title'     => 'confirm_password',
        ));
        $form->setValues($this->model);
        $form->setUseContainer(true);
        $this->setForm($form);
    }
}