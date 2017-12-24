<?php
namespace App\Block\Admin\Video;
use App\Services\ApiService;
use Illuminate\Database\Eloquent\Model;
use App\Model\Video;
use App\Model\Errors;

class Grid extends \App\Block\Admin\Widget\Grid{
    
  public $title="电影管理";
  public $addText="添加新电影";
    
    
  public function getSearch(){
      $map=parent::getSearch();
      array_push($map['filter'], ['online','1']);
      array_push($map['filter'], ['type','movie']);
      $ids=Errors::getErrorId();
      if(request('error_code')==1 && $ids){
        $map=['filter'=>[],'raw'=>['id in ('.join(',',$ids).')']];   
      }
        
      return $map;
  }

    
    
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
                'type'      =>'text',
                'index'     => 'release_date',
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
            $this->addColumn('line1', array(
                'header'    => '线路一',
                'type'      =>'text',
                'index'     => 'line1',
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
            $this->addColumn('rating', array(
                'header'    => 'Rating',
                'type'      =>'range',
                'index'     => 'rating',
            ));
            
            $this->addColumn('ratingCount', array(
                'header'    => 'RatingCount',
                'type'      =>'range',
                'index'     => 'ratingCount',
            ));
            
           $errorIds=Errors::getErrorId();
            $this->addColumn('error_code', array(
                'header'    => '错误状态',
                'type'      =>'text',
                'index'     => 'error_code',
                'search_index'=>null,
                'renderer'    =>function ($item) use ($errorIds){
                    if(in_array($item['id'], $errorIds)){
                        $message=Errors::getErrorMessage($item['id']);
                        return '<font color="red">'.$message.'</font>';
                    }
                }
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
    
    
    public function addLinks(){
        $count=count(Errors::getErrorId());
        if($count){
            $errorBtn=[
                'class'=>'form-button error-link',
                'href'=>route('video.index',['error_code'=>1]),
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