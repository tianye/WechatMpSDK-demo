<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;
use Think\Log;

class ServerController extends CommonController {

	//接受微信消息 并被动回复
    public function index()
	{
		$Server = Api::factory('Server');

		//事件 关注
		$Server->on('event', 'subscribe' , function($event) {
			$data = array(
				'Content'	=> "你好啊!"
			);
			$Message = Api::factory('Message')->text($data);
			return $Message;
		});

		//事件 取消关注
		$Server->on('event', 'unsubscribe' , function($event) {	
			$data = array(
				'Content'	=> "再见!"
			);
			$Message = Api::factory('Message')->text($data);
			return $Message;
		});

		//普通 文本消息
		$Server->on('text', function($event) {

			if ($event['Content'] == '图文') {
				$data = array(
					'item' => array(
						array(
							'Title'	=>	'标题',
							'Description'	=> '描述',
							'PicUrl'	=>	'http://test.digilinx.cn/wxApi/Uploads/test.png',
							'Url'		=>	'http://www.baidu.com'
						)
					)
				);

				$this->wlog($data);

				$Message = Api::factory('Message')->news($data);
			} elseif ($event['Content'] == '多图文') {
				$data = array(
					'item' => array(
						array(
						'Title'	=>	'标题1',
						'PicUrl'	=>	'http://test.digilinx.cn/wxApi/Uploads/test.png',
						'Url'		=>	'http://www.baidu.com'
						),
						array(
							'Title'	=>	'标题2',
							'PicUrl'	=>	'http://test.digilinx.cn/wxApi/Uploads/test.png',
							'Url'		=>	'http://www.qq.com'
						),
						array(
							'Title'	=>	'标题3',
							'Url'		=>	'http://www.qq.com'
						),
						array(
							'Title'	=>	'标题4'
						)
					)
				);

				$this->wlog($data);

				$Message = Api::factory('Message')->news($data);
			} else if ($event['Content'] == '音乐') {
				$data = array(
					'Title'			=> '音乐标题',
					'Description'	=> '音乐描述',
					'MusicUrl'		=>	'http://test.digilinx.cn/wxApi/Uploads/wltdfn.mp3',
					'HQMusicUrl'	=>	'http://test.digilinx.cn/wxApi/Uploads/wltdfn.mp3',
					'ThumbMediaId'	=>	'Nubk-xLuWZPJsaG8ME-jsOtmARmgWW0sinC-ijE7080cSKXzvwZj__a6_1B83sqS'
				);

				$this->wlog($data);
				$Message = Api::factory('Message')->music($data);
			} else if ($event['Content'] == '第三方') {
				$url = 'http://test.digilinx.cn/tianyeApp/Home/Server/index2';
				$token = C('TOKEN');
				
				$Server = Api::factory('Server');

				$xml = $Server->arrayToXml($event);
				
				//加密传输
				$Message = $Server->receiveAgent($url, $token, $xml, true);
				
				//明文传输
				//$Message = $Server->receiveAgent($url, $token, $xml);

			} else if ($event['Content'] == '客服') {
				$data = array();

				$this->wlog($data);

				$Message = Api::factory('Message')->transfer_customer_service($data);
			} else {
				$data = array(
					'Content'	=> $event['Content']
				);

				$this->wlog($data);

				$Message = Api::factory('Message')->text($data);
			}
			
			return $Message;
		});

		//普通 图片消息
		$Server->on('image', function($event) {	

			$this->wlog($event);

			$data = array(
				'MediaId'	=> $event['MediaId']
			);

			$Message = Api::factory('Message')->image($data);
			return $Message;
		});

		//普通 语音消息
		$Server->on('voice', function($event) {	

			$this->wlog($event);

			$data = array(
				'MediaId'	=> $event['MediaId']
			);

			$Message = Api::factory('Message')->voice($data);
			return $Message;
		});

		//普通 地理位置
		$Server->on('location', function($event) {	

			$this->wlog($event);

			$data = array(
				'Content' => '维度:'.$event['Location_X']."\n经度:".$event['Location_Y']."\n缩放:".$event['Scale']."\n详情:".$event['Label']
			);
			$Message = Api::factory('Message')->text($data);
			return $Message;
		});

		//普通 视频消息
		$Server->on('video', function($event) {	

			$this->wlog($event);

			$data = array(
				'MediaId'	  => $event['MediaId']
			);

			$Message = Api::factory('Message')->video($data);
			return $Message;
		});

		//普通 小视频
		$Server->on('shortvideo', function($event) {	

			$this->wlog($event);

			$data = array(
				'MediaId'	  => $event['MediaId']
			);

			$Message = Api::factory('Message')->video($data);
			return $Message;
		});

	}


	//测试第三方接受
	public function index2()
	{
		$Server = Api::factory('Server');
		//普通 文本消息
		$Server->on('text', function($event) {

			$this->wlog($event);

			$data = array(
				'Content'	=> "第三方回复!"
			);
			$Message = Api::factory('Message')->text($data);
			return $Message;
		});
	}

	/**
     * 日志调试方法
     *
     * @author Cui
     *
     * @date   2015-10-01
     *
     * @param  string|int|array    $info  信息
     * @param  string              $level 日志级别
     */
    public function wlog($info, $level = Log::DEBUG)
    {
        if (is_array($info)) {
            $info = print_r($info, true);
        }

        Log::record($info, $level);
    }
}
