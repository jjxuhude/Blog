<?php
namespace App\Block\Admin\Season\Renderer;
use App\Block\Core\Template;
use Illuminate\Support\Facades\DB;
use App\Model\Persion;
use App\Services\ApiService;
class Youtube extends Template{
    
    function getOptionHtml(){
        $html=<<<HTML
      <tr class="youtube-add"> \
     	<td class="text-center"><input type="text" name="youtube[key][]" class="youtube-key form-control" /></td> \
     	<td class="text-center"><input type="text" name="youtube[name][]" class="youtube-name form-control"/></td> \
     	<td class="text-center"><select class="youtube-size form-control" name="youtube[size][]"> \
                             	  <option value=""></option> \
                             	  <option value="1080">1080</option> \
                             	  <option value="720">720</option> \
                             	  <option value="480">480</option> \
                             	  <option value="320">320</option> \
                             	</select> \
        </td> \
     	<td class="text-center"></td> \
     	<td class="text-center" style=""><a class="button youtube-option-del"><i class="iconfont icon-delete6 "></i>Delete Option</a></td> \
    </tr>       
HTML;
        return $html;
    }
    
    


}
