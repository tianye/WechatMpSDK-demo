<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;
use Think\Log;

class MessageController extends CommonController {
    
    //回复文本XML消息
    public function text()
	{
		$WxApi = Api::factory('Message');

		$openid 	 = 'odkJ9uJ9qhdvV3SVjC5-n2roAv_s';
		$original_id = 'gh_2c1a7a8fd31c';

		$data = array(
			'Content'	=> "你好啊<a herf='http://www.baidu.com'>跳转</a>",
		);

        $ret = $WxApi->setToFrom($openid, $original_id)->text($data);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		Log::write($ret, "DEBUG");

        var_dump($ret);
	}

	//回复图片XML消息
	public function image()
	{
		$WxApi = Api::factory('Message');

		$data = array(
			'MediaId'	=> '5rNy1X3Qxt4WM7HP45XOtM4ntVF95vYHqHE6m035RNz9eUjuvaqSGO3QdAKOJ1nJ',
		);

		$openid 	 = 'odkJ9uJ9qhdvV3SVjC5-n2roAv_s';
		$original_id = 'gh_2c1a7a8fd31c';
		$ret = $WxApi->setToFrom($openid, $original_id)->image($data);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		Log::write($ret, "DEBUG");

        var_dump($ret);
	}

	//回复音乐XML消息
	public function music()
	{
		$WxApi = Api::factory('Message');

		$data = array(
			'Title'			=>	'标题',
			'Description'	=>  '音乐描述',
			'MusicUrl'		=>	'http://yinyueshiting.baidu.com/data2/music/122082529/623748144971646164.mp3?xcode=9009b5eff4f8bc2d85f6fb12ebde0b01', //音乐链接
			'HQMusicUrl'		=>	'http://yinyueshiting.baidu.com/data2/music/122082529/623748144971646164.mp3?xcode=9009b5eff4f8bc2d85f6fb12ebde0b01', //高质量音乐链接，WIFI环境优先使用该链接播放音乐
			'ThumbMediaId'		=>	'5rNy1X3Qxt4WM7HP45XOtM4ntVF95vYHqHE6m035RNz9eUjuvaqSGO3QdAKOJ1nJ' //缩略图的媒体id，通过素材管理接口上传多媒体文件，得到的id
		);

		$openid 	 = 'odkJ9uJ9qhdvV3SVjC5-n2roAv_s';
		$original_id = 'gh_2c1a7a8fd31c';
		$ret = $WxApi->setToFrom($openid, $original_id)->music($data);
		
		if (!$ret) {
			$ret = $WxApi->getError();
		}

		Log::write($ret, "DEBUG");

        var_dump($ret);
	}

	//其它 略


}
