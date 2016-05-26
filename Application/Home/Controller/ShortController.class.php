<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class ShortController extends CommonController {
    //生成短连接
    public function url()
	{
		$WxApi = Api::factory('Short');
		$long_url = 'http://wap.koudaitong.com/v2/showcase/goods?alias=128wi9shh&spm=h56083&redirect_count=1'; 
		$action   = 'long2short';
        $ret = $WxApi->url($long_url, $action);

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        var_dump($ret);
	}

	//获取当前url
	public function current()
	{
		$WxApi = Api::factory('Short');

		$ret = $WxApi->current();

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        var_dump($ret);
	}
}
