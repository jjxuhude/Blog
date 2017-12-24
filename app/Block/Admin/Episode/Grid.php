<?php
namespace App\Block\Admin\Episode;
use App\Services\ApiService;
use Illuminate\Database\Eloquent\Model;
use App\Model\Video;
use App\Model\Errors;

class Grid extends \App\Block\Admin\Widget\Grid{
    
  public $title="Episode管理";
  public $addText="添加新Episode";
    
    
  public function getSearch(){
      $map=parent::getSearch();
      array_push($map['raw'], 'line1 is not null');
      
      $ids=Errors::getErrorTvId();
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
         
            
            $this->addColumn('still_path', array(
                'header'    => '海报图片',
                'type'      =>'text',
                'index'     => 'still_path',
                'search_index'=>null,
                'renderer'  => function ($item){
                    if(is_file(app()->basePath().DS.'public'.DS.'images'.DS.'w342'.DS.$item['still_path'])){
                        $url='/images/w342/'.$item['still_path'];
                        $img='<img style="width:50px;display:block;margin:0 auto;" alt="poster_path" src="'.$url.'"/>';
                    }else{
                        $baseUrl=ApiService::IMAGE_DOMAIN;
                        $size="w92";
                        $filename=$item['still_path'];
                        $img='<img style="width:50px;display:block;margin:0 auto;" alt="'.$item['still_path'].'" src="'.$baseUrl.$size.$filename.'"/>';
                    }
                    return $img;
                }
            ));
            
            $this->addColumn('name', array(
                'header'    => '标题',
                'type'      =>'text',
                'index'     => 'name',
            ));
            
            $this->addColumn('release_date', array(
                'header'    => '发行时间',
                'type'      =>'text',
                'index'     => 'release_date',
            ));
            $this->addColumn('vote_average', array(
                'header'    => '评分',
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
          
            $this->addColumn('tv_id', array(
                'header'    => 'Tv id',
                'type'      =>'range',
                'index'     => 'tv_id',
            ));
   
            $this->addColumn('season_id', array(
                'header'    => '季 id',
                'type'      =>'range',
                'index'     => 'season_id',
            ));
            
            $this->addColumn('season_number', array(
                'header'    => '季 number',
                'type'      =>'range',
                'index'     => 'season_number',
            ));
            
            $this->addColumn('episode_number', array(
                'header'    => '集 number',
                'type'      =>'range',
                'index'     => 'episode_number',
            ));
  
            
            $errorIds=Errors::getErrorTVId();
            $this->addColumn('error_code', array(
                'header'    => '错误状态',
                'type'      =>'text',
                'index'     => 'error_code',
                'search_index'=>null,
                'renderer'    =>function ($item) use ($errorIds){
                    if(in_array($item['id'], $errorIds)){
                        $message=Errors::getErrorTvMessage($item['id']);
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
        $count=count(Errors::getErrorTvId());
        if($count){
            $errorBtn=[
                'class'=>'form-button error-link',
                'href'=>route('episode.index',['error_code'=>1]),
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