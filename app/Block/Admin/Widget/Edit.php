<?php
namespace App\Block\Admin\Widget;
class Edit extends \App\Block\Core\Template{
    
    public $model=null;
    public $_primaryKey=null;
    public $_moduleName=null;
    public $_deleteText='删除';
    public $_saveText='保存';
    public $_form;
    public $_titleField='email';

    function __construct($model){
     
       $this->model=$model;
       $this->model->password=false;
       $this->_primaryKey=$model::getPk();
        
        $this->_prepareForm();
    }
    
    protected function getModel(){
        
    }
    
    protected function _prepareForm()
    {
        return $this;
    }
    
    public function getForm()
    {
        return $this->_form;
    }
    
    public function getElements(){
        if (is_object($this->getForm())) {
            return $this->getForm()->getElements();
        }
        return '';
    }
    
    public function setForm(\Varien_Data_Form $form)
    {
        $this->_form = $form;
        $this->_form->setParent($this);
        return $this;
    }
 
}