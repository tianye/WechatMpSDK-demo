<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class TemplateController extends CommonController {
	/*
	主行业				副行业				代码
	IT科技			互联网/电子商务			1
	IT科技			IT软件与服务			2
	IT科技			IT硬件与设备			3
	IT科技			电子技术				4
	IT科技			通信与运营商			5
	IT科技			网络游戏				6
	金融业			银行					7
	金融业			基金|理财|信托			8
	金融业			保险					9
	餐饮			餐饮					10
	酒店旅游		酒店					11
	酒店旅游		旅游					12
	运输与仓储		快递					13
	运输与仓储		物流					14
	运输与仓储		仓储					15
	教育			培训					16
	教育			院校					17
	政府与公共事业	学术科研				18
	政府与公共事业	交警					19
	政府与公共事业	博物馆					20
	政府与公共事业	公共事业|非盈利机构		21
	医药护理		医药医疗				22
	医药护理		护理美容				23
	医药护理		保健与卫生				24
	交通工具		汽车相关				25
	交通工具		摩托车相关				26
	交通工具		火车相关				27
	交通工具		飞机相关				28
	房地产			建筑					29
	房地产			物业					30
	消费品			消费品					31
	商业服务		法律					32
	商业服务		会展					33
	商业服务		中介服务				34
	商业服务		认证					35
	商业服务		审计					36
	文体娱乐		传媒					37
	文体娱乐		体育					38
	文体娱乐		娱乐休闲				39
	印刷			印刷					40
	其它			其它					41
	*/

	//设置所属行业
	//设置行业可在MP中完成，
	//每月可修改行业1次，账号仅可使用所属行业中相关的模板，
	//为方便第三方开发者，提供通过接口调用的方式来修改账号所属行业，具体如下
   public function apiSetIndustry()
   {
   		$WxApi = Api::factory('Template');
		$industry_id1   = '1'; 
		$industry_id2   = '2';
        $ret = $WxApi->apiSetIndustry($industry_id1, $industry_id2);

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        var_dump($ret);
   }

   //获得模板ID
   public function apiAddTemplate()
   {
   		$WxApi = Api::factory('Template');
		$template_id_short   = 'TM00015'; 
        $ret = $WxApi->apiAddTemplate($template_id_short);

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        var_dump($ret);
   }

   //发送模板消息
   public function send()
   {
   		$WxApi = Api::factory('Template');
		
		$touser = 'odkJ9uJ9qhdvV3SVjC5-n2roAv_s';
		$template_id = 'sA7Z3V_REY7DXj5PeGExhVfCbiUz9PRhclaEaPmSlf4';
		$url = 'http://www.baidu.com';
        $data = array(
        	'first'    => array('value' => '秒杀成功', 'color' => '#173177'),
        	'keyword1' => array('value' => 'MacBook Pro', 'color' => '#173177'),
        	'keyword2' => array('value' => '1元', 'color' => '#173177'),
        	'remark'   => array('value' => '点击付款', 'color' => '#173177')
        );

         $ret = $WxApi->send($touser, $template_id, $url, $data);

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        var_dump($ret);
   }
}