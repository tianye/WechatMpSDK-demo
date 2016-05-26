<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class JsSdkController extends CommonController {
    public function index()
	{
		$WxApi = Api::factory('JSSDK');
        $ret = $WxApi->config(array('hideOptionMenu', 'showOptionMenu', 'onMenuShareAppMessage', 'onMenuShareQZone', 'onMenuShareTimeline', 'onMenuShareQQ', 'onMenuShareWeibo'), false, true);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

        var_dump($ret);
	}
}
