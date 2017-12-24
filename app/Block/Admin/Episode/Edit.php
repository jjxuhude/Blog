<?php
namespace App\Block\Admin\Episode;
use App\Services\ApiService;
use App\Model\Keywords;
use App\Model\Youtube;
use Illuminate\Support\Facades\DB;
class Edit extends \App\Block\Admin\Widget\Edit{
    
    
    function getModel(){
       return $this->model;
    }
    
    

    
    
    protected function _prepareForm()
    {
        $form = new \Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getFormAction(), 'method' => 'post')
        );
    
        $fieldset = $form->addFieldset('base_fieldset',array('legend'=>'General Information', 'class' => 'fieldset-base active'));
    
        $fieldset->addField('row_id', 'text', array(
            'name'      => 'row_id',
            'label'     => '原始id',
            //'title'     => 'row_id',
            'class'     =>'number',
            
        ));
        
        $fieldset->addField('production_code', 'text', array(
            'name'      => 'production_code',
            'label'     => 'production_code',
        ));
        
        $fieldset->addField('tv_id', 'text', array(
            'name'      => 'tv_id',
            'label'     => 'TV id',
            'class'     =>'number',
        ));
        $fieldset->addField('season_id', 'text', array(
            'name'      => 'season_id',
            'label'     => 'season_id',
            'class'     =>'number',
        ));
        $fieldset->addField('season_number', 'text', array(
            'name'      => 'season_number',
            'label'     => 'season_number',
            'class'     =>'number',
        ));
        $fieldset->addField('episode_number', 'text', array(
            'name'      => 'episode_number',
            'label'     => 'episode_number',
            'class'     =>'number',
        ));
        
        $fieldset->addField('release_date', 'text', array(
            'name'      => 'release_date',
            //'title'     => 'release_date',
            'label'     => '上映时间',
            'class'     =>'date'
        ));
        
        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => 'name',
            'required'  => true,
        ));

        $fieldset->addField('overview', 'textarea', array(
            'class'     => 'form-control',
            'name'      => 'overview',
            'label'     => '描述',
            //'title'     => 'description',
            'required'  => true,
        ));
        

        
        $fieldset->addField('vote_average', 'text', array(
            'name'      => 'vote_average',
            //'title'     => 'vote_average',
            'label'     => '电影评分',
            'class'     =>'number'
        ));
        
   
        

        $fieldset->addField('vote_count', 'text', array(
            'name'      => 'vote_count',
            // 'title'     => 'vote_count',
            'label'     => '评论数',
            'class'     =>'number'
        ));
        
    
        $fieldset->addField('status', 'select', array(
            'label'     => '状态',
           // 'title'     => 'Status',
            'name'      => 'status',
            'required'  => true,
            'options'   => array(
                '1' =>'Enabled',
                '0' =>'Disabled',
            ),
        ));
        

       
        
        
        $fieldsetImage = $form->addFieldset('image_fieldset',array('legend'=>'Image Info', 'class' => 'fieldset-image hidden'));

        $fieldsetImage->addField('still_path', 'image', array(
            'name'      => 'still_path',
            'title'     => 'still_path',
            'label'     => '海报图(342px)',
            'imageDomain'   => ApiService::IMAGE_DOMAIN,
            'imageSize'     =>'w342',
            'thumbHeight'    =>'100',
            'localDir'      =>app()->basePath().DS.'public'.DS.'images'.DS
        ));
        
        $fieldsetLines = $form->addFieldset('lines_fieldset',array('legend'=>'线路 Info', 'class' => 'fieldset-lines hidden'));
        $fieldsetLines->setRenderer(function ($obj){
            $errors=DB::table('errors')->where('tv_episode_id',$this->getModel()->id)->pluck('message','line_field')->toArray();
            return  \Html::getHtml('Core\Template','admin\tv\lines.phtml',['fieldset'=>$obj,'model'=>$this->getModel(),'errors'=>$errors]);
        });
 
        
 
        

        
  
 
  
        
  
        $form->setValues($this->model);
        $form->setUseContainer(true);
        $this->setForm($form);
    }
}