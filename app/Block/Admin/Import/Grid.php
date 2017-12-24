<?php
namespace App\Block\Admin\Import;
use App\Services\ApiService;
use Illuminate\Database\Eloquent\Model;
use App\Model\Video;

class Grid extends \App\Block\Admin\Widget\Grid{
    
  public $title="视频管理";
  public $addText="添加新视频";
    
    
  public function getSearch(){
      $map=parent::getSearch();
      array_push($map['filter'], ['online','0']);
      return $map;
  }

    
    
 function prepareColumns(){
        
        if(empty($this->_columns)){
            $this->addColumn('id', array(
                'header'    => '编号',
                'type'      =>'range',
                'index'     => 'id',
            ));
    
       
         
            $this->addColumn('backdrop_path', array(
                'header'    => '背景图片',
                'type'      =>'text',
                'index'     => 'backdrop_path',
                'search_index'=>null,
                'renderer'  => function ($item){
                    if(is_file(app()->basePath().DS.'public'.DS.'images'.DS.'w1280'.DS.$item['backdrop_path'])){
                        $url='/images/w1280/'.$item['backdrop_path'];
                        $img='<img style="width:92px" src="'.$url.'"/>';
                    }else{
                        $baseUrl=ApiService::IMAGE_DOMAIN;
                        $size="w92";
                        $filename=$item['backdrop_path'];
                        //$img='<img src="'.$baseUrl.$size.$filename.'"/>';
                        $img='<img alt="none"/>';
                    }
                    return $img;
                }
            ));
            
            $this->addColumn('poster_path', array(
                'header'    => '海报图片',
                'type'      =>'text',
                'index'     => 'poster_path',
                'search_index'=>null,
                'renderer'  => function ($item){
                    if(is_file(app()->basePath().DS.'public'.DS.'images'.DS.'w342'.DS.$item['poster_path'])){
                        $url='/images/w342/'.$item['poster_path'];
                        $img='<img style="width:92px" src="'.$url.'"/>';
                    }else{
                        $baseUrl=ApiService::IMAGE_DOMAIN;
                        $size="w92";
                        $filename=$item['poster_path'];
                        //$img='<img src="'.$baseUrl.$size.$filename.'"/>';
                        $img='<img alt="none"/>';
                    }
                    return $img;
                }
            ));

            $this->addColumn('imdbid', array(
                'header'    => 'imdbid',
                'type'      =>'find_in_set',
                'index'     => 'imdbid',
            ));
            $this->addColumn('title', array(
                'header'    => '标题',
                'type'      =>'text',
                'index'     => 'title',
            ));
            $this->addColumn('line1', array(
                'header'    => '线路一',
                'type'      =>'text',
                'index'     => 'line1',
            ));
   
            

            
            $this->addColumn('countries_name', array(
                'header'    => '国家',
                'type'      =>'text',
                'index'     => 'countries_name',
            ));
            
            $this->addColumn('release_date', array(
                'header'    => '发行时间',
                'type'      =>'text',
                'index'     => 'release_date',
            ));
            $this->addColumn('vote_average', array(
                'header'    => '电影评分',
                'type'      =>'range',
                'index'     => 'vote_average',
                'style'     =>'width:60px;'
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
          
            $this->addColumn('release_date', array(
                'header'    => '发行时间',
                'type'      =>'date',
                'index'     => 'release_date',
            ));

            
  
            

    
          
        }
    }
    
    
    public function addLinks(){
        $count=Video::getErrorCount()->count();
        if($count){
            $errorBtn=[
                'class'=>'form-button error-link',
                'href'=>route('video.index',['error_code[]'=>1]),
                'text'=>'错误视频('.$count.')',
//                 'script'=>'require(["jquery"],function($){
//                     $("a.error-link").click(function(e){
//                         e.preventDefault();
//                         alert(111);
//                     });
//                 })',
            ];
            array_push($this->_links, $errorBtn);
        }
    }
    
    
    
    public function getLinks(){
        $html="";
        foreach($this->_links as $link){
            $html.=$this->linkToHtml($link);
        }
        return $html;
    }
   
}