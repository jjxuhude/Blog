<?php
namespace App\Block\Admin\Tv;
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
            'label'     => 'Tv原始id',
            //'title'     => 'row_id',
            'class'     =>'number',
            
        ));
        
        $fieldset->addField('imdbid', 'text', array(
            'name'      => 'imdbid',
           // 'title'     => 'imdbid',
            'label'     => 'Imdb_id',
            'class'     =>'alpha_dash',
        ));
        
        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            // 'title'     => 'imdbid',
            'label'     => 'Url Key',
            'class'     =>'alpha_dash',
            'required'  => true,
        ));
        
        $fieldset->addField('title', 'text', array(
            'class'     => 'form-control',
            'name'      => 'title',
            'label'     => '标题',
           // 'title'     => 'title',
            'required'  => true,
        ));
        
        $fieldset->addField('overview', 'textarea', array(
            'class'     => 'form-control',
            'name'      => 'overview',
            'label'     => '描述',
            //'title'     => 'description',
            'required'  => true,
        ));
        
        
        $fieldset->addField('original_language', 'text', array(
            'name'      => 'original_language',
           // 'title'     => 'original_language',
            'label'     => '语言',
            'class'     =>'alpha',
        ));
        

        
        $fieldset->addField('countries_name', 'text', array(
            'name'      => 'countries_name',
           // 'title'     => 'countries_name',
            'label'     => '国家名称',
        ));
        
        $fieldset->addField('homepage', 'text', array(
            'name'      => 'homepage',
            //'title'     => 'homepage',
            'label'     => '电影官网',
            'class'     =>'url',
        ));
        
        $fieldset->addField('release_date', 'text', array(
            'name'      => 'release_date',
            //'title'     => 'release_date',
            'label'     => '上映时间',
            'class'     =>'date'
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
        
        $fieldset->addField('networks', 'text', array(
            'name'      => 'networks',
            // 'title'     => 'countries_name',
            'label'     => '电视台',
        ));
        
        $fieldset->addField('number_of_episodes', 'text', array(
            'name'      => 'number_of_episodes',
            // 'title'     => 'vote_count',
            'label'     => '集数量',
            'class'     =>'number'
        ));
        
        $fieldset->addField('number_of_seasons', 'text', array(
            'name'      => 'number_of_seasons',
            // 'title'     => 'vote_count',
            'label'     => '季的数量',
            'class'     =>'number'
        ));
        
        $fieldset->addField('popularity', 'text', array(
            'name'      => 'popularity',
            // 'title'     => 'vote_count',
            'label'     => '流行度',
            'class'     =>'number'
        ));
        
        
 
        

        
        $fieldset->addField('rating', 'text', array(
            'name'      => 'rating',
            //'title'     => 'rating',
            'label'     => 'imdb-rating',
            'class'     =>'number'
        ));
        
        $fieldset->addField('ratingCount', 'text', array(
            'name'      => 'ratingCount',
            //'title'     => 'ratingCount',
            'label'     => 'imdb-ratingCount',
            'class'     =>'number'
        ));
        
        $fieldset->addField('topRank', 'text', array(
            'name'      => 'topRank',
           // 'title'     => 'topRank',
            'label'     => 'imdb-topRank',
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
        $fieldsetImage->addField('backdrop_path', 'image', array(
            'name'      => 'backdrop_path',
            'title'     => 'backdrop_path',
            'label'     => '背景图(1280px)',
            'imageDomain'   => ApiService::IMAGE_DOMAIN,
            'imageSize'     =>'w1280', 
            'thumbHeight'   =>'100',
            'localDir'      =>app()->basePath().DS.'public'.DS.'images'.DS
        ));
        $fieldsetImage->addField('poster_path', 'image', array(
            'name'      => 'poster_path',
            'title'     => 'poster_path',
            'label'     => '海报图(342px)',
            'imageDomain'   => ApiService::IMAGE_DOMAIN,
            'imageSize'     =>'w342',
            'thumbHeight'    =>'100',
            'localDir'      =>app()->basePath().DS.'public'.DS.'images'.DS
        ));
        
 
        
 
        

        
  
 
  
        
  
        $form->setValues($this->model);
        $form->setUseContainer(true);
        $this->setForm($form);
    }
}