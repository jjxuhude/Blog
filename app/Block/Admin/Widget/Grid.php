<?php
namespace App\Block\Admin\Widget;
class Grid extends \App\Block\Core\Template{
    
    protected $_columns = array();
    
    protected $_pageSize=10;//设置每页的条数
    
    protected $_pageRange=5;//设置导航栏显示页码的个数
    
    protected $_links=array();
    
    public  $sort=null;
    
    public  $dir='desc';
    
    public  $model;
    

    
    function __construct($model){
        $this->model=$model;
        $this->prepareColumns();
        $this->addLinks();
        if(is_null($this->sort)) $this->sort=$model::getPk();
        
        if(request('_sort') &&  request('_dir')){
            $this->sort=request('_sort') ;
            $this->dir= request('_dir');
        }
    }

    
    /**
     * 控制器model搜索条件
     */
    public function getSearch(){
        $filter=array();
        $raw=array();
        if(count($this->_columns>0)){
           
            foreach($this->_columns as $key=>$column){
               
                $type=$column->get('type');
                $search_index=$column->get('search_index');
                if($search_index){
                    $index=$search_index;
                } else{
                    $index=$column->get('index');
                }
             
               if(!request()->has($key)) continue;
                $searchValue=request($key);
                
                if($searchValue || $searchValue==='0'){
                    if(is_array($searchValue)){
                        $searchValue=array_filter($searchValue);
                        if($searchValue){
                           // $filter[$key]=$searchValue;
                           if(in_array($type,array('range','date'))){
                               $optionWhereArr=array();
                               if(isset($searchValue[0]) && $searchValue[0]){
                                   $filter[]=[$index,'>=',$searchValue[0]];
                               }
                               if(isset($searchValue[1]) && $searchValue[1]){
                                   $filter[]=[$index,'<=',$searchValue[1]];
                               }
                           }
                        }
                    }elseif(is_string($searchValue)){
                        if($type=='int'){
                            $filter[]=[$index,$searchValue];
                        }elseif($type=='text'){
                            $filter[]=[$index,'like','%'.$searchValue.'%'];
                        }elseif($type=='options'){
                            $filter[]=[$index,'=',$searchValue];
                        }elseif($type=='find_in_set'){
                            if(strpos($searchValue, ',')){
                                $raw[]='find_in_set('.$index.' ,'."'".$searchValue."'".')';
                            }else{
                                $filter[]=[$index,'like','%'.$searchValue.'%'];
                            }
                        }
                    }
                }   
            }
       }
        
        return ['filter'=>$filter,'raw'=>$raw];
        
    }


    function getColumns(){
        return $this->_columns;
    }
    
    function addColumn($columnId,$column){
        $columnInstance=new Column();
        $this->_columns[$columnId]=$columnInstance->assign('data',$column);
    }
    
    function getSortActiveClass($id){
        if($this->sort==$id){
            return 'sort-on';
        }else{
            return false;
        }
    }
    
    function getSortDir($id){
        if($this->getSortActiveClass($id)){
            return $this->dir;
        }
    }
    
    function getDefaultSortField(){
        $sort=$this->setSort();
        return $sort['field'];
    }
    
    function getDefaultSortDir(){
        $sort=$this->setSort();
        return $sort['dir'];
    }
    
    function getAddButton(){
    
    }
    
    
    
    function setSort(){
         
    
    }
    
    function getFilterStatus(){
        $status=[];
        if(count($this->_columns>0)){
           
            foreach($this->_columns as $key=>$column){
               
                $type=$column->get('type');
                $search_index=$column->get('search_index');
                if($search_index){
                    $index=$search_index;
                } else{
                    $index=$column->get('index');
                }
             
               if(!request()->has($key)) continue;
                $searchValue=request($key);
                
                if($searchValue || $searchValue==='0'){
                    if(is_array($searchValue)){
                        $searchValue=array_filter($searchValue);
                        if($searchValue){
                           // $filter[$key]=$searchValue;
                           if(in_array($type,array('range','date'))){
                               $optionWhereArr=array();
                               $status[$key]['title']=$column->get('header');
                               $status[$key]['value']='';
                               if(isset($searchValue[0])){
                                  $status[$key]['value']=$searchValue[0];
                               }
                               if(isset($searchValue[1])){
                                  $status[$key]['value'] .= '-'.$searchValue[1];
                               }
                           }
                        }
                    }elseif(is_string($searchValue)){
                        $status[$key]['title']=$column->get('header');
                        $status[$key]['value']=$searchValue;
                        if($type=='int'){
                            $filter[]=[$index,$searchValue];
                        }elseif($type=='text'){
                            $filter[]=[$index,'like','%'.$searchValue.'%'];
                        }elseif($type=='options'){
                            $filter[]=[$index,'=',$searchValue];
                            $options=$column->get('options');
                            $status[$key]['value']=$options[$searchValue];
                        }elseif($type=='find_in_set'){
                            if(strpos($searchValue, ',')){
                                $raw[]='find_in_set('.$index.' ,'."'".$searchValue."'".')';
                            }else{
                                $filter[]=[$index,'like','%'.$searchValue.'%'];
                            }
                        }
                    }
                }   
            }
       }
        
       return $status;
        
    }
    
    public function addLinks(){
        
    }
    
    
    public function linkToHtml($link){
        $html='<a class="'.$link['class'].'" href="'.$link['href'].'">'.$link['text'].'</a>';
        if(isset($link['script']) && !empty($link['script'])){
            $html.='<script>'.$link['script'].'</script>';
        }
        return $html;
    }
    
    public function getLinks(){
        
    }


 
}