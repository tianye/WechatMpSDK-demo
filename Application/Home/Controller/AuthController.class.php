<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\Api;

class AuthController extends CommonController {

	//生成outh URL
	public function url()
	{
		$WxApi = Api::factory('Auth');
		$ret = $WxApi->url();

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//直接跳转
	public function redirect()
	{
		$WxApi = Api::factory('Auth');
		$ret = $WxApi->redirect();

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//获取用户信息
	public function getUser()
	{
		$WxApi = Api::factory('Auth');

		if (!I('get.state',false,'htmlspecialchars') || (!$code = I('get.code',false,'htmlspecialchars') ) && I('get.state',false,'htmlspecialchars')) {
            	$redirect = $WxApi->redirect();//直接跳转
        }

        $permission = $WxApi->getAccessPermission($code);//通过 code 获取 openid 和 access_token

		$ret = $WxApi->getUser($permission['openid'], $permission['access_token']);//获取用户信息

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//获取已授权用户
	public function user()
	{
		$WxApi = Api::factory('Auth');
 		if (!I('get.state',false,'htmlspecialchars') || (!$code = I('get.code',false,'htmlspecialchars') ) && I('get.state',false,'htmlspecialchars')) {
            $redirect = $WxApi->redirect();//直接跳转
        }
			$ret = $WxApi->user();//获取授权用户信息

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

}
