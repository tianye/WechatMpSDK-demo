<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class UserController extends CommonController {

	//获取用户信息
    public function getUserMsg()
	{
		$WxApi = Api::factory('User');

		$openid = 'odkJ9uE2f1BTY2rBKpFKvCcVoMvM';

        $ret = $WxApi->getUserMsg($openid);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}

	//批量获取用户基本信息
    public function getUserList()
	{
		$WxApi = Api::factory('User');

		$user_list = array();
		$user_list['user_list'] = array(
			array('openid'=>'odkJ9uEnEIJSNnr0Bk9_eA70ZS8o', 'lang' => 'zh-CN'),
			array('openid'=>'odkJ9uE2f1BTY2rBKpFKvCcVoMvM', 'lang' => 'zh-CN')
		);

        $ret = $WxApi->getUserList($user_list);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}

	//获取用户Openid列表
	public function getUserOpenidList()
	{
		$WxApi = Api::factory('User');

		$next_openid = '';
		
        $ret = $WxApi->getUserOpenidList($next_openid);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}

	//设置用户备注名
	public function setUserRemark()
	{
		$WxApi = Api::factory('User');

		$openid = 'odkJ9uEnEIJSNnr0Bk9_eA70ZS8o';
		$remark = '杨Boss';

        $ret = $WxApi->setUserRemark($openid, $remark);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}
}
