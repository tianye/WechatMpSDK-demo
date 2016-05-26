<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class QrcodeController extends CommonController {
    
    //创建临时二维码 - 场景值ID(Int)
    public function create()
	{
		$WxApi = Api::factory('Qrcode');

		$scene_id = 1; //场景ID
		$expire_seconds = 30;	//有效期秒

		$ret = $WxApi->create($scene_id, $expire_seconds);

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        var_dump($ret);
	}

	//创建永久二维码 - 场景值ID(Int)
	public function createLimitInt()
	{
		$WxApi = Api::factory('Qrcode');

		$scene_id = 2; //场景ID

		$ret = $WxApi->createLimitInt($scene_id);

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        var_dump($ret);
	}

	//创建永久二维码 - 场景值Str(Str)
	public function createLimitStr()
	{
		$WxApi = Api::factory('Qrcode');

		$queryStr = 'abc'; //场景ID

		$ret = $WxApi->createLimitStr($queryStr);

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        var_dump($ret);
	}

	//通过ticket换取二维码
	public function show()
	{
		$WxApi = Api::factory('Qrcode');

		$ticket = 'gQE58DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL0trT01ZUlRsRi1wdUNCSmI1V3V5AAIEmzlqVgMEAAAAAA=='; //场景ID

		$ret = $WxApi->show($ticket);

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        //var_dump($ret['type']);
		//var_dump($ret['size']);
		header('Content-type: '.$ret['type']);
        echo $ret['content'];
	}
}
