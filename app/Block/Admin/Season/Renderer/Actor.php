<?php
namespace App\Block\Admin\Season\Renderer;
use App\Block\Core\Template;
use Illuminate\Support\Facades\DB;
use App\Model\Persion;
use App\Services\ApiService;
class Actor extends Template{
    
    function getActorIds(){
        $id=$this->getModel()->id;
        $ids=DB::table('credits')->where('video_id',$id)->value('ids');
        return $ids;
    }
    
    
    function getActors(){
        $ids=$this->getActorIds();
        return Persion::getActorByIds($ids);
    }
    
    public function getUrl($path,$size='w92'){
        return ApiService::IMAGE_DOMAIN.$size.$path;
    }
    
    


}
