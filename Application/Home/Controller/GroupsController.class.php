<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class GroupsController extends CommonController {
    
    //创建用户组
    public function create()
	{
		$WxApi = Api::factory('Groups');

		$name = 'TestGroup';

		$ret = $WxApi->create($name);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//查询分组
    public function get()
	{
		$WxApi = Api::factory('Groups');

		$ret = $WxApi->get();

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//查询用户所在分组
	public function getid()
	{
		$WxApi = Api::factory('Groups');

		$openid = 'odkJ9uE2f1BTY2rBKpFKvCcVoMvM';

		$ret = $WxApi->getid($openid);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//修改分组名
	public function update()
	{
		$WxApi = Api::factory('Groups');

		$id   = 100;
		$name = 'testUpdate';

		$ret = $WxApi->update($id, $name);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//删除
	public function delete()
	{
		$id = I('get.id', NULL, 'htmlspecialchars');

		if (!is_numeric($id) || empty($id)) {
			return false;
		}

		$WxApi = Api::factory('Groups');

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		$ret = $WxApi->delete($id);

		var_dump($ret);
	}

	//移动用户到指定分组
	public function moveUser()
	{
		$WxApi = Api::factory('Groups');

		$openid = 'odkJ9uEnEIJSNnr0Bk9_eA70ZS8o';
		$to_groupid = 103;

		$ret = $WxApi->moveUser($openid, $to_groupid);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//批量移动用户到指定分组
	public function MoveUserlistGroup()
	{
		$WxApi = Api::factory('Groups');
		$openid_list = array('odkJ9uEnEIJSNnr0Bk9_eA70ZS8o', 'odkJ9uE2f1BTY2rBKpFKvCcVoMvM');
		$to_groupid = 103;
		$ret = $WxApi->MoveUserlistGroup($openid_list, $to_groupid);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
		var_dump($ret);
	}
}
