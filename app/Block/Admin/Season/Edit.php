<?php
namespace App\Block\Admin\Season;
use App\Services\ApiService;
use App\Model\Keywords;
use App\Model\Youtube;
use Illuminate\Support\Facades\DB;
class Edit extends \App\Block\Admin\Widget\Edit{
    
    
    function getModel(){
       return $this->model;
    }
    
    
    function getEnableModify(){
        if($this->model->add_method==2 || \Route::currentRouteName()=='video.create'){
            return true;
        }else{
            return false;
        }
    }
    
    
    protected function _prepareForm()
    {
        $form = new \Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getFormAction(), 'method' => 'post')
        );
    
        $fieldset = $form->addFieldset('base_fieldset',array('legend'=>'General Information', 'class' => 'fieldset-base active'));
    
        $fieldset->addField('row_id', 'text', array(
            'name'      => 'video[row_id]',
            'label'     => '电影(Tv)原始id',
            //'title'     => 'row_id',
            'class'     =>'number',
            
        ));
        
        $fieldset->addField('imdbid', 'text', array(
            'name'      => 'video[imdbid]',
           // 'title'     => 'imdbid',
            'label'     => 'Imdb_id',
            'class'     =>'alpha_dash',
        ));
        
        $fieldset->addField('title', 'text', array(
            'class'     => 'form-control',
            'name'      => 'video[title]',
            'label'     => '标题',
           // 'title'     => 'title',
            'required'  => true,
        ));
        
        $fieldset->addField('description', 'textarea', array(
            'class'     => 'form-control',
            'name'      => 'video[description]',
            'label'     => '描述',
            //'title'     => 'description',
            'required'  => true,
        ));
        
         $fieldset->addField('type', 'text', array(
            'name'      => 'video[type]',
            'label'     => '类型',
            'required'  => true,
            'default'  => 'tv',
            'readonly' => true,
        ));
        

        $fieldset->addField('url_key', 'text', array(
            'name'      => 'video[url_key]',
            'label'     => 'Url Key',
            //'title'     => 'url_key',
            'required'  => true,
            'class'     =>'alpha_dash',
        ));
        
        $fieldset->addField('adult', 'select', array(
            'name'      => 'video[adult]',
            //'title'     => 'adult',
            'label'     => '是否是成人电影',
            'options'   => array(
                '1' =>'是',
                '0' =>'否',
            ),
        ));
        
        $fieldset->addField('budget', 'text', array(
            'name'      => 'video[budget]',
            //'title'     => 'budget',
            'label'     => '预算',
            'class'     =>'number'
        ));
        
        $fieldset->addField('homepage', 'text', array(
            'name'      => 'video[homepage]',
            //'title'     => 'homepage',
            'label'     => '电影官网',
            'class'     =>'url',
        ));
        
        $fieldset->addField('original_language', 'text', array(
            'name'      => 'video[original_language]',
           // 'title'     => 'original_language',
            'label'     => '语言',
            'class'     =>'alpha',
        ));
        
        $fieldset->addField('iso_3166_1', 'text', array(
            'name'      => 'video[iso_3166_1]',
            //'title'     => 'iso_3166_1',
            'label'     => '出品国家代码',
            'class'     =>'alpha',
        ));
        
        $fieldset->addField('countries_name', 'text', array(
            'name'      => 'video[countries_name]',
           // 'title'     => 'countries_name',
            'label'     => '国家名称',
        ));
        
        $fieldset->addField('release_date', 'text', array(
            'name'      => 'video[release_date]',
            //'title'     => 'release_date',
            'label'     => '上映时间',
            'class'     =>'date'
        ));
        
        $fieldset->addField('revenue', 'text', array(
            'name'      => 'video[revenue]',
            //'title'     => 'revenue',
            'label'     => '票房',
            'class'     =>'number'
        ));
        
        $fieldset->addField('runtime', 'text', array(
            'name'      => 'video[runtime]',
           // 'title'     => 'runtime',
            'label'     => '电影时长',
            'class'     =>'number'
        ));
        
        $fieldset->addField('vote_average', 'text', array(
            'name'      => 'video[vote_average]',
            //'title'     => 'vote_average',
            'label'     => '电影评分',
            'class'     =>'number'
        ));
        
        $fieldset->addField('vote_count', 'text', array(
            'name'      => 'video[vote_count]',
           // 'title'     => 'vote_count',
            'label'     => '评论数',
            'class'     =>'number'
        ));
        $fieldset->addField('quality', 'select', array(
            'name'      => 'video[quality]',
           // 'title'     => 'quality',
            'label'     => '分辨率',
            'required'  => true,
            'options'   =>array(
                'hd'=>'HD',
                'sd'=>'SD',
                'cam'=>'CAM',
                'upcoming'=>'UPCOMING',
            ),
            
        ));
        

        
        $fieldset->addField('rating', 'text', array(
            'name'      => 'video[rating]',
            //'title'     => 'rating',
            'label'     => 'imdb-rating',
            'class'     =>'number'
        ));
        
        $fieldset->addField('ratingCount', 'text', array(
            'name'      => 'video[ratingCount]',
            //'title'     => 'ratingCount',
            'label'     => 'imdb-ratingCount',
            'class'     =>'number'
        ));
        
        $fieldset->addField('topRank', 'text', array(
            'name'      => 'video[topRank]',
           // 'title'     => 'topRank',
            'label'     => 'imdb-topRank',
            'class'     =>'number'
        ));
        
        $fieldset->addField('status', 'select', array(
            'label'     => '状态',
           // 'title'     => 'Status',
            'name'      => 'video[status]',
            'required'  => true,
            'options'   => array(
                '1' =>'Enabled',
                '0' =>'Disabled',
            ),
        ));
        

        $fieldsetSeason = $form->addFieldset('season_fieldset',array('legend'=>'Season Information', 'class' => 'hidden fieldset-season'));
        $fieldsetSeason->addField('tv_id', 'text', array(
            'name'      => 'video[tv_id]',
            //'title'     => 'rating',
            'label'     => '电视id',
            'class'     =>'number'
        ));
        $fieldsetSeason->addField('season_number', 'text', array(
            'name'      => 'video[season_number]',
            //'title'     => 'rating',
            'label'     => '季Id',
            'class'     =>'number'
        ));
        $fieldsetSeason->addField('episode_count', 'text', array(
            'name'      => 'video[episode_count]',
            //'title'     => 'rating',
            'label'     => '当前季的集的数量',
            'class'     =>'number'
        ));
        $fieldsetSeason->addField('number_of_seasons', 'text', array(
            'name'      => 'video[number_of_seasons]',
            //'title'     => 'rating',
            'label'     => '季的总数量',
            'class'     =>'number'
        ));
        $fieldsetSeason->addField('number_of_episodes', 'text', array(
            'name'      => 'video[number_of_episodes]',
            //'title'     => 'rating',
            'label'     => '集的总数量',
            'class'     =>'number'
        ));
  
        
        
        $fieldsetImage = $form->addFieldset('image_fieldset',array('legend'=>'Image Info', 'class' => 'fieldset-image hidden'));
        $fieldsetImage->addField('backdrop_path', 'image', array(
            'name'      => 'video[backdrop_path]',
            'title'     => 'backdrop_path',
            'label'     => '背景图(1280px)',
            'imageDomain'   => ApiService::IMAGE_DOMAIN,
            'imageSize'     =>'w1280', 
            'thumbHeight'   =>'100',
            'localDir'      =>app()->basePath().DS.'public'.DS.'images'.DS
        ));
        $fieldsetImage->addField('poster_path', 'image', array(
            'name'      => 'video[poster_path]',
            'title'     => 'poster_path',
            'label'     => '海报图(342px)',
            'imageDomain'   => ApiService::IMAGE_DOMAIN,
            'imageSize'     =>'w342',
            'thumbHeight'    =>'100',
            'localDir'      =>app()->basePath().DS.'public'.DS.'images'.DS
        ));
        

        $fieldsetLines = $form->addFieldset('episode_fieldset',array('legend'=>'Episode List', 'class' => 'fieldset-lines hidden'));
        $fieldsetLines->setRenderer(function ($obj){
            $errors=DB::table('errors')->where('video_id',$this->getModel()->id)->pluck('message','line_field')->toArray();
            return  \Html::getHtml('Admin\Tv\Renderer\Episode','admin\tv\episode.phtml',['fieldset'=>$obj,'model'=>$this->getModel(),'errors'=>$errors]);
        });
        
        $fieldsetCatalog = $form->addFieldset('category_fieldset',array('legend'=>'Category Info', 'class' => 'fieldset-category hidden'));
        $fieldsetCatalog->setRenderer(function ($obj){
            return  \Html::getHtml('Admin\Video\Renderer\Catalog','admin\video\catalog.phtml',['fieldset'=>$obj,'model'=>$this->getModel()]);
        });
        
        $fieldsetActor = $form->addFieldset('actor_fieldset',array('legend'=>'Actor Info', 'class' => 'fieldset-actor hidden'));
        $fieldsetActor->setRenderer(function ($obj){
            return  \Html::getHtml('Admin\Video\Renderer\Actor','admin\video\actor.phtml',['fieldset'=>$obj,'model'=>$this->getModel()]);
        });
        
        $fieldsetDirector = $form->addFieldset('director_fieldset',array('legend'=>'Director Info', 'class' => 'fieldset-director hidden'));
        $fieldsetDirector->setRenderer(function ($obj){
            return  \Html::getHtml('Admin\Video\Renderer\Director','admin\video\director.phtml',['fieldset'=>$obj,'model'=>$this->getModel()]);
        });
        
        $fieldsetKeywords = $form->addFieldset('keywords_fieldset',array('legend'=>'Keywords Info', 'class' => 'fieldset-keywords hidden'));
        $fieldsetKeywords->setRenderer(function ($obj){
            return  \Html::getHtml('Core\Template','admin\video\keywords.phtml',['fieldset'=>$obj,'model'=>Keywords::getKeywordsById($this->model->id)]);
        });
        
        $fieldsetYoutube = $form->addFieldset('youtube_fieldset',array('legend'=>'Youtube Info', 'class' => 'fieldset-youtube hidden','button'=>'<a href="javascript:;" class="button youtube-add-btn pull-right"><i class="iconfont icon-add3"></i>Add Option</a>'));
        $fieldsetYoutube->setRenderer(function ($obj){
            return  \Html::getHtml('Admin\Video\Renderer\Youtube','admin\video\youtube.phtml',['fieldset'=>$obj,'model'=>$this->getModel(),'youtube'=>Youtube::getYoutubesById($this->model->id),'modify'=>$this->getEnableModify()]);
        });
        
  
        $form->setValues($this->model);
        $form->setUseContainer(true);
        $this->setForm($form);
    }
}