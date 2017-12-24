<?php
namespace App\Block\Admin\Catalog;
use App\Services\ApiService;
use App\Model\Video;
class Grid extends \App\Block\Admin\Widget\Grid{
    
    public $title="分类管理";
    public  $sort='position';
    
    public  $dir='asc';

    
    
 function prepareColumns(){
        
        if(empty($this->_columns)){
            if(empty($this->_columns)){
                $this->addColumn('id', array(
                    'header'    => '编号',
                    'type'      =>'range',
                    'index'     => 'id',
                ));
            
                $this->addColumn('imdbid', array(
                    'header'    => 'imdbid',
                    'type'      =>'find_in_set',
                    'index'     => 'imdbid',
                ));
            
                $this->addColumn('poster_path', array(
                    'header'    => '海报图片',
                    'type'      =>'text',
                    'index'     => 'poster_path',
                    'search_index'=>null,
                    'renderer'  => function ($item){
                        if(is_file(app()->basePath().DS.'public'.DS.'images'.DS.'w342'.DS.$item['poster_path'])){
                            $url='/images/w342/'.$item['poster_path'];
                            $img='<img style="width:50px;display:block;margin:0 auto;" alt="poster_path" src="'.$url.'"/>';
                        }else{
                            $baseUrl=ApiService::IMAGE_DOMAIN;
                            $size="w92";
                            $filename=$item['poster_path'];
                            $img='<img style="width:50px;display:block;margin:0 auto;" alt="'.$item['poster_path'].'" src="'.$baseUrl.$size.$filename.'"/>';
                        }
                        return $img;
                    }
                ));
            
                $this->addColumn('title', array(
                    'header'    => '标题',
                    'type'      =>'text',
                    'index'     => 'title',
                ));
            
                $this->addColumn('type', array(
                    'header'    => '类型',
                    'type'      =>'options',
                    'options'   => config('app.video_type'),
                    'index'     => 'type',
                ));
            
                $this->addColumn('countries_name', array(
                    'header'    => '国家',
                    'type'      =>'options',
                    'options'   => Video::getCountrys(),
                    'index'     => 'countries_name',
                ));
       
                
        
            
                $this->addColumn('release_date', array(
                    'header'    => '发行时间',
                    'type'      =>'date',
                    'index'     => 'release_date',
                ));
                $this->addColumn('vote_average', array(
                    'header'    => '电影评分',
                    'type'      =>'range',
                    'index'     => 'vote_average',
                    //'search_index'=>null,
                    'style'     =>'width:60px;'
                ));
                $this->addColumn('vote_count', array(
                    'header'    => '评论数',
                    'type'      =>'range',
                    'index'     => 'vote_count',
                    //'search_index'=>null,
                ));
           
                $this->addColumn('quality', array(
                    'header'    => '质量',
                    'type'      =>'options',
                    'index'     => 'quality',
                    'options'   =>array(
                        'hd'=>'HD',
                        'sd'=>'SD',
                        'cam'=>'CAM',
                        'upcoming'=>'UPCOMING',
                    ),
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
                $this->addColumn('position', array(
                    'header'    => '位置',
                    'type'      =>'range',
                    'index'     => 'position',
                    //'search_index'=>null,
                    'renderer'  =>function($item){
                        $html='<input name="position['.$item['id'].']" style="width:60px;"   value="'.$item['position'].'" />';
                        return $html;
                    }
                ));
            }
        }
    }
   
}
