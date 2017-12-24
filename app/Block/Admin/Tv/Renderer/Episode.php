<?php
namespace App\Block\Admin\Tv\Renderer;
use App\Block\Core\Template;
use Illuminate\Support\Facades\DB;
use App\Model\Persion;
use App\Services\ApiService;
use App\Model\Episode as Items;
class Episode extends Template{
    

    function getEpisodes(){
        $seasionId=$this->getData('model')->id;
        $list=Items::where('season_id',$seasionId)->get();
        return $list;
    }
    
    


}
