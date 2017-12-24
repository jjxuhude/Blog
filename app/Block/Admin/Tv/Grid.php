<?php
namespace App\Block\Admin\Tv;
use App\Services\ApiService;
use Illuminate\Database\Eloquent\Model;
use App\Model\Video;

class Grid extends \App\Block\Admin\Widget\Grid{
    
  public $title="TV管理";
  public $addText="添加新Tv";
    
    
//   public function getSearch(){
//       $map=parent::getSearch();
//       array_push($map['filter'], ['online','1']);
//       return $map;
//   }

    
    
 function prepareColumns(){
        
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
            
          

            
            
  
            
            $this->addColumn('release_date', array(
                'header'    => '发行时间',
                'type'      =>'text',
                'index'     => 'release_date',
            ));
            
            $this->addColumn('number_of_seasons', array(
                'header'    => '季的数量',
                'type'      =>'range',
                'index'     => 'number_of_seasons',
            ));
            
            $this->addColumn('number_of_episodes', array(
                'header'    => '集数量',
                'type'      =>'range',
                'index'     => 'number_of_episodes',
            ));
            
            $this->addColumn('vote_average', array(
                'header'    => '电影评分',
                'type'      =>'range',
                'index'     => 'vote_average',
                'search_index'=>null,
                'style'     =>'width:60px;'
            ));
            $this->addColumn('vote_count', array(
                'header'    => '评论数',
                'type'      =>'range',
                'index'     => 'vote_count',
                'search_index'=>null,
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
    
          
        }
    }
    
    

   
}