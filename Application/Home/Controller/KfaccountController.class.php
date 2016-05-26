<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class KfaccountController extends CommonController {

	//添加客服
    public function add()
	{
		$WxApi = Api::factory('Kfaccount');

		$kf_account = '009@DremQzone';
		$nickname	= 'Maaahuanghuang';
		$password	= '123456';

        $ret = $WxApi->add($kf_account, $nickname, $password);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}

	//修改客服账号
    public function update()
	{
		$WxApi = Api::factory('Kfaccount');

		$kf_account = '009@DremQzone';
		$nickname	= 'UaDD';
		$password	= '654321';

        $ret = $WxApi->update($kf_account, $nickname, $password);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}

	//删除客服账号
	public function del()
	{
		$WxApi = Api::factory('Kfaccount');

		$kf_account = '008@DremQzone';
		
        $ret = $WxApi->del($kf_account);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}
	
	//获取客服基本信息
	public function getkflist()
	{
		$WxApi = Api::factory('Kfaccount');
		
        $ret = $WxApi->getkflist();

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}
	
	//获取在线客服接待信息
	public function getonlinekflist()
	{
		$WxApi = Api::factory('Kfaccount');
		
        $ret = $WxApi->getonlinekflist();

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}

	//设置客服账号的头像
	public function uploadheadimg()
	{
		$WxApi = Api::factory('Kfaccount');
		
		$file = 'Uploads/test.png';
		$kf_account = '002@DremQzone';

		$ret = $WxApi->uploadheadimg($file, $kf_account);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//获取客服聊天记录
	public function getrecord()
	{
		$WxApi = Api::factory('Kfaccount');

		$endtime = '987654321';
		$pageindex = '1';
		$pagesize = '10';
		$starttime = '123456789';

        $ret = $WxApi->getrecord($endtime, $pageindex, $pagesize, $starttime);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
	}

/**
										------------------------------------------发送客服消息------------------------------------------
*/
}
